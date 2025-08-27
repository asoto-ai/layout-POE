<?php
// Ajusta credenciales
$DB_HOST = 'localhost';
$DB_NAME = 'olimpiadasespeci_plataformaOE';
$DB_USER = 'olimpiadasespeci_adminPlaOE';
$DB_PASS = 'G~X~)G[}^j5M';

$pdo = new PDO(
  "mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4",
  $DB_USER, $DB_PASS,
  [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]
);
