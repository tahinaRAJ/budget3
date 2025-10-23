<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Somaire</title>
</head>
<body>
    <header class="">
        <div class="logos">
            <img src="../image/logos.png" alt="">
        </div>
        <nav>
            <li><a href="tableaux.php"></a></li>
            <li><a href="figure.php"></a></li>
            <li><a href="Recettes.php"></a></li>
            <li><a href="Ventilation.php"></a></li>
            <li><a href="extrait_de_disposition.php"></a></li>
        </nav>
    </header>
    <main>
        <h1>Sommaire Page</h1>
        <div class="content">
            <?php
            include_once '../includes/function.php';
            $tables = afficherRecette();
            list($total2024, $total2025) = get_totaux_tables($tables, 'lf_2024', 'lf_2025');
            ?>
            <a href="RecList.php">
                <p>Recettes</p>
                <div class="totaux">
                    <span>Total 2024 : <b><?= number_format($total2024, 2, ',', ' ') ?></b> MGA</span><br>
                    <span>Total 2025 : <b><?= number_format($total2025, 2, ',', ' ') ?></b> MGA</span>
                </div>
            </a>
        </div>
        <div class="content">
            <?php
            $tables_dep = afficherDepense();
            list($total_dep_2024, $total_dep_2025) = get_totaux_tables($tables_dep, null, null, 'depense');
            ?>
            <a href="Ventilation.php">
                <p>Dépenses</p>
                <div class="totaux">
                    <span>Total 2024 : <b><?= number_format($total_dep_2024, 2, ',', ' ') ?></b> MGA</span><br>
                    <span>Total 2025 : <b><?= number_format($total_dep_2025, 2, ',', ' ') ?></b> MGA</span>
                </div>
            </a>
        </div>
         <div class="content">
            <a href="Deficit.php"><p>Deficit budgetaire</p></a>
        </div>
    </main>
</body>
</html>