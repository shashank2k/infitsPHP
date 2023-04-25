<?php
// $server = "127.0.0.1:3306";
// $username = "root";
// $password = "";
// $database = "infits";
// Create connection
// $conn = mysqli_connect($server, $username, $password, $database);

// if ($conn->connect_error) {
//    die("Connection failed: " . $conn->connect_error);
// }

// //sending mail in php?

//          $to = "bhattshashank18@gmail.com";
//          $subject = "This is subject";
         
//          $message = "<b>This is HTML message.</b>";
//          $message .= "<h1>This is headline.</h1>";

// $header = "From:2002atulgarg@gmail.com \r\n";
// // $header .= "Cc:2002atulgarg@gmail.com \r\n";
// // $header .= "MIME-Version: 1.0\r\n";
// // $header .= "Content-type: text/html\r\n";
         
//          $retval = mail ($to,$subject,$message,$header);
         
//          if( $retval == true ) {
//             echo "Message sent successfully...";
//          }else {
//             echo "Message could not be sent...";
//          }

    /* Source: http://www.apphp.com/index.php?snippet=php-get-remote-ip-address */
   $to = 'bhattshashank18@gmail.com';
   $subject = 'Test Email';
   $body = 'Body of your message here. You can use HTML tags also, e.g. <br><b>Bold</b>';
   $headers = 'From: John Smith'."\r\n";
   $headers .= 'Reply-To: bhattshashank18@gmail.com'."\r\n";
   $headers .= 'Return-Path: bhattshashank18@gmail.com'."\r\n";
   $headers .= 'X-Mailer: PHP5'."\n";
   $headers .= 'MIME-Version: 1.0'."\n";
   $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
   ini_set('SMTP', 'smtp.gmail.com');
   ini_set('smtp_port', 587);

    mail($to, $subject, $body, $headers);
    


      ?>