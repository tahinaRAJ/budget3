<?php
include_once '../includes/function.php';

$recettes_total = calculer_total_recettes();
$depenses_total = calculer_total_depenses();
$deficit = calculer_deficit_complet();

$data = [
    'recettes_2024' => number_format($recettes_total['2024'], 2, ',', ' '),
    'recettes_2025' => number_format($recettes_total['2025'], 2, ',', ' '),
    'depenses_2024' => number_format($depenses_total['2024'], 2, ',', ' '),
    'depenses_2025' => number_format($depenses_total['2025'], 2, ',', ' '),
    'deficit_2024' => number_format($deficit['deficit_2024'], 2, ',', ' '),
    'deficit_2025' => number_format($deficit['deficit_2025'], 2, ',', ' '),
    'couleur_2024' => $deficit['deficit_2024'] < 0 ? 'red' : 'green',
    'couleur_2025' => $deficit['deficit_2025'] < 0 ? 'red' : 'green'
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/sommaire.css">

    <title>Sommaire Budgétaire National</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <!-- HEADER AMÉLIORÉ -->
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
    
    <!-- MAIN CONTENT ENRICHIE -->
    <main class="main-content">
        <div class="page-header">
            <h1 class="page-title">Récapitulatif du Budget National</h1>
            <div class="title-underline"></div>
        </div>
        
        <div class="dashboard-grid">
            <!-- CARTE RECETTES -->
            <div class="content-card card-recettes">
                <a href="RecList.php" class="card-link">
                    <div class="card-header">
                        <h2 class="card-title"><i class="fas fa-chart-line"></i> Recettes</h2>
                        <div class="card-icon"><i class="fas fa-money-bill-wave"></i></div>
                    </div>
                    <div class="card-body">
                        <div class="totaux">
                            <div class="total-item">
                                <span class="total-year">2024</span>
                                <span class="total-amount"><?= $data['recettes_2024'] ?> Mds MGA</span>
                            </div>
                            <div class="total-item">
                                <span class="total-year">2025</span>
                                <span class="total-amount"><?= $data['recettes_2025'] ?> Mds MGA</span>
                                <span class="performance-indicator">
                                    <i class="fas fa-arrow-up"></i> +5.2%
                                </span>
                            </div>
                        </div>
                        <div class="mini-chart">
                            <div class="chart-bar"></div>
                            <div class="chart-bar"></div>
                            <div class="chart-bar"></div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <span class="card-cta">Voir le détail <i class="fas fa-arrow-right"></i></span>
                        <span class="performance-indicator">
                            <i class="fas fa-trending-up"></i> Croissance
                        </span>
                    </div>
                </a>
            </div>
            
            <!-- CARTE DÉPENSES -->
            <div class="content-card card-depenses">
                <a href="depense.php" class="card-link">
                    <div class="card-header">
                        <h2 class="card-title"><i class="fas fa-chart-bar"></i> Dépenses</h2>
                        <div class="card-icon"><i class="fas fa-hand-holding-usd"></i></div>
                    </div>
                    <div class="card-body">
                        <div class="totaux">
                            <div class="total-item">
                                <span class="total-year">2024</span>
                                <span class="total-amount"><?= $data['depenses_2024'] ?> Mds MGA</span>
                            </div>
                            <div class="total-item">
                                <span class="total-year">2025</span>
                                <span class="total-amount"><?= $data['depenses_2025'] ?> Mds MGA</span>
                                <span class="performance-indicator negative">
                                    <i class="fas fa-arrow-up"></i> +3.8%
                                </span>
                            </div>
                        </div>
                        <div class="mini-chart">
                            <div class="chart-bar"></div>
                            <div class="chart-bar"></div>
                            <div class="chart-bar"></div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <span class="card-cta">Voir le détail <i class="fas fa-arrow-right"></i></span>
                        <span class="performance-indicator negative">
                            <i class="fas fa-exclamation-circle"></i> Contrôlé
                        </span>
                    </div>
                </a>
            </div>
            
            <!-- CARTE DÉFICIT -->
            <div class="content-card card-deficit">
                <a href="Deficit.php" class="card-link">
                    <div class="card-header">
                        <h2 class="card-title"><i class="fas fa-balance-scale"></i> Déficit Budgétaire</h2>
                        <div class="card-icon"><i class="fas fa-chart-pie"></i></div>
                    </div>
                    <div class="card-body">
                        <div class="totaux">
                            <div class="total-item deficit-item">
                                <span class="total-year">2024</span>
                                <span class="total-amount deficit-amount" style="color: <?= $data['couleur_2024'] ?>">
                                    <?= $data['deficit_2024'] ?> Mds MGA
                                </span>
                            </div>
                            <div class="total-item deficit-item">
                                <span class="total-year">2025</span>
                                <span class="total-amount deficit-amount" style="color: <?= $data['couleur_2025'] ?>">
                                    <?= $data['deficit_2025'] ?> Mds MGA
                                </span>
                                <span class="performance-indicator <?= $data['couleur_2025'] == 'green' ? '' : 'negative' ?>">
                                    <i class="fas fa-arrow-<?= $data['couleur_2025'] == 'green' ? 'down' : 'up' ?>"></i>
                                    <?= $data['couleur_2025'] == 'green' ? 'Amélioration' : 'Attention' ?>
                                </span>
                            </div>
                        </div>
                        <div class="mini-chart">
                            <div class="chart-bar"></div>
                            <div class="chart-bar"></div>
                            <div class="chart-bar"></div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <span class="card-cta">Analyser <i class="fas fa-arrow-right"></i></span>
                        <span class="performance-indicator <?= $data['couleur_2025'] == 'green' ? '' : 'negative' ?>">
                            <i class="fas fa-<?= $data['couleur_2025'] == 'green' ? 'check' : 'exclamation' ?>-circle"></i>
                            <?= $data['couleur_2025'] == 'green' ? 'Stable' : 'Surveillance' ?>
                        </span>
                    </div>
                </a>
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
        // Animation pour les indicateurs de performance
        document.addEventListener('DOMContentLoaded', function() {
            // Effet de comptage pour les montants
            const amountElements = document.querySelectorAll('.total-amount');
            
            amountElements.forEach(element => {
                const originalText = element.textContent;
                const amount = parseFloat(originalText);
                
                if (!isNaN(amount)) {
                    // Animation de comptage
                    let current = 0;
                    const increment = amount / 30;
                    const timer = setInterval(() => {
                        current += increment;
                        if (current >= amount) {
                            current = amount;
                            clearInterval(timer);
                        }
                        element.textContent = Math.round(current) + ' Mds MGA';
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