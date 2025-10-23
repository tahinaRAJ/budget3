<?php
include_once '../includes/function.php';
$recettes = afficherRecette();
$depenses = afficherDepense();
list($total_rec_2024, $total_rec_2025) = get_totaux_tables($recettes, 'lf_2024', 'lf_2025');
list($total_dep_2024, $total_dep_2025) = get_totaux_tables($depenses, null, null, 'depense');
$deficit_2024 = $total_rec_2024 - $total_dep_2024;
$deficit_2025 = $total_rec_2025 - $total_dep_2025;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style3.css">
    <title>Déficit budgétaire</title>
</head>
<body>
    <h1>Déficit budgétaire</h1>
    <div class="deficit-totaux">
        <p>Déficit 2024 : <b><?= number_format($deficit_2024, 2, ',', ' ') ?></b> milliards MGA</p>
        <p>Déficit 2025 : <b><?= number_format($deficit_2025, 2, ',', ' ') ?></b> milliardsMGA</p>
    </div>
    <div class="details">
        <h2>Détail</h2>
        <ul>
            <li>Total Recettes 2024 : <?= number_format($total_rec_2024, 2, ',', ' ') ?> milliards MGA</li>
            <li>Total Dépenses 2024 : <?= number_format($total_dep_2024, 2, ',', ' ') ?> milliards MGA</li>
            <li>Total Recettes 2025 : <?= number_format($total_rec_2025, 2, ',', ' ') ?> milliards MGA</li>
            <li>Total Dépenses 2025 : <?= number_format($total_dep_2025, 2, ',', ' ') ?> milliards MGA</li>
        </ul>
    </div>
</body>
</html>
