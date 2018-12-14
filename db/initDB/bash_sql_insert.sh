#!/bin/bash
#
# 2018-05-15 philipp.gressly@santismail.ch

#
# Beschreibung:
# Das Skript importiert ein *.sql file und gibt danach ".done" aus.
# Fehlermeldungen können so einfach den Skripts zugeordnet werden.
#
mysqlImport() {
	echo -n "Process $1:"
	echo -n "   ($2) ..."
	mysql -h localhost < "$1"
	echo "... done"
}
