<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MinifyProfilePhotos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'photos:minify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Minify profile photos to WebP format with max 200px dimension';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sourceDir = public_path('storage/profile-photos');
        $outputDir = public_path('storage/profile-photos-webp');

        if (!is_dir($sourceDir)) {
            $this->error("Source directory does not exist: {$sourceDir}");
            return 1;
        }

        if (!is_dir($outputDir)) {
            mkdir($outputDir, 0755, true);
            $this->info("Created output directory: {$outputDir}");
        }

        $files = glob($sourceDir . '/*');
        $imageFiles = array_filter($files, function($file) {
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            return in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
        });

        if (empty($imageFiles)) {
            $this->warn('No image files found to process.');
            return 0;
        }

        $this->info('Processing ' . count($imageFiles) . ' images...');
        $bar = $this->output->createProgressBar(count($imageFiles));
        $bar->start();

        $processed = 0;
        $errors = 0;

        foreach ($imageFiles as $file) {
            try {
                $filename = pathinfo($file, PATHINFO_FILENAME);
                $outputFile = $outputDir . '/' . $filename . '.webp';

                $result = $this->processImage($file, $outputFile);

                if ($result) {
                    $processed++;
                } else {
                    $errors++;
                }
            } catch (\Exception $e) {
                $this->newLine();
                $this->error("Error processing {$file}: " . $e->getMessage());
                $errors++;
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        $this->info("Successfully processed: {$processed}");
        if ($errors > 0) {
            $this->warn("Errors: {$errors}");
        }

        return 0;
    }

    /**
     * Process a single image using Node.js sharp library
     */
    private function processImage($inputPath, $outputPath)
    {
        $nodeScript = base_path('node_modules/.bin/sharp-cli');

        // Create a temporary Node.js script
        $scriptPath = storage_path('app/minify-image.js');

        $script = <<<'JS'
const sharp = require('sharp');
const inputPath = process.argv[2];
const outputPath = process.argv[3];

sharp(inputPath)
  .resize(200, 200, {
    fit: 'inside',
    withoutEnlargement: true
  })
  .webp({
    quality: 80,
    effort: 6
  })
  .toFile(outputPath)
  .then(() => {
    process.exit(0);
  })
  .catch(err => {
    console.error(err);
    process.exit(1);
  });
JS;

        file_put_contents($scriptPath, $script);

        $command = sprintf(
            'node %s %s %s 2>&1',
            escapeshellarg($scriptPath),
            escapeshellarg($inputPath),
            escapeshellarg($outputPath)
        );

        exec($command, $output, $returnCode);

        return $returnCode === 0;
    }
}
