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
                                                                style="font-family: Montserrat, sans-serif; line-height: 22.4px; font-size: 16px;">{{ __('lang.user.hi', ['name' => $factura->proyecto->usuario_cliente->getCompleteName()]) }},</span></strong></span>
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
                                                            style="font-size: 16px; line-height: 24px;">{{ __('lang.messagePaid') }}</span></span>
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
                    <div class="u-col u-col-100"
                         style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                        <div
                            style="height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                            <!--[if (!mso)&(!IE)]><!-->
                            <div
                                style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                <!--<![endif]-->

                                <table style="font-family:'Montserrat',sans-serif;" role="presentation"
                                       cellpadding="0" cellspacing="0" width="100%" border="0">
                                    <tbody>
                                    <tr>
                                        <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:'Montserrat',sans-serif;"
                                            align="left">

                                            <!--[if mso]>
                                            <style>.v-button {
                                                background: transparent !important;
                                            }</style><![endif]-->
                                            <div class="v-text-align" align="center">
                                                <!--[if mso]>
                                                <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml"
                                                             xmlns:w="urn:schemas-microsoft-com:office:word"
                                                             href="{{ route('show-invoice', ['uuid' => $factura->uuid]) }}"
                                                             style="height:37px; v-text-anchor:middle; width:107px;"
                                                             arcsize="11%" stroke="f" fillcolor="#6259ca">
                                                    <w:anchorlock/>
                                                    <center style="color:#FFFFFF;"><![endif]-->
                                                <a href="{{ route('show-invoice', ['uuid' => $factura->uuid]) }}"
                                                   target="_blank" class="v-button"
                                                   style="box-sizing: border-box;display: inline-block;text-decoration: none;-webkit-text-size-adjust: none;text-align: center;color: #FFFFFF; background-color: #6259ca; border-radius: 4px;-webkit-border-radius: 4px; -moz-border-radius: 4px; width:auto; max-width:100%; overflow-wrap: break-word; word-break: break-word; word-wrap:break-word; mso-border-alt: none;border-top-width: 0px; border-top-style: solid; border-top-color: #CCC; border-left-width: 0px; border-left-style: solid; border-left-color: #CCC; border-right-width: 0px; border-right-style: solid; border-right-color: #CCC; border-bottom-width: 0px; border-bottom-style: solid; border-bottom-color: #CCC;font-size: 14px;">
                                                        <span style="display:block;padding:10px 20px;line-height:120%;"><span
                                                                style="line-height: 16.8px;">{{ __('lang.click_here') }}</span></span>
                                                </a>
                                                <!--[if mso]></center></v:roundrect><![endif]-->
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
                                                        style="font-size: 16px; line-height: 22.4px;">{{ $factura->proyecto->usuario_cliente->getCompleteName() }}</span>
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
