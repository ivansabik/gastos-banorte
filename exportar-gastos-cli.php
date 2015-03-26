#!/usr/bin/php -q
<?php

require_once __DIR__ . '/vendor/autoload.php';

define('GMAIL_HOST', '{imap.gmail.com:993/imap/ssl}INBOX');
define('DIR_EXPORTACION', './gastos/');

print 'Usuario Gmail: ';
$usuario = trim(fgets(STDIN));
print 'Password: ';
system('stty -echo');
$password = trim(fgets(STDIN));
system('stty echo');

echo PHP_EOL . 'Un momentito de paciencia, obteniendo mails con gastos...' . PHP_EOL;

try {
    $inbox = imap_open(GMAIL_HOST, $usuario, $password) or die('Error imap GMail: ' . imap_last_error() . PHP_EOL);
} catch (Exception $e) {
    echo 'Debes tener la lib IMAP para PHP instalada: ' . $e . PHP_EOL;
}

$emails = imap_search($inbox, 'ALL SUBJECT "Notificacion de Compra en Comercio"');

$mailexanders = array();
if ($emails) {
    foreach ($emails as $email) {
        $mensaje = imap_fetchbody($inbox, $email, 1);
        $mailexanders[] = $mensaje;
    }
    imap_close($inbox);
    $hunter = new \Ivansabik\DomHunter\DomHunter();
    $gastos = array();
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
        $gastos[] = $hunter->hunt();
    }
    $excel = new SimpleExcel\SimpleExcel('xml');
    $titulos = array('ID', 'Operación', 'Fecha / Hora', 'Fecha de aplicación', 'Monto', 'Canal de operación');
    $gastosConTitulos = $gastos;
    array_unshift($gastosConTitulos, $titulos);
    $excel->writer->setData($gastosConTitulos);
    
    $gastosJson = json_encode($gastos);
    $gastosExcel = $excel->writer->saveString();
    
    $archivoJson = DIR_EXPORTACION . $usuario . '.json';
    $archivoExcel = DIR_EXPORTACION . $usuario . '.xls';
    
    if (!is_dir(DIR_EXPORTACION)) {
        mkdir(DIR_EXPORTACION, 0777, true);
    }
    
    file_put_contents($archivoJson, $gastosJson);
    file_put_contents($archivoExcel, $gastosExcel);
    
    echo 'Gastos guardados en '. DIR_EXPORTACION . PHP_EOL;
} else {
    echo 'No hay mails con gastos!'. PHP_EOL;
}
?>
