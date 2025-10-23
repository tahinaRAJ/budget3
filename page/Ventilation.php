<?php
include_once '../includes/function.php';
$tables_list = afficherDepense();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style3.css">
    <title>Dépenses (Ventilation)</title>
</head>
<body>
    <h1>Liste des Dépenses</h1>
    <div class="depense-list">
        <?php foreach ($tables_list as $table): ?>
            <?php
                $cols = get_colonnes_depense($table);
                $t2024 = $t2025 = 0;
                if ($cols) {
                    list($col1, $col2) = $cols;
                    list($t2024, $t2025) = get_total_table($table, $col1, $col2);
                }
                $file_name = htmlspecialchars(split_name($table)) . '.php';
            ?>
            <div class="depense-item">
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