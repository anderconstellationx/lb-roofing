@extends('new-template.layouts.email')
@section('content')
    <div>
        <div class="u-row-container" style="padding: 0px;background-color: transparent">
            <div class="u-row"
                 style="margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                <div
                    style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                    <!--[if (mso)|(IE)]>
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td style="padding: 0px;background-color: transparent;" align="center">
                                <table cellpadding="0" cellspacing="0" border="0" style="width:600px;">
                                    <tr style="background-color: #ffffff;"><![endif]-->

                    <!--[if (mso)|(IE)]>
                    <td align="center" width="600"
                        style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"
                        valign="top"><![endif]-->
                    <div class="u-col u-col-100"
                         style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                        <div style="height: 100%;width: 100% !important;">
                            <!--[if (!mso)&(!IE)]><!-->
                            <div
                                style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                                <!--<![endif]-->

                                <table id="u_content_text_87" style="font-family:'Montserrat',sans-serif;"
                                       role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                    <tbody>
                                    <tr>
                                        <td style="overflow-wrap:break-word;word-break:break-word;padding:30px 10px 10px 15px;font-family:'Montserrat',sans-serif;"
                                            align="left">

                                            <div class="v-text-align"
                                                 style="font-size: 14px; color: #34495e; line-height: 140%; text-align: left; word-wrap: break-word;">
                                                <p style="font-size: 14px; line-height: 140%;"><span
                                                        style="font-size: 16px; line-height: 22.4px;"><strong><span
                                                                style="font-family: Montserrat, sans-serif; line-height: 22.4px; font-size: 16px;">{{ __('lang.user.hi', ['name' => $quote->proyecto->usuario_cliente->getCompleteName()]) }},</span></strong></span>
                                                </p>
                                            </div>

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                                <table id="u_content_text_88" style="font-family:'Montserrat',sans-serif;"
                                       role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                    <tbody>
                                    <tr>
                                        <td style="overflow-wrap:break-word;word-break:break-word;padding:0px 10px 10px 15px;font-family:'Montserrat',sans-serif;"
                                            align="left">

                                            <div class="v-text-align"
                                                 style="font-size: 14px; color: #34495e; line-height: 150%; text-align: left; word-wrap: break-word;">
                                                <p style="font-size: 14px; line-height: 150%;"><span
                                                        style="font-family: Lato, sans-serif; font-size: 14px; line-height: 21px;"><span
                                                            style="font-size: 16px; line-height: 24px;">{{ $messageClient }}</span></span>
                                                </p>
                                            </div>

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                                <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                        </div>
                    </div>
                    <!--[if (mso)|(IE)]></td><![endif]-->
                    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                </div>
            </div>
        </div>


        <div class="u-row-container" style="padding: 0px;background-color: transparent">
            <div class="u-row"
                 style="margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                <div
                    style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                    <!--[if (mso)|(IE)]>
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td style="padding: 0px;background-color: transparent;" align="center">
                                <table cellpadding="0" cellspacing="0" border="0" style="width:600px;">
                                    <tr style="background-color: #ffffff;"><![endif]-->

                    <!--[if (mso)|(IE)]>
                    <td align="center" width="600"
                        style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"
                        valign="top"><![endif]-->

                    <!--[if (mso)|(IE)]></td><![endif]-->
                    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                </div>
            </div>
        </div>


        <div class="u-row-container" style="padding: 0px;background-color: transparent">
            <div class="u-row"
                 style="margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                <div
                    style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                    <!--[if (mso)|(IE)]>
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td style="padding: 0px;background-color: transparent;" align="center">
                                <table cellpadding="0" cellspacing="0" border="0" style="width:600px;">
                                    <tr style="background-color: #ffffff;"><![endif]-->

                    <!--[if (mso)|(IE)]>
                    <td align="center" width="600"
                        style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"
                        valign="top"><![endif]-->
                    <div class="u-col u-col-100"
                         style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                        <div style="height: 100%;width: 100% !important;">
                            <!--[if (!mso)&(!IE)]><!-->
                            <div
                                style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                                <!--<![endif]-->

                                <table style="font-family:'Montserrat',sans-serif;" role="presentation"
                                       cellpadding="0" cellspacing="0" width="100%" border="0">
                                    <tbody>
                                    <tr>
                                        <td style="overflow-wrap:break-word;word-break:break-word;padding:10px 10px 30px 15px;font-family:'Montserrat',sans-serif;"
                                            align="left">

                                            <div class="v-text-align"
                                                 style="font-size: 14px; line-height: 140%; text-align: left; word-wrap: break-word;">
                                                <p style="font-size: 14px; line-height: 140%;"><span
                                                        style="font-size: 16px; line-height: 22.4px;">{{ __('lang.thanks') }},</span><br/><span
                                                        style="font-size: 16px; line-height: 22.4px;">{{ $quote->proyecto->usuario_cliente->getCompleteName() }}</span>
                                                </p>
                                            </div>

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                                <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                        </div>
                    </div>
                    <!--[if (mso)|(IE)]></td><![endif]-->
                    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                </div>
            </div>
        </div>

    </div>
@endsection
