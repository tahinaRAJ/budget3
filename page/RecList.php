<?php
include_once '../includes/function.php';
$tables_list = ls_tableaux();
$table = afficher_liste($tables_list);

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
    <?php echo $table; ?>
</body>
</html>