<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="x-apple-disable-message-reformatting" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="color-scheme" content="light dark" />
        <meta name="supported-color-schemes" content="light dark" />
        <link rel="stylesheet" href="{{asset('assets/css/emails.css')}}" />
        <title>@yield('title')</title>
    </head>

    <body>
        <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
            <tr>
                <td align="center">
                    <table class="email-content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                        <tr>
                            <td class="email-masthead">
                                <a href="{{config('app.url')}}" class="f-fallback email-masthead_name">
                                    <img src="{{asset('assets/GEM/images/logoImentet.png')}}" class="logo" style="margin-left: auto !important;" alt="Imentet">
                                </a>
                            </td>
                        </tr>
                        <!-- Email Body -->
                        <tr>
                            <td class="email-body" width="570" cellpadding="0" cellspacing="0">
                                <table class="email-body_inner" align="center" width="570" cellpadding="0"
                                    cellspacing="0" role="presentation">
                                    <!-- Body content -->
                                    <tr>
                                        @yield('content')
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                                    <tr>
                                        <td class="content-cell" align="center">
                                            <p class="f-fallback sub align-center">
                                                {{config('app.name')}}
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>