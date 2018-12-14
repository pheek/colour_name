#!/bin/bash
#
# 2018-05-15 philipp.gressly@santismail.ch

#
# Beschreibung:
#  * Erzeuge Datenbank (lösche vorab, falls schon vorhanden).
#  * Erzeuge alle Tabellen (schema)
#  * Erzeuge Stammdaten und Demodaten
#  * Erzeuge Views und Triggers
#

#
# Damit die folgenden Aufrufe ohne -u user und ohne -p (interaktive Passworteingabe) laufen,
# muss in der mysql-Konfiguration (my.conf) der root-user und das root-Passwort eingetragen werden:
#   ...
#   [client]
#   user=root
#   password="*****"
#

#
# Der DB-User ist im Verzeichnis ../credentials in der Datei grant.sql eingetragen.
# Dieser muss nur einmal erzeugt werden, auch wenn die DB zwischenzeitlich gelöscht oder neu
# angelegt wird.
#
. ./bash_sql_insert.sh

mysqlImport 10_create_db.sql             'Datenbank erzeugen'
mysqlImport 11_addUser.sql               'Programm-User anlegen'
mysqlImport 20_schema_und_stammdaten.sql 'Schema und Stammdaten anlegen'
mysqlImport 30_demodata.sql              'Demodaten einfügen'
mysqlImport 40_views.sql                 'Views anlegen'
mysqlImport 50_stored_procedures.sql     'Stored Procedures anlegen'
mysqlImport 60_demo_nominationen.sql     'Demo Nominationen erzeugen'
