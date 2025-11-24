<?php

namespace App\Http\Livewire\Event\Legitimation\Evidence;

use App\Models\Event\Evidencetype;
use Livewire\Component;
use Livewire\WithPagination;

class Types extends Component
{
    use WithPagination;

    public $search;

    public function UpdatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $evidences = Evidencetype::where('name', 'like', "%$this->search%")->paginate(10);
        return view('livewire.event.legitimation.evidence.types', compact('evidences'));
    }
}
