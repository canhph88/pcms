<?php
/**
 * Created by PhpStorm.
 * User: SSTVN
 * Date: 9/5/16
 * Time: 9:48 AM
 */

namespace App\Core\Libraries;


class Utilconstant {
    /* Incident status */
    const INCIDENT_TYPE_ADDITIONAL   = "Additional";
    const INCIDENT_TYPE_FIR          = "FIR";
    const INCIDENT_FINAL_REPORT      = "FinalReport";

    /*Audit module*/
    const AUDIT_MODULE_INCIDENT              = "Incident";
    const AUDIT_MODULE_BROADCAST             = "Broadcast";
    const AUDIT_MODULE_PROFILE               = "User";
    const AUDIT_ACTION_CREATE                = "Create";
    const AUDIT_ACTION_EDIT                  = "Edit";
    const AUDIT_ACTION_RESET                 = "Reset";
    const AUDIT_ACTION_REMOVE                = "Remove";
    const AUDIT_ACTION_EXECUTED              = "Executed";
    const AUDIT_ACTION_SEND                  = "Send";

    /*related_object*/
    const RELATED_OBJECT                     = "Incidents";

    /* Queues */
    const BROADCAST_QUEUE                    = 'BROADCAST_QUEUE';
    const EMAIL_QUEUE                        = 'EMAIL_QUEUE';
    const NOTIFICATION_QUEUE                 = 'NOTIFICATION_QUEUE';
    const SMS_QUEUE                          = 'SMS_QUEUE';
    const PUSH_QUEUE                         = 'PUSH_QUEUE';

    /* Broadcast status */
    const INCIDENT_STATUS                    = ['OPEN', 'DRAFT', 'PENDING_INVESTIGATION', 'CLOSED'];
    const BROADCAST_STATUS                   = ['DRAFT', 'IN_PROGRESS', 'COMPLETED', 'FAILED'];
    const SEND_STATUS                        = ['UNSEND', 'PROCESSING', 'SENT', 'FAILED', 'DELIVERED', 'READ'];

    /* SMS status */
    const SMS_STATUS                        = ['SUCCESS', 'INVALID_REQUEST', 'UNAUTHORIZED', 'SYSTEM_ERROR',
        'INVALID_MOBILE_NUMBER', 'INSUFFICIENT_CREDIT', 'UNSENT', 'UNUSED', 'BLACKLIST'];

    const EMAIL_TEMPLATE_DEFAULT             = '<html>
                                                <head>
                                                    <style>
                                                        body{text-align: center;
                                                            font-family:"Lucida Grande",Verdana,Arial,Helvetica,
                                                            sans-serif;
                                                            font-size:12px;
                                                            color:#333;
                                                        }
                                                        .mail-wrapper{border: 4px solid #cbe5f4; margin: auto; padding: 10px;}
                                                        .mail-body{text-align: left;}
                                                        .mail-body a{color: #0069a6; text-decoration: underline; cursor: pointer;}
                                                        .mail-head{ text-align: center;}
                                                        .footer{text-align: center;}
                                                    </style>
                                                </head>
                                                <body>
                                                    <div class="mail-wrapper">
                                                        <div class="mail-head" style="text-align: center;">
                                                            <div>
                                                                <img src="https://imssentosa.com/img/sentosa_logo.png">
                                                            </div>
                                                            <div class="address">
                                                                39 Artillery Avenue, Sentosa Singapore 099958
                                                                <hr>
                                                            </div>
                                                        </div>
                                                        <div class="mail-body">
                                                [^email_body]
                                                        </div>
                                                        <div style="text-align: center;">
                                                            <img src="https://imssentosa.com/img/NewEnvironment.png">  <br>
                                                        </div>
                                                    </div>
                                                </body>
                                                </html>';

    const EMAIL_TEMPLATE_FIR                 = '<html>
                                                <head>
                                                    <style>
                                                        body{text-align: center;
                                                            font-family:"Lucida Grande",Verdana,Arial,Helvetica,
                                                            sans-serif;
                                                            font-size:12px;
                                                            color:#333;
                                                        }
                                                        .mail-wrapper{border: 4px solid #cbe5f4; margin: auto; padding: 10px;}
                                                        .mail-body{text-align: left;}
                                                        .mail-body a{color: #0069a6; text-decoration: underline; cursor: pointer;}
                                                        .mail-head{ text-align: center;}
                                                        .footer{text-align: center;}
                                                    </style>
                                                </head>
                                                <body>
                                                    <div class="mail-wrapper">
                                                        <div class="mail-head" style="text-align: center;">
                                                            <div>
                                                                <img src="https://imssentosa.com/img/sentosa_logo.png">
                                                            </div>
                                                            <div class="address">
                                                                39 Artillery Avenue, Sentosa Singapore 099958
                                                                <hr>
                                                            </div>
                                                        </div>
                                                        <div class="mail-body">
                                                [^email_body]
                                                        </div>
                                                        <div style="text-align: center;">
                                                            <img src="https://imssentosa.com/img/NewEnvironment.png">  <br>
                                                        </div>
                                                    </div>
                                                </body>
                                                </html>';
}
