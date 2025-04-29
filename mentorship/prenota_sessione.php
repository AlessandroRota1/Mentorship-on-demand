<?php
session_start();
require 'config.php';

if (isset($_SESSION['utente_id']) && $_SESSION['ruolo'] == 'studente') {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_studente = $_SESSION['utente_id'];
        $id_mentore = $_POST['id_mentore'];
        $data_ora = $_POST['data_ora'];
        $durata = $_POST['durata'];

        $stmt = $connessione->prepare("INSERT INTO sessioni (id_studente, id_mentore, data_ora_sessione, durata_minuti) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iisi", $id_studente, $id_mentore, $data_ora, $durata);

        if ($stmt->execute()) {
            echo "Sessione prenotata con successo.";
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
