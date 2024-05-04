<?php

require '../Includes/connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

class send_mail{

    public $mail;

    public function __construct() {
        $this->mail = new PHPMailer(true);
        $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $this->mail->isSMTP();                                          //Send using SMTP
        $this->mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $this->mail->SMTPAuth   = true;                                 //Enable SMTP authentication
        $this->mail->Username   = 'sk.clothingpolonnaruwa@gmail.com';           //SMTP username
        $this->mail->Password   = 'gyog rorw bluk gssv';               //SMTP password
        $this->mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
        $this->mail->Port       = 465;      //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS
    
        // Set email content type to HTML
        $this->mail->isHTML(true);
    }

    public function send_mail($customer_name,$customer_email,$customer_otp){

        try {
            $this->mail->setFrom('sk.clothingpolonnaruwa@gmail.com','sk clothing');
            $this->mail->addAddress($customer_email);
            $this->mail->Subject = 'Verification Code for Registration: ' . $customer_name;
            $this->mail->Body = '
            <html>
            <head>
                <style>
                    /* Add your styles here */
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f2f2f2;
                        padding: 20px;
                        border-radius: 10px;
                    }
                    .container {
                        max-width: 600px;
                    }
                    h1 {
                        color: #333333;
                    }
                    p {
                        color: #666666;
                    }
                    .otp {
                        font-size: 20px;
                        font-weight: bold;
                        color: #ff6600;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <h1>Welcome to SK Clothing</h1>
                    <p>Dear ' . $customer_name . ',</p>
                    <p>Thank you for registering with us. Your OTP for registration is:</p>
                    <p class="otp">' . $customer_otp . '</p>
                    <p>Please use this OTP to complete your registration process.</p>
                    <p>Best regards,<br>SK Clothing Team</p>
                </div>
            </body>
            </html>
            ';
            
            $this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $this->mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: { $this->mail->ErrorInfo}";
        }
    }

    public function sendmailresetpassword($customer_email,$reset_link){
        try {
            $this->mail->setFrom('sk.clothingpolonnaruwa@gmail.com','sk clothing');
            $this->mail->addAddress($customer_email);    
            $this->mail->Subject = 'Reset Your password';
            $this->mail->Body = '
                <html>
                <head>
                    <style>
                        /* Add your CSS styles here */
                        body {
                            font-family: Arial, sans-serif;
                            background-color: #f4f4f4;
                            margin: 0;
                            padding: 0;
                        }
                        .container {
                            padding: 20px;
                            background-color: #ffffff;
                            border-radius: 10px;
                            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                            max-width: 600px;
                            margin: 0 auto;
                        }
                        .reset-link {
                            display: inline-block;
                            font-size: 18px;
                            color: #007bff;
                            text-decoration: none;
                            padding: 10px 20px;
                            border: 2px solid #007bff;
                            border-radius: 5px;
                            transition: all 0.3s ease;
                        }
                        .reset-link:hover {
                            background-color: #007bff;
                            color: #fff;
                        }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <p>Click the link to reset your password:</p>
                        <p><a class="reset-link" href="' . $reset_link . '">Reset Password</a></p>
                    </div>
                </body>
                </html>
            ';
            $this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $this->mail->send();
            $_SESSION['success'] = 'password reset link in your inbox please check your inbox.';
            header("location: ../loginPage.php");
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: { $this->mail->ErrorInfo}";
        }
    }
    
}

?>