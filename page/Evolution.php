<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include_once '../includes/function.php';
$reponse = $_POST["selected_table"] ?? '';
$table = afficher_table($reponse);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Évolution - <?= htmlspecialchars($reponse) ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/tableaux.css">
</head>
<body>
    <header class="main-header">
        <div class="header-container">
            <div class="logos">
                <a href="sommaire.php"><img src="../image/logos.png" alt="Logo Gouvernement" class="logo-img"></a>
                <div class="logo-glow"></div>
            </div>
            <nav class="main-nav">
                <ul class="nav-list">
                    <li class="nav-item"><a href="RecList.php" class="nav-link"><span>Recettes</span><span class="nav-arrow">→</span></a></li>
                    <li class="nav-item"><a href="depense.php" class="nav-link"><span>Dépenses</span><span class="nav-arrow">→</span></a></li>
                    <li class="nav-item"><a href="Deficit.php" class="nav-link"><span>Déficit</span><span class="nav-arrow">→</span></a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="main-content">
        <div class="page-header">
            <h1 class="page-title"><i class="fas fa-chart-line"></i> Évolution Budgétaire</h1>
            <div class="title-underline"></div>
            <p class="page-subtitle">Analyse détaillée de l'évolution des données budgétaires</p>
        </div>

        <div class="data-container">
            <div class="table-header">
                <h2>Table : <?= htmlspecialchars($reponse) ?></h2>
                <span class="row-count"><?= count($table) ?> enregistrement(s)</span>
            </div>

            <div class="table-wrapper">
                <table class="data-table">
                    <?php if (!empty($table[0])): ?>
                    <thead>
                        <tr>
                            <?php foreach (array_keys($table[0]) as $column): ?>
                                <th><?= htmlspecialchars($column) ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <?php endif; ?>

                    <tbody>
                        <?php foreach ($table as $row): ?>
                        <tr>
                            <?php foreach ($row as $cell): ?>
                                <td><?= htmlspecialchars($cell) ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="table-actions">
                <button class="btn btn-primary" onclick="window.print()">
                    <i class="fas fa-print"></i> Imprimer
                </button>
                <button class="btn btn-secondary" onclick="window.history.back()">
                    <i class="fas fa-arrow-left"></i> Retour
                </button>
            </div>
        </div>
    </main>

    <div class="floating-elements">
        <div class="floating-element"></div>
        <div class="floating-element"></div>
        <div class="floating-element"></div>
    </div>
</body>
</html>