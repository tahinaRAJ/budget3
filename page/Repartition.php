<?php
include_once '../includes/function.php';
$reponse = $_POST["selected_table"];
$table = afficher_table($reponse);
$tableaux = afficher_tableaux($table);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style3.css">
    <title>Document</title>
</head>
<body>
    <?php echo $tableaux;
    
    ?>
</body>
</html>