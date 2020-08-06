<?php

/**
 * Configuration for database connection
 *
 */

$host       = "PMYSQL122.dns-servicio.com";
$username   = "app_admin";
$password   = "B@lseraPrados13!";
$dbname     = "7303353_app";
$dsn        = "mysql:host=$host;dbname=$dbname";
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );
