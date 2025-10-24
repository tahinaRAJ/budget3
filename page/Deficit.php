<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include_once '../includes/function.php';

// UNE SEULE LIGNE POUR TOUT CALCULER !
$resultats = calculer_deficit_complet();

// Extraire les résultats
$total_rec_2024 = $resultats['recettes_2024'];
$total_rec_2025 = $resultats['recettes_2025'];
$total_dep_2024 = $resultats['depenses_2024'];
$total_dep_2025 = $resultats['depenses_2025'];
$deficit_2024 = $resultats['deficit_2024'];
$deficit_2025 = $resultats['deficit_2025'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Déficit Budgétaire</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/deficit.css">
</head>
<body>
    <!-- HEADER GOUVERNEMENTAL -->
    <header class="main-header">
        <div class="header-container">
            <div class="logos">
                <a href="sommaire.php"><img src="../image/logos.png" alt="Logo Gouvernement" class="logo-img"></a>
                <div class="logo-glow"></div>
            </div>
            <nav class="main-nav">
                <ul class="nav-list">
                    <li class="nav-item">
                        <a href="RecList.php" class="nav-link">
                            <span class="nav-text">Recettes</span>
                            <span class="nav-arrow">→</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="depense.php" class="nav-link">
                            <span class="nav-text">Dépenses</span>
                            <span class="nav-arrow">→</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="Deficit.php" class="nav-link">
                            <span class="nav-text">Déficit</span>
                            <span class="nav-arrow">→</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- CONTENU PRINCIPAL -->
    <main class="main-content">
        <div class="page-header">
            <h1 class="page-title"><i class="fas fa-chart-line"></i> Déficit Budgétaire</h1>
            <div class="title-underline"></div>
            <p class="page-subtitle">Analyse détaillée de l'équilibre budgétaire national</p>
        </div>

        <!-- Indicateur d'évolution -->
        <?php
        $evolution = $deficit_2025 - $deficit_2024;
        $evolution_percent = $deficit_2024 != 0 ? ($evolution / abs($deficit_2024)) * 100 : 0;
        $is_improvement = $evolution < 0; // Le déficit diminue = amélioration
        ?>
        <div class="evolution-indicator">
            <div class="evolution-text">
                Évolution 2024 → 2025 :
            </div>
            <div class="evolution-value <?= $is_improvement ? 'evolution-improvement' : 'evolution-worsening' ?>">
                <i class="fas fa-arrow-<?= $is_improvement ? 'down' : 'up' ?>"></i>
                <?= number_format(abs($evolution), 2, ',', ' ') ?> Mds MGA
                (<?= number_format(abs($evolution_percent), 1) ?>%)
            </div>
        </div>

        <!-- Cartes de déficit -->
        <div class="summary-card">
            <div class="card">
                <h3><i class="fas fa-calendar-alt"></i> 2024</h3>
                <div class="deficit-amount <?= $deficit_2024 >= 0 ? 'positive' : 'negative' ?>">
                    <?= number_format($deficit_2024, 2, ',', ' ') ?> Mds MGA
                </div>
                <div class="status-indicator <?= $deficit_2024 >= 0 ? 'status-positive' : 'status-negative' ?>">
                    <i class="fas fa-<?= $deficit_2024 >= 0 ? 'check-circle' : 'exclamation-triangle' ?>"></i>
                    <?= $deficit_2024 >= 0 ? 'Excédent Budgétaire' : 'Déficit Budgétaire' ?>
                </div>
            </div>
            
            <div class="card">
                <h3><i class="fas fa-calendar-alt"></i> 2025</h3>
                <div class="deficit-amount <?= $deficit_2025 >= 0 ? 'positive' : 'negative' ?>">
                    <?= number_format($deficit_2025, 2, ',', ' ') ?> Mds MGA
                </div>
                <div class="status-indicator <?= $deficit_2025 >= 0 ? 'status-positive' : 'status-negative' ?>">
                    <i class="fas fa-<?= $deficit_2025 >= 0 ? 'check-circle' : 'exclamation-triangle' ?>"></i>
                    <?= $deficit_2025 >= 0 ? 'Excédent Budgétaire' : 'Déficit Budgétaire' ?>
                </div>
            </div>
        </div>
        
        <!-- Détails -->
        <div class="details-container">
            <div class="details">
                <h2><i class="fas fa-file-invoice"></i> Détails 2024</h2>
                <ul>
                    <li>
                        <span>Total Recettes :</span>
                        <strong><?= number_format($total_rec_2024, 2, ',', ' ') ?> milliards MGA</strong>
                    </li>
                    <li>
                        <span>Total Dépenses :</span>
                        <strong><?= number_format($total_dep_2024, 2, ',', ' ') ?> milliards MGA</strong>
                    </li>
                    <li>
                        <span>Solde Budgétaire :</span>
                        <strong class="<?= $deficit_2024 >= 0 ? 'positive' : 'negative' ?>">
                            <?= number_format($deficit_2024, 2, ',', ' ') ?> milliards MGA
                        </strong>
                    </li>
                </ul>
            </div>
            
            <div class="details">
                <h2><i class="fas fa-file-invoice"></i> Détails 2025</h2>
                <ul>
                    <li>
                        <span>Total Recettes :</span>
                        <strong><?= number_format($total_rec_2025, 2, ',', ' ') ?> milliards MGA</strong>
                    </li>
                    <li>
                        <span>Total Dépenses :</span>
                        <strong><?= number_format($total_dep_2025, 2, ',', ' ') ?> milliards MGA</strong>
                    </li>
                    <li>
                        <span>Solde Budgétaire :</span>
                        <strong class="<?= $deficit_2025 >= 0 ? 'positive' : 'negative' ?>">
                            <?= number_format($deficit_2025, 2, ',', ' ') ?> milliards MGA
                        </strong>
                    </li>
                </ul>
            </div>
        </div>
    </main>

    <!-- ÉLÉMENTS FLOTTANTS POUR L'ESTHÉTIQUE -->
    <div class="floating-elements">
        <div class="floating-element"></div>
        <div class="floating-element"></div>
        <div class="floating-element"></div>
    </div>

    <script>
        // Animation pour les montants
        document.addEventListener('DOMContentLoaded', function() {
            // Animation de comptage pour les montants de déficit
            const deficitElements = document.querySelectorAll('.deficit-amount');
            
            deficitElements.forEach(element => {
                const originalText = element.textContent;
                const amount = parseFloat(originalText.replace(/\s/g, '').replace(',', '.'));
                
                if (!isNaN(amount)) {
                    // Animation de comptage
                    let current = 0;
                    const increment = amount / 40;
                    const timer = setInterval(() => {
                        current += increment;
                        if (Math.abs(current) >= Math.abs(amount)) {
                            current = amount;
                            clearInterval(timer);
                        }
                        element.textContent = new Intl.NumberFormat('fr-FR', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        }).format(current) + ' Mds MGA';
                    }, 50);
                }
            });

            // Effet de parallaxe pour les éléments flottants
            document.addEventListener('mousemove', function(e) {
                const floatingElements = document.querySelectorAll('.floating-element');
                const x = e.clientX / window.innerWidth;
                const y = e.clientY / window.innerHeight;
                
                floatingElements.forEach((element, index) => {
                    const speed = (index + 1) * 0.5;
                    const xMove = x * speed * 100;
                    const yMove = y * speed * 100;
                    
                    element.style.transform = `translate(${xMove}px, ${yMove}px)`;
                });
            });
        });
    </script>
</body>
</html>