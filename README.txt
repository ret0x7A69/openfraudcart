++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
DEFAULT ADMIN ACCOUNT:
Admin:123456
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
API Verwendung
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
One Import:

cURL URL: /api/product/database/import
Parameters: key, product_id, content
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
Line-By-Line Import:

cURL URL: /api/product/database/lbl/import
Parameters: key, product_id, input
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
With Seperator Import:

cURL URL: /api/product/database/seperator/import
Parameters: key, product_id, input, seperator
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
Bitcoin Wallet Info:

cURL URL: /api/bitcoin/info
Parameters: key
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
SETUP INFOS

- Composer installieren, DocumentRoot auf /public Folder setzen
- DB Daten unter /.env eintragen

in Putty folgende Befehle ausführen:
- php artisan key:generate
- php artisan migrate

++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
Laravel Scheduler:

$ crontab -e
* * * * * php /full/path/public_html/artisan schedule:run >> /dev/null 2>&1
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
Configs:
mintxfee=0.001

Bitcoin Core:

$ apt-get update
$ apt-get upgrade
$ wget  https://bitcoin.org/bin/bitcoin-core-0.17.1/bitcoin-0.17.1-x86_64-linux-gnu.tar.gz
$ tar xzf bitcoin-0.17.1-x86_64-linux-gnu.tar.gz
$ install -m 0755 -o root -g root -t /usr/local/bin bitcoin-0.17.1/bin/*

$ bitcoind -daemon

Starten / Stoppen:
$ bitcoin-cli stop
$ bitcoin-cli start

Config: /root/.bitcoin/bitcoin.conf
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
