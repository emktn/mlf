<?php

define('SENDER_EMAIL', 'no-reply@website.com');
define('RECEIVER_EMAIL', 'efrain@melimarketing.com');


/*
 * Common functions
 */

function sendMail($from, $to, $subject, $data) {

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: <'.$from.'>' . "\r\n";

    return mail($to, $subject, $data, $headers);
}

function giveEmailerHTML($data=[]) {
    $html = '<table cellpadding="2" cellspacing="5">';
    foreach ($data as $record) {
        $html .= '<tr>';
        $html .= '<th>'.$record['name'].'</th>';
        $html .= '<td>'.$record['value'].'</td>';
        $html .= '<tr>';
    }
    $html .= '</table>';
    return $html;
}

function input($str) {
    return stripslashes(trim($str));
}


if ($_POST && isset($_POST['submit'])) {

    $name = input($_POST['name']);
    $email = input($_POST['email']);
    $number = input($_POST['number']);
    $message = input($_POST['message']);

    $subject = 'New request from your website!';

    $data = array(
        array(
            'name' => 'Name:',
            'value' => $name
        ),
        array(
            'name' => 'Email:',
            'value' => $email
        ),
        array(
          'name' => 'Number:',
          'value' => $number
        ),
        array(
            'name' => 'Message:',
            'value' => $message
        )
    );

    $mail1 = sendMail(SENDER_EMAIL, RECEIVER_EMAIL, $subject, giveEmailerHTML($data));

    if($mail1) {
      //  echo json_encode(['success' => true]);
      header("Refresh:0; url=/");
    } else {
        echo json_encode(['success' => false]);
    }
}
