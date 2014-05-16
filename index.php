<?php
# Hay muchas copias por ahí pero parece ser que la idea original viene de
# http://davidwalsh.name/gmail-php-imap

$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
$username = 'gibtsnicht@gmail.com';
$password = 'DasIstNetMeinKennwortDuScherzkeks';

try {
    $inbox = imap_open($hostname,$username,$password) or die('Error al conectarse a GMail: ' . imap_last_error());
} catch(Exception $e) {
    echo 'Debes tener la lib IMAP para PHP instalada';
}

$emails = imap_search($inbox, 'ALL SUBJECT "Notificacion de Compra en Comercio"');

if($emails) {	
    foreach($emails as $email_number) {
	    $overview = imap_fetch_overview($inbox,$email_number,0);
	    $message = imap_fetchbody($inbox,$email_number,1);
	    echo '<pre>';
        var_dump($message);
		echo '</pre>';
	}
} 
imap_close($inbox);
?>
