<?php 
require APPROOT . '/libraries/vendor/autoload.php';

use simplehtmldom\HtmlWeb;
use \Mailjet\Resources;


function sendEmail($mail)
{

    $mj = new \Mailjet\Client('9979992263fb9d6499646df3dbdb1ff1', 'a8936fd96a52f84d74718056ece0800d', true, ['version' => 'v3.1']);
    $body = [
        'Messages' => [
            [
                'From' => [
                    'Email' => "contact@yuniss.com",
                    'Name' => SITENAME,
                ],
                'To' => [
                    [
                        'Email' => $mail['to'],
                        'Name' => $mail['to_name'],
                    ],
                ],
                'Subject' => 'Reset Password',
                'TextPart' => "",
                'HTMLPart' => $mail['html_content'],
                'CustomID' => "test",
            ],
        ],
    ];
    

    try {
        $response = $mj->post(Resources::$Email, ['body' => $body]);
    } catch (\Throwable $th) {
        echo($th);
    }
    // die(var_dump($mj->post(Resources::$Email, ['body' => $body])));

}