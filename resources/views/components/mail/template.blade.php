<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Borrower Marketplace</title>
    <style type="text/css">
        a, a:active, a:link, a:visited {
            color: #000000;
            font-weight: bold;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .text-success {
            color: #28a745;
        }
        .text-warning {
            color: #fd7e14;
        }
        .text-danger {
            color: #dc3545;
        }
        .text-info {
            color: #007bff;
        }
        .bold, strong {
            font-weight: bold;
        }
        .table {
            width: 100%;
        }
        table {
            border-collapse: collapse!important;
            clear: both;
            margin-top: 6px !important;
            margin-bottom: 6px !important;
            max-width: none !important;
            border-spacing: 0;
        }
        table thead>tr>th {
            font-size: 1rem;
            font-weight: bold;
            vertical-align: bottom;
            border-bottom: 2px solid hsla(210,8%,51%,.13);
            text-align: left;
        }
        table td, table th {
            -webkit-box-sizing: content-box;
            box-sizing: content-box;
            vertical-align: top;
            /*border-top: 1px solid hsla(210,8%,51%,.13);*/
        }
        tr {
            margin-bottom: .2rem;
        }
        td.header {
            padding-top: 0.75rem;
        }
        td {
            font-size: 0.9rem !important;
        }
        td.body {
            padding: 0 .4rem .5rem 0;
        }
        td.w-40 {
            width: 40%;
        }
        td.w-50 {
            width: 50%;
        }
        td.w-60 {
            width: 60%;
        }
    </style>
</head>
<body style="margin:0; background: #f8f8f8; ">
    <div width="100%" style="background: #f8f8f8; padding: 0 0; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;">
        <div style="max-width: 700px; padding:50px 0;  margin: 0 auto; font-size: 14px">
            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 20px">
                <tbody>
                    <tr>
                        <td style="vertical-align: top; padding-bottom:30px;" align="center"><a href="{{ route('dashboard.index') }}" target="_blank"><img class="logo" src="{{ asset("img/ltt-light-layout-logo.png") }}" alt="Borrowers Marketplace - logo" style="border:none; max-height: 90px; max-width: 300px;" /></a></td>
                    </tr>
                </tbody>
            </table>
            <div style="padding: 40px; background: #fff;">
                <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                    <tbody>
                        <tr>
                            <td>
                                <div style="display: block; font-weight: normal;">
                                    {{ $slot }}
                                </div>
                                @if(isset($unsubscribe) && $unsubscribe != '')
                                    <x-mail.unsubscribe src="{{$unsubscribe}}" />
                                @endif
                                @if(!isset($noThankYou))
                                    <x-mail.div>
                                        If you have any questions, please email us at <a style="font-weight: bold; " href="mailto:admin@laratradtracker.com">admin@laratradtracker.com</a>. We are here to help!
                                    </x-mail.div>
                                    <x-mail.div>
                                        Thanks,
                                    </x-mail.div>
                                @endif
                                <b>{{ config('app.name') }} Team</b>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <x-mail.footer />
            @isset($track)
                <img src="{{ route('track.link', [$track, $id]) }}" style="width: 1px; height: 1px;"  width="1" height="1" border="0" onerror="this.src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII='">
            @endisset
        </div>
    </div>
</body>
</html>
