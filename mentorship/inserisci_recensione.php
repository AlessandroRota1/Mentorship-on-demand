<?php
session_start();
require 'config.php';

if (isset($_SESSION['utente_id']) && $_SESSION['ruolo'] == 'studente') {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_sessione = $_POST['id_sessione'];
        $valutazione = $_POST['valutazione'];
        $commento = $_POST['commento'];

        $stmt = $connessione->prepare("INSERT INTO recensioni (id_sessione, valutazione, commento) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $id_sessione, $valutazione, $commento);

        if ($stmt->execute()) {
            echo "Recensione inserita con successo.";
        } else {
            echo "Errore: " . $stmt->error;
        }

        $stmt->close();
        $connessione->close();
    }
} else {
    echo "Accesso non autorizzato.";
}
?>
