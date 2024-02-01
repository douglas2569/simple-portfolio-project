<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailController extends Controller
{
    public $response = [
        'error'=>'',
        'data'=> [

        ]
    ];


    public function send(Request $request){

        $validated = $request->validate([
            'to' => 'required|string|max:255',
            'subject' => 'required|string|max:100',
            'message' => 'required|string|max:1600'
        ]);

        $mail = new PHPMailer(true);

        try {
            $mail->SMTPSecure = 'plain';
            $mail->isSMTP();
            $mail->Host = env('MAIL_HOST');
            $mail->Port = env('MAIL_PORT');
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->SMTPSecure = env('MAIL_ENCRYPTION');
            $mail->setFrom(env('MAIL_FROM_ADDRESS'));

            $mail->isHTML(true);
            $mail->CharSet = 'utf-8';
            $mail->FromName = env('MAIL_FROM_NAME');

            $mail->Subject = $validated['subject'];
            $mail->Body    = $validated['message'];
            $mail->addAddress($validated['to']);

            if( !$mail->send() ) {
                $this->response['error'] = "Email not sent: ".$mail->ErrorInfo;
            }

        } catch (Exception $th) {
            $this->response['error'] = $th->getMessage();
        }

        return json_encode($this->response);

    }
}
