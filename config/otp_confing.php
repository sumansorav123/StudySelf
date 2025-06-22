<?php
        $mail->isSMTP();
        $mail->Host = 'smtp.zoho.in';
        $mail->SMTPAuth = true;
        $mail->Username = "studyself@zohomail.in"; // sender email
        $mail->Password = 'mgPX Rf5W BQPM';     // app password
        $mail->SMTPSecure = 'TLS';
        $mail->Port = 587;
?>