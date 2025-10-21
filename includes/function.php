<?php
include_once '../config/connection.php';

function afficher_table($reponse)
{
    $connect = dbconnect();
    // Valider le nom de la table pour éviter les injections SQL
    $allowed_tables = ls_tableaux();
    if (!in_array($reponse, $allowed_tables)) {
        return [];
    }

    $requete = "SELECT * FROM `$reponse`";
    $result = mysqli_query($connect, $requete);
    $table = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $table[] = $row;
        }
    }
    return $table;
}

function ls_tableaux()
{
    $connect = dbconnect();
    $requete = "SHOW TABLES";
    $result = mysqli_query($connect, $requete);
    $tables = [];
    if ($result) {
        while ($row = mysqli_fetch_array($result)) {
            $tables[] = $row[0];
        }
    }
    return $tables;
}

function afficher_liste($tables)
{
    if (empty($tables)) {
        return '<p class="no-data">Aucune table trouvée dans la base de données.</p>';
    }

    $output = '<div class="container">';
    $output .= '<div class="malagasy-header">';
    $output .= '<div class="flag-banner">';
    $output .= '<div class="flag-strip red"></div>';
    $output .= '<div class="flag-strip white"></div>';
    $output .= '<div class="flag-strip green"></div>';
    $output .= '</div>';
    $output .= '<h1>Tables Disponibles</h1>';
    $output .= '<p class="subtitle">Sélectionnez une table pour voir son contenu</p>';
    $output .= '</div>';
    
    $output .= '<div class="table-list">';
    $output .= '<div class="table-grid">';

    foreach ($tables as $table) {
        $output .= '<div class="table-card">';
        $output .= '<div class="table-icon">🇲🇬</div>';
        $output .= '<h3>' . htmlspecialchars($table) . '</h3>';
        $output .= '<form method="POST" class="view-form">';
        $output .= '<input type="hidden" name="selected_table" value="' . htmlspecialchars($table) . '">';
        $output .= '<button type="submit" class="view-btn">Voir le contenu</button>';
        $output .= '</form>';
        $output .= '</div>';
    }

    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    return $output;
}
function afficher_tableaux($table)
{
    if (empty($table)) {
        return '<p class="no-data">Aucune donnée à afficher.</p>';
    }

    $output = '<div class="data-container">';
    $output .= '<div class="table-header">';
    $output .= '<h2>Contenu de la Table</h2>';
    $output .= '<span class="row-count">' . count($table) . ' enregistrement(s)</span>';
    $output .= '</div>';

    $output .= '<div class="table-wrapper">';
    $output .= '<table class="data-table">';

    // En-têtes du tableau
    if (!empty($table[0])) {
        $output .= '<thead><tr>';
        foreach (array_keys($table[0]) as $column) {
            $output .= '<th>' . htmlspecialchars($column) . '</th>';
        }
        $output .= '</tr></thead>';
    }

    // Données du tableau
    $output .= '<tbody>';
    foreach ($table as $row) {
        $output .= '<tr>';
        foreach ($row as $cell) {
            $output .= '<td>' . htmlspecialchars($cell) . '</td>';
        }
        $output .= '</tr>';
    }
    $output .= '</tbody>';

    $output .= '</table>';
    $output .= '</div>';
    $output .= '</div>';

    return $output;
}

// Exécution principale
$tables_list = ls_tableaux();
$selected_table_data = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_table'])) {
    $selected_table = $_POST['selected_table'];
    $selected_table_data = afficher_table($selected_table);
}
?>