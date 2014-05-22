<?php

# http://davidwalsh.name/gmail-php-imap

require_once './auth.config';
require_once __DIR__ . '/vendor/autoload.php';

$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
$username = NUTZER;
$password = KENN;

try {
    $inbox = imap_open($hostname, $username, $password) or die('Error imap GMail: ' . imap_last_error());
} catch (Exception $e) {
    echo 'Debes tener la lib IMAP para PHP instalada: <p></p><pre>' . $e . '</pre>';
}

$emails = imap_search($inbox, 'ALL SUBJECT "Notificacion de Compra en Comercio"');

$mailexanders = array();
if ($emails) {
    foreach ($emails as $email_number) {
        $message = imap_fetchbody($inbox, $email_number, 1);
        $mailexanders[] = $message;
    }
    imap_close($inbox);
    # Para todos los mensajes
    $hunter = new \Ivansabik\DomHunter\DomHunter();

    foreach ($mailexanders as $delarge) {
        $hunter->strHtmlObjetivo = $delarge;
        $presas = array();
        $presas[] = array('id_compra', new Ivansabik\DomHunter\IdUnico(6, 'num'));
        $presas[] = array('operacion', new Ivansabik\DomHunter\KeyValue('Operacion:', TRUE, TRUE));
        $presas[] = array('fecha_hora', new Ivansabik\DomHunter\KeyValue('Fecha y hora de la operacion'));
        $presas[] = array('fecha_aplicacion', new Ivansabik\DomHunter\KeyValue('Fecha de Aplicacion'));
        $presas[] = array('monto', new Ivansabik\DomHunter\KeyValue('Importe'));
        $presas[] = array('canal_operacion', new Ivansabik\DomHunter\KeyValue('Canal de operacion'));

        $hunter->arrPresas = $presas;
        echo '<pre>';
        print_r($hunter->hunt());
        echo '</pre>';
    }
    # Cada mensaje
} else {
    'No hay mails';
}
?>