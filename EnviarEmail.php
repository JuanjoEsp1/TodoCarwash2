<?php
$nombreCliente = $_POST['nombreCliente'];
$emailCliente  = $_POST['emailCliente'];
$msjCliente    = $_POST['msjCliente'];



$from = "juanjomarles@gmail.com";
$to = '$emailCliente';
$subject = "Hello Sendmail";
$message = "This is an test email to test Sendmail. Please do not block my account.";
$headers = [ "From: $from" ];

mail( $to, $subject, $message, implode( '\r\n', $headers ) );
// OR - PHP 7.2.0 or greater
//mail( $to, $subject, $message, $headers );

echo "<script>
    window.location='index.php';
</script>";

?>