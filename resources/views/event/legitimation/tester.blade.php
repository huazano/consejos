<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @foreach ($users as $user)
    <div style="height:100px margin-top:20px">
        <div style="float:left;">
            <img src="{{env('APP_URL')}}/img/logo-suterm.png" style="width:130px">
        </div>
        <div style="float:right;">
            <img src="{{env('APP_URL')}}/img/logo-legitimacion.png" style="width:260px">
        </div>
    </div>
    <div style="text-align: center; font-weight:bold; padding: 15px 0 15px 0">SINDICATO ÚNICO DE TRABAJADORES
        ELECTRICISTAS DE LA REPÚBLICA
        MEXICANA</div>
    <div
        style="background:rgb(255, 237, 237);border: 1px solid red; text-align:center; font-weight:bold; color:black; padding: 5px 0 5px 0">
        CEDULA DE
        IDENTIFICACIÓN PARA
        TRABAJADOR TEMPORAL
        PARA LA
        LEGITIMACIÓN DEL CONTRATO COLECTIVO DE TRABAJO</div>

    <table>
        <tr>

            <td style="width:500px">
                <div
                    style="background:rgb(255, 237, 237); border: 1px solid red; margin-top:20px;border-radius: 15px; padding:10px 5px">
                    <table style="width:100%">
                        <tr>
                            <td style="text-align: center; text-transform:uppercase; font-weight:bold">{{$user->name}}
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center">NOMBRE</td>
                        </tr>
                    </table>
                </div>
            </td>
            <td style="padding-top:20px; padding-left: 70px"><img
                    src="{{env('APP_URL')}}/{{Storage::url($user->profile_photo_path)}}"
                    style="width:70px; height:70px"></td>
        </tr>
    </table>

    <table style="width:100%">

        <tr>
            <td>
                <div
                    style="background:rgb(255, 237, 237); border: 1px solid red; margin-top:20px;border-radius: 15px; padding:10px 5px float:left; width:400px">
                    <table style="width:100%">
                        <tr>
                            <td style="text-align: center; text-transform:uppercase; font-weight:bold">{{$user->curp}}
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center">CURP (Clave única de registro de población)</td>
                        </tr>
                    </table>
                </div>
            </td>
            <td rowspan="2">
                <img
                    src="data:image/svg+xml;base64, {!!base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate($user->qr??$user->username))!!}">
            </td>
        </tr>
        <tr>
            <td>
                <div
                    style="background:rgb(255, 237, 237); border: 1px solid red; margin-top:20px;border-radius: 15px; padding:10px 5px float:left; width:400px">
                    <table style="width:100%">
                        <tr>
                            <td style="text-align: center; font-weight:bold; text-transform:uppercase">
                                {{$user->username}}</td>
                        </tr>
                        <tr>
                            <td style="text-align: center">RTT (Registro temporal de trabajador)</td>
                        </tr>
                    </table>
                </div>
            </td>
            <td></td>
        </tr>
    </table>

    <div style="font-size:12px; margin-top:10px">
        El presente documento se expide con la finalidad de garantizar la participación del trabajador(a) temporal
        sindicalizado arriba citado en el proceso de Legitimación del Contrato Colectivo de Trabajo CFE-SUTERM con
        número de expediente CC-7/1984-XXII-RM(1)01-V-1984, el cual se llevará a cabo el día 1 de diciembre de 2021
        acorde
        al Protocolo de Legitimación emitido por la el Centro Federal de Conciliación y Registro Laboral.
    </div>
    <div style="font-size:12px;font-style: italic; font-weight:bold; margin-bottom:400px">Este documento se expide
        exclusivamente para los
        fines
        mencionados,
        cuya vigencia se
        limita al día de la
        consulta de legitimación.</div>
    @endforeach

</body>

</html>