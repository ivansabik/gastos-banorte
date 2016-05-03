Gastos Banorte
===================

Script en PHP (para línea de comandos por ahora) que parsea las notificaciones de compra de Banorte que se envían al mail.
Ej. de uso

```
moi@aussi:~/Desktop/buynorte$ php exportar-gastos-cli.php 
Usuario Gmail: juanito
Password: 
Un momentito de paciencia, obteniendo mails con gastos...
Gastos guardados en ./gastos/
```

Y se generan en JSON y Excel para que los uses a voluntad :D

### JSON

```
[
  {
    "id_compra": "000103",
    "operacion": "COMPRA EN SEARS WORLD TRADE",
    "fecha_hora": "18\/Dic      14:34:40  hrs.",
    "fecha_aplicacion": "18Dic\/2012",
    "monto": "$           593.30 MN",
    "canal_operacion": "TPV(COMPRA COMERCIO)"
  },
  {
    "id_compra": "000104",
    "operacion": "COMPRA EN REST PIOLA WTC",
    "fecha_hora": "21\/Dic      16:03:11  hrs.",
    "fecha_aplicacion": "21Dic\/2012",
    "monto": "$           265.00 MN",
    "canal_operacion": "TPV(COMPRA COMERCIO)"
  },
  [...]
]
```

### Excel

<img src="https://raw.githubusercontent.com/ivansabik/gastos-banorte/master/pantalla-excel.png">

### Requisitos

- Acceso a PHP por línea de comandos
- Acceso a IMAP con PHP de línea de comandos
- Access a system('stty echo') porque se usa para esconder el password

Setup en Ubuntu / Debian

```
sudo apt-get install php5
sudo apt-get install php5-imap
sudo gedit /etc/php5/cli/php.ini
```

Adicionalmente en el php.ini agregar la extensión ```imap.so```

### TODO

 - Estadísticas de lugares, fechas, montos


[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/ivansabik/gastos-banorte-json-excel/trend.png)](https://bitdeli.com/free "Bitdeli Badge")

