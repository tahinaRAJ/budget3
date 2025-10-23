<?php
include_once '../includes/function.php';
$tables_list = afficherRecette();
$connect = dbconnect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style3.css">
    <title>liste tableaux</title>
</head>
<body>
    <h1>Liste des Recettes</h1>
    <div class="recette-list">
        <?php foreach ($tables_list as $table): ?>
            <?php
                // Colonnes pour chaque table de recettes selon la base
                $map = [
                    'recettes_fiscales_interieures' => ['lf_2024', 'lf_2025', 'categorie'],
                    'recettes_douanieres' => ['lf_2024', 'lf_2025', 'categorie'],
                    'recettes_non_fiscales' => ['lf_2024', 'lf_2025', 'categorie'],
                    'composition_des_dons' => ['lf_2024', 'lf_2025', 'categorie'],
                ];
                $t2024 = $t2025 = 0;
                $cat_col = null;
                $col1 = $col2 = null;
                foreach ($map as $key => $cols) {
                    if (strtolower($key) === strtolower($table)) {
                        $col1 = $cols[0];
                        $col2 = $cols[1];
                        $cat_col = $cols[2];
                        break;
                    }
                }
                if ($col1 && $col2 && $cat_col) {
                    $sql = "SELECT `$col1` as t2024, `$col2` as t2025 FROM `$table` WHERE `$cat_col` LIKE 'Total' OR `$cat_col` LIKE 'TOTAL' LIMIT 1";
                    $res = $connect->query($sql);
                    if ($res && $row = $res->fetch_assoc()) {
                        $t2024 = floatval($row['t2024']);
                        $t2025 = floatval($row['t2025']);
                    }
                }
                $file_name = htmlspecialchars(split_name($table)) . '.php';
            ?>
            <div class="recette-item">
                <form method="POST" action="<?= $file_name ?>">
                    <input type="hidden" name="selected_table" value="<?= htmlspecialchars($table) ?>">
                    <button type="submit" class="view-btn">
                        <b><?= htmlspecialchars($table) ?></b> :
                        2024 = <span><?= number_format($t2024, 2, ',', ' ') ?></span> milliards MGA |
                        2025 = <span><?= number_format($t2025, 2, ',', ' ') ?></span> milliards MGA
                    </button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>