<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nueva donación recibida</title>
</head>
<body>
<table class="inner-body" role="presentation" width="100%"
       style="background:#eeeeee;border:none;border-spacing:0;margin:0;padding:0;text-align:center;">
    <tbody>
    <tr>
        <td style="background:white;border-bottom:1px solid #cccccc;border-top:12px solid #cf150a;border-top-color:#000;color:#4d4d4d;font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:18px;margin:0;padding:15px 0px;text-align:center">
            <table style="border:none;border-spacing:0;margin:0;padding:0;text-align:center;width:100%">
                <tbody>
                <tr>
                    <td style="color:#4d4d4d;font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:18px;margin:0;padding:10px 0;text-align:center">
                        <table style="border:none;border-spacing:0;margin:0;padding:0;text-align:center;width:100%">
                            <tbody>
                            {{--LOGO--}}
                            <tr>
                                <td style="color:#4d4d4d;font-family:'helvetica neue',helvetica,arial,sans-serif;margin:0;padding:30px 0;text-align:center">
                                    <img style="border:none" width="130" alt="Living Room logo"
                                         src="{{ asset('img/logo-livingroom-negro.png') }}">
                                </td>
                            </tr>
                            {{--END LOGO--}}
                            {{--COMMUNITY NAME--}}
                            <tr>
                                <td style="color:#4d4d4d;font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:18px;margin:0;padding:10px 0;text-align:center">
                                    <h1 style="color:#4d4d4d;font-family:'helveticaneuemedium',helvetica,arial,sans-serif;font-size:30px;margin:30px 0;margin-bottom:5px;margin-top:0px;text-align:center">
                                        ¡Donación online recibida!
                                    </h1>
                                </td>
                            </tr>
                            {{--END COMMUNITY NAME--}}
                            </tbody>
                        </table>
                        <hr style="border:none;border-bottom:1px solid #e5e5e6;margin-bottom:0px;max-width:412px;width:70%">
                    </td>
                </tr>
                <tr>
                    <td style="color:#4d4d4d;font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:18px;margin:0;padding:10px 0;padding-bottom:5px;padding-top:0px;text-align:center">
                        <table style="border:none;border-spacing:0;margin:0;padding:0;text-align:center;width:100%">
                            <tbody>
                            <tr>
                                {{--DATE--}}
                                <td style="border-right:1px solid #dddddd;color:#4d4d4d;font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:16px;margin:0;padding:10px 0;padding-bottom:8px;padding-right:10px;padding-top:4px;text-align:right;width:50%">
                                    {{ $date }}
                                </td>
                                {{--END DATE--}}
                                {{--REFERENCE CODE--}}
                                <td style="color:#4d4d4d;font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:16px;margin:0;padding:10px 0;padding-bottom:8px;padding-left:10px;padding-top:4px;text-align:left;width:50%">
                                    Donación Online
                                </td>
                                {{--END REFERENCE CODE--}}
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td style="color:#4d4d4d;font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:18px;margin:0;padding:10px 0;padding-top:0px;text-align:center">
            <center>
                <table
                    style="border:none;border-spacing:0;margin-top:50px;max-width:550px;padding:0;text-align:center;width:90%">
                    <tbody>
                    <tr>
                        <td style="color:#4d4d4d;font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:18px;margin:0;padding:10px 0;text-align:center">
                            {{--TRANSACTION TABLE--}}
                            <table
                                style="background:#f7f7f8;border:1px solid #cccccc;border-radius:4px;border-spacing:0;border-top:6px solid #cf150a;border-top-color:#000;margin:0;margin-bottom:30px;padding:0;padding-bottom:15px;text-align:center;width:100%">
                                <tbody>
                                <tr>
                                    <td style="background:white;border-bottom:1px solid #e5e5e6;color:#4d4d4d;font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:20px;font-weight:normal;margin:0;padding:24px 0px 28px 0px;padding-left:0;text-align:center"
                                        colspan="2">
                                        El monto de la donación <br>
                                        <span><strong>{{ $currency . ' ' . $amount }}</strong></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="color:#4d4d4d;font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:16px;padding:25px 55px;text-align:left">
                                        Destino
                                    </th>
                                    <td style="color:#4d4d4d;font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:16px;margin:0;padding:25px 55px;padding-left:0;text-align:left">
                                        {{ $type }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color:#4d4d4d;font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:16px;margin:0;padding:0px 10px;padding-left:0;text-align:left"
                                        colspan="2">
                                        <hr style="border:none;border-bottom:1px solid #e5e5e6;margin:0 auto;max-width:540px;width:90%">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="color:#4d4d4d;font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:16px;padding:25px 55px;text-align:left">
                                        Método de pago
                                    </th>
                                    <td style="color:#4d4d4d;font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:16px;margin:0;padding:25px 55px;padding-left:0;text-align:left">
                                        {{ $method }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color:#4d4d4d;font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:16px;margin:0;padding:0px 10px;padding-left:0;text-align:left"
                                        colspan="2">
                                        <hr style="border:none;border-bottom:1px solid #e5e5e6;margin:0 auto;max-width:540px;width:90%">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="color:#4d4d4d;font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:16px;padding:25px 55px;text-align:left">
                                        Donante
                                    </th>
                                    <td style="color:#4d4d4d;font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:16px;margin:0;padding:25px 55px;padding-left:0;text-align:left">
                                        {{ $giver }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color:#4d4d4d;font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:16px;margin:0;padding:0px 10px;padding-left:0;text-align:left"
                                        colspan="2">
                                        <hr style="border:none;border-bottom:1px solid #e5e5e6;margin:0 auto;max-width:540px;width:90%">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="color:#4d4d4d;font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:16px;padding:25px 55px;text-align:left">
                                        Documento
                                    </th>
                                    <td style="color:#4d4d4d;font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:16px;margin:0;padding:25px 55px;padding-left:0;text-align:left">
                                        {{ $documentType . ' ' . $document }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color:#4d4d4d;font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:16px;margin:0;padding:0px 10px;padding-left:0;text-align:left"
                                        colspan="2">
                                        <hr style="border:none;border-bottom:1px solid #e5e5e6;margin:0 auto;max-width:540px;width:90%">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="color:#4d4d4d;font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:16px;padding:25px 55px;text-align:left">
                                        País
                                    </th>
                                    <td style="color:#4d4d4d;font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:16px;margin:0;padding:25px 55px;padding-left:0;text-align:left">
                                        {{ $country }}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            {{--END TRANSACTION TABLE--}}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </center>
        </td>
    </tr>
    {{--FOOTER--}}
    <tr>
        <td style="color:#4d4d4d;font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:18px;margin:0;padding:0;text-align:center">
            <hr style="border:none;border-bottom:1px solid #cccccc;max-width:480px;width:90%">
            <table
                style="border:none;border-spacing:0;padding:0;text-align:center;width:350px;margin:auto auto 30px;">
                <tbody>
                <tr>
                    <td style="color:#999999;font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:13px;margin:0;padding:10px 0;text-align:center">
                        Razón social de la organización: <span>Fundación LVR Global</span></td>
                </tr>
                <tr>
                    <td style="color:#999999;font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:11px;margin:0;padding:10px 0;text-align:center">
                        No se entregaron bienes o servicios a cambio de la contribución enumerada, excepto los
                        beneficios espirituales intangibles.
                    </td>
                </tr>
                <tr>
                    <td style="color:#999999;font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:11px;margin:0;padding:10px 0;text-align:center">
                        Las donaciones y obsequios a Fundación LVR Global (Living Room) se consideran no
                        reembolsables.
                        <br>
                        La política de reembolso para eventos específicos, o por bienes o servicios recibidos, se
                        determina de acuerdo con la naturaleza del evento, bien o servicio.
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    {{--END FOOTER--}}
    </tbody>
</table>
</body>
</html>
