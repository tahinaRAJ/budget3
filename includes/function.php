<?php
include_once 'connection.php';

// ============================================================================
// FONCTIONS DE BASE ET GÉNÉRIQUES
// ============================================================================

function ls_tableaux() {
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
function split_name($nom) {
    static $used_names = [];
    $parts = explode('_', $nom);
    $base_name = ucfirst($parts[0]);

    if (isset($used_names[$base_name])) {
        $used_names[$base_name]++;
    } else {
        $used_names[$base_name] = 1;
    }

    if ($used_names[$base_name] > 1) {
        return $base_name . $used_names[$base_name];
    }

    return $base_name;
}

// ============================================================================
// FONCTIONS DE CALCUL DES TOTAUX
// ============================================================================

function get_totals_recettes_simple($table) {
    $connect = dbconnect();
    
    // TOUTES LES TABLES DE RECETTES ONT LA MÊME STRUCTURE
    $col2024 = 'lf_2024';
    $col2025 = 'lf_2025';
    
    // REQUÊTE SPÉCIFIQUE POUR LES RECETTES - cherche la ligne "Total"
    $sql = "SELECT `$col2024`, `$col2025` FROM `$table` WHERE categorie LIKE 'Total' OR categorie LIKE 'TOTAL' LIMIT 1";
    $res = $connect->query($sql);
    
    if ($res && $row = $res->fetch_assoc()) {
        return [
            floatval($row[$col2024] ?? 0),
            floatval($row[$col2025] ?? 0)
        ];
    }
    
    return [0, 0];
}

function get_totals_tres_simple($table) {
    // VÉRIFIER QUE $table EST BIEN UNE CHAÎNE
    if (!is_string($table)) {
        return [0, 0];
    }
    
    $connect = dbconnect();
    
    // DÉTERMINER LES COLONNES SELON LE NOM DE LA TABLE
    if (strpos($table, 'evolution') !== false) {
        $col2024 = 'lf_2024';
        $col2025 = 'lf_2025';
    } else if (strpos($table, 'recapitulatif') !== false) {
        $col2024 = 'montant_2024';
        $col2025 = 'montant_2025';
    } else if (strpos($table, 'ventilation') !== false) {
        $col2024 = 'lfr2024';
        $col2025 = 'lf2025';
    } else {
        $col2024 = 'montant_2024';
        $col2025 = 'montant_2025';
    }
    
    // REQUÊTE SIMPLE
    $sql = "SELECT $col2024, $col2025 FROM `$table` ORDER BY id DESC LIMIT 1";
    $res = $connect->query($sql);
    
    if ($res && $row = $res->fetch_assoc()) {
        return [
            floatval($row[$col2024]),
            floatval($row[$col2025])
        ];
    }
    
    return [0, 0];
}

function get_totaux_tables($table) {
    // Utilise la fonction qui existe déjà
    return get_totals_tres_simple($table);
}

// ============================================================================
// FONCTIONS DE CALCUL GLOBAUX
// ============================================================================

function calculer_total_recettes() {
    $recettes = afficherRecette();
    $total_2024 = 0;
    $total_2025 = 0;

    foreach ($recettes as $table) {
        $totals = get_totals_recettes_simple($table);
        $total_2024 += $totals[0] ?? 0;
        $total_2025 += $totals[1] ?? 0;
    }

    return [
        '2024' => $total_2024,
        '2025' => $total_2025
    ];
}

function calculer_total_depenses() {
    $depenses = afficherDepense();
    $total_2024 = 0;
    $total_2025 = 0;

    foreach ($depenses as $table) {
        $totals = get_totals_tres_simple($table);
        $total_2024 += $totals[0] ?? 0;
        $total_2025 += $totals[1] ?? 0;
    }

    return [
        '2024' => $total_2024,
        '2025' => $total_2025
    ];
}

function calculer_deficit_complet() {
    $recettes = afficherRecette();
    $depenses = afficherDepense();
    
    $total_rec_2024 = 0;
    $total_rec_2025 = 0;
    $total_dep_2024 = 0;
    $total_dep_2025 = 0;

    // TOTAL RECETTES - utilise la fonction pour les recettes
    foreach ($recettes as $table) {
        $totals = get_totals_recettes_simple($table);
        $total_rec_2024 += $totals[0] ?? 0;
        $total_rec_2025 += $totals[1] ?? 0;
    }

    // TOTAL DÉPENSES - utilise la fonction pour les dépenses
    foreach ($depenses as $table) {
        $totals = get_totals_tres_simple($table);
        $total_dep_2024 += $totals[0] ?? 0;
        $total_dep_2025 += $totals[1] ?? 0;
    }

    return [
        'recettes_2024' => $total_rec_2024,
        'recettes_2025' => $total_rec_2025,
        'depenses_2024' => $total_dep_2024,
        'depenses_2025' => $total_dep_2025,
        'deficit_2024' => $total_rec_2024 - $total_dep_2024,
        'deficit_2025' => $total_rec_2025 - $total_dep_2025
    ];
}

// ============================================================================
// FONCTIONS D'AFFICHAGE
// ============================================================================

function afficher_table($reponse) {
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


?>