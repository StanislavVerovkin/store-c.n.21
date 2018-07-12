<?php

function send_mail($from, $to, $subject, $body)
{
    $charset = 'utf-8';
    mb_language('en');
    $headers = "MIME-Version: 1.0 \n";
    $headers .= "From: <" . $from . "> \n";
    $headers .= "Reply-To: <" . $from . "> \n";
    $headers .= "Content-Type: text/html; charset=$charset \n";
    $subject = '=?' . $charset . '?B?' . base64_encode($subject) . '?=';

    mail($to, $subject, $body, $headers);
}