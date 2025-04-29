<?php
session_start();
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $ruolo = $_POST['ruolo'];
    $bio = $_POST['biografia'];
    $competenze = $_POST['competenze'];

    $stmt = $connessione->prepare("INSERT INTO utenti (nome, email, password, ruolo, biografia, competenze) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nome, $email, $password, $ruolo, $bio, $competenze);

    if ($stmt->execute()) {
        $_SESSION['utente_id'] = $stmt->insert_id;
        $_SESSION['ruolo'] = $ruolo;
        header("Location: index.php?registrazione=ok");
        exit();
    } else {
        $errore = "Errore durante la registrazione: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Registrazione</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow">
                <div class="card-header bg-success text-white text-center">
                    <h4>Crea il tuo account</h4>
                </div>
                <div class="card-body">
                    <?php if (isset($errore)): ?>
                        <div class="alert alert-danger"><?= $errore ?></div>
                    <?php endif; ?>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome completo</label>
                            <input type="text" name="nome" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="ruolo" class="form-label">Ruolo</label>
                            <select name="ruolo" class="form-select" required>
                                <option value="studente">Studente</option>
                                <option value="mentore">Mentore</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="biografia" class="form-label">Biografia</label>
                            <textarea name="biografia" class="form-control" rows="3" placeholder="Parlaci di te..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="competenze" class="form-label">Competenze (es. Matematica, Programmazione)</label>
                            <input type="text" name="competenze" class="form-control">
                        </div>
                        <button class="btn btn-success w-100">Registrati</button>
                        <div class="text-center mt-3">
                            <a href="login.php">Hai già un account? Accedi</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
