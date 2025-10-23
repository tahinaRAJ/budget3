
<?php
include_once '../config/connection.php';

function get_colonnes_depense($table) {
    $map = [
        'ventilation_depenses_par_rubique' => ['lfr2024', 'lf2025'],
        'evolution_des_depenses_des_soldes' => ['lf_2024', 'lf_2025'],
        'recapitulatif_des_depenses_de_fonctionnement' => ['montant_2024', 'montant_2025'],
        'Repartition_du_budget_par_rattachement_administratif' => ['lf_2024', 'lf_2025'],
    ];
    // gestion des variations de casse
    foreach ($map as $key => $cols) {
        if (strtolower($key) === strtolower($table)) {
            return $cols;
        }
    }
    return null;
}



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
    $requete = "SHOW TABLES WHERE Tables_in_bdc NOT LIKE 'view_%'";
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
    $file_name1 = split_name($table);
    $file_name = htmlspecialchars($file_name1) . '.php'; // dynamic PHP file name

    $output .= '<div class="table-card">';
    $output .= '<div class="table-icon">🇲🇬</div>';
    $output .= '<h3>' . htmlspecialchars($table) . '</h3>';

    // form now points directly to the table-specific PHP file
    $output .= '<form method="POST" action="' . $file_name . '">';
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
function split_name($nom) {
    static $used_names = []; // stores previously used names
    $parts = explode('_', $nom);
    $base_name = ucfirst($parts[0]);

    // If name has been used before, increment counter
    if (isset($used_names[$base_name])) {
        $used_names[$base_name]++;
    } else {
        $used_names[$base_name] = 1;
    }

    // Add number if it’s not the first occurrence
    if ($used_names[$base_name] > 1) {
        return $base_name . $used_names[$base_name];
    }

    return $base_name;
}



function get_total_table($table, $col1, $col2) {
    $connect = dbconnect();
    $total1 = 0;
    $total2 = 0;
    // On cherche la colonne qui contient le mot 'categorie' ou 'type' ou 'poste' ou 'nature' (pour les totaux)
    $columns = [];
    $res = $connect->query("SHOW COLUMNS FROM `$table`");
    if ($res) {
        while ($row = $res->fetch_assoc()) {
            $columns[] = $row['Field'];
        }
    }
    $cat_col = null;
    foreach ($columns as $col) {
        if (stripos($col, 'categorie') !== false || stripos($col, 'type') !== false || stripos($col, 'poste') !== false || stripos($col, 'nature') !== false) {
            $cat_col = $col;
            break;
        }
    }
    if ($cat_col) {
        $sql = "SELECT `$col1`, `$col2` FROM `$table` WHERE `$cat_col` LIKE 'Total' OR `$cat_col` LIKE 'TOTAL' LIMIT 1";
        $res = $connect->query($sql);
        if ($res && $row = $res->fetch_assoc()) {
            $total1 = floatval($row[$col1]);
            $total2 = floatval($row[$col2]);
        }
    }
    return [$total1, $total2];
}

function get_totaux_tables($tables, $col1 = null, $col2 = null, $type = 'recette') {
    $total1 = 0;
    $total2 = 0;
    if (!is_array($tables)) return [0, 0];
    foreach ($tables as $table) {
        if ($type === 'depense') {
            $cols = get_colonnes_depense($table);
            if ($cols) {
                list($c1, $c2) = $cols;
                list($t1, $t2) = get_total_table($table, $c1, $c2);
                $total1 += $t1;
                $total2 += $t2;
            }
        } else {
            if ($col1 && $col2) {
                list($t1, $t2) = get_total_table($table, $col1, $col2);
                $total1 += $t1;
                $total2 += $t2;
            }
        }
    }
    return [$total1, $total2];
}

function afficherRecette() {
    $connect = dbconnect();
    $requete = "SHOW TABLES WHERE Tables_in_bdc LIKE '%recette%'";
    $result = mysqli_query($connect, $requete);
    $tables = [];
    if ($result) {
        while ($row = mysqli_fetch_array($result)) {
            $tables[] = $row[0];
        }
    }
    return $tables;
}

// Fonction pour obtenir la liste des tables de dépenses (ventilation)
function afficherDepense() {
    $connect = dbconnect();
    $requete = "SHOW TABLES WHERE Tables_in_bdc LIKE '%depense%'";
    $result = mysqli_query($connect, $requete);
    $tables = [];
    if ($result) {
        while ($row = mysqli_fetch_array($result)) {
            $tables[] = $row[0];
        }
    }
    return $tables;
}
?>