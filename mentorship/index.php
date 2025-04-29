<?php
session_start();
$logged_in = isset($_SESSION['utente_id']);
$ruolo = $logged_in ? ucfirst($_SESSION['ruolo']) : '';
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Mentorship On-Demand</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container text-center py-5">
    <h1 class="display-4 fw-bold text-primary">Mentorship On-Demand</h1>
    <p class="lead text-muted mb-5">Connettiti con mentori professionisti per consulenze rapide e personalizzate.<br> Impara nuove competenze, trova ispirazione, accelera la tua carriera.</p>

    <?php if (!$logged_in): ?>
        <a href="login.php" class="btn btn-outline-primary btn-lg me-3">Accedi</a>
        <a href="registrazione.php" class="btn btn-success btn-lg">Registrati</a>
    <?php else: ?>
        <div class="alert alert-success w-75 mx-auto mt-4">
            ✅ Benvenuto, sei autenticato come <strong><?= $ruolo ?></strong>
        </div>
        <a href="logout.php" class="btn btn-outline-danger btn-lg mt-2">Esci</a>
    <?php endif; ?>
</div>

</body>
</html>
