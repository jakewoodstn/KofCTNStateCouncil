#!/bin/sh
cp config.core.php.staging config.core.php
cp manager/config.core.php.staging manager/config.core.php
cp connectors/config.core.php.staging connectors/config.core.php
cp core/config/config.inc.php.staging core/config/config.inc.php
mkdir core/cache
mkdir core/export
mkdir core/import
chmod 777 core/cache
chmod -R 777 assets/components
