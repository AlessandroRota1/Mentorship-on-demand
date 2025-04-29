<?php
$host = 'localhost';
$utente = 'root';
$password = '';
$database = 'mentorship';

$connessione = new mysqli($host, $utente, $password, $database);

if ($connessione->connect_error) {
    die("Connessione fallita: " . $connessione->connect_error);
}
?>
