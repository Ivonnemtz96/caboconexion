<?php

// ENVIAMOS CORREO
$para  = $remail;

// título
$titulo = 'Verifica tu correo - CaboConexion';

// mensaje
$mensaje = '

<div class="row">
    <div class="col-lg-12">
        <table class="body-wrap" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: transparent; margin: 0;" bgcolor="transparent">
            <tr style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                <td style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
                    <td class="container" width="600" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top">
                    <div class="content" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
                        <table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action" itemscope itemtype="http://schema.org/ConfirmAction" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: transparent; margin: 0; border: 1px dashed #2F3B59;" bgcolor="#fff">
                            <tr style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                <td class="content-wrap" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;" valign="top">
                                    <meta itemprop="name" content="Confirm Email" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                        <table width="100%" cellpadding="0" cellspacing="0" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                            <tr style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                <td class="content-block" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; color: #000; font-size: 24px; font-weight: 700; text-align: center; vertical-align: top; margin: 0; padding: 0 0 10px;" valign="top">Bienvenido a</td>
                                            </tr>
                                            
                                            <tr>
                                                <td><a href="#"><img src="https://caboconexion.com/images/logo2.png" alt="" style="margin-left: auto; margin-right: auto; display:block; margin-bottom: 10px; height: 40px;"></a>
                                                </td>
                                            </tr>
                                            
                                            <tr style="text-align: center; font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                <td class="content-block" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; color: #222; font-size: 14px; vertical-align: top; margin: 0; padding: 10px 10px;" valign="top">Confirme su cuenta de correo electrónico haciendo clic en el enlace a continuación.</td>
                                            </tr>
                                            <tr style="text-align: center; font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                <td class="content-block" style=" color: #5d5d5d; font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 10px 10px;" valign="top">Es posible que necesitemos enviarte información importante a este correo.</td>
                                            </tr>
                                            <tr style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                <td class="content-block" itemprop="handler" itemscope style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 10px 10px;" valign="top">
                                                    <a target="_blank" href="https://caboconexion.com/verificar?token='.$linkEncrypt.'" style="color: #fff; background-color: #4DB7FE; border-color: #E2791C; font-size: 14px; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: block; border-radius: 5px; border: none; padding: 10px 20px;">Verificar mi cuenta</a>
                                                </td>
                                            </tr>
                                            <tr style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                <td class="content-block" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; padding-top: 5px; vertical-align: top; margin: 0; text-align: right;" valign="top">&mdash; <b>CaboConexion</b> - Panel de usuario</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table><!--end table-->
                        </div><!--end content-->
                    </td>
                 <td style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
            </tr>
        </table><!--end table-->
    </div><!--end col-->
</div>


';

// Para enviar un correo HTML, debe establecerse la cabecera Content-type
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Cabeceras adicionales
$cabeceras .= 'From: CaboConexion <noreply@caboconexion.com>' . "\r\n";

// Enviarlo
mail($para, $titulo, utf8_decode($mensaje), $cabeceras);


?>