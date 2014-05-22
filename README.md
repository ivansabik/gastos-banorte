Buynorthe
===================

Pequeña clase con app de ejemplo para obtener las notificaciones de compra de Banorte que se envían al mail.
Banorte y otros bancos tienen un servicio en el que envían a tu mail una notificación cada vez que se realiza alguna compra con tu tarjeta, ahí mismo ponen el monto, la fecha y el lugar.
Este mail tiene un formato de HTML lo cuál lo hace todavía más fácil de parsear con algunas extensiones nativas o librerías.

Se necesita IMAP para PHP, en ubuntuni es con:

    sudo apt-get install php5-imap

Crear un archivo ```auth.config```, esto porque está en el .gitgnore para los más weyes como Johny les evita problemas de subir contraseñas y usuarios al Git.
También se podría poner en otra carpeta que esté fuera de la del server. El archivo es así:

```
    <?php
        define('nutzer', '<Vuestro usuario de GMail>@gmail.com');
        define('kenn', '<Password súper secreto>');
    ?>
```

### TODO

 - Usar OAuth si hay para GMail, IMAP nein
 - Exportar a CSV / Excel / Pdf
 - Estadísticas de lugares, fechas, montos