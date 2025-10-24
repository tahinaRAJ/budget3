<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include_once '../includes/function.php';
$tables_list = afficherDepense();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dépenses (Ventilation)</title>
    <link rel="stylesheet" href="../assets/css/depense.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
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
            <h1 class="page-title">Liste des Dépenses</h1>
            <div class="title-underline"></div>
            <p class="page-subtitle">Ventilation détaillée des dépenses budgétaires</p>
        </div>

        <div class="depense-list">
        <?php foreach ($tables_list as $table): ?>
            <?php
            $totals = get_totals_tres_simple($table);
            $variation = ($totals[1] - $totals[0]) / $totals[0] * 100;
            $max_value = max($totals[0], $totals[1]);
            $progress_2025 = ($totals[1] / $max_value) * 100;
            
            // CORRECTION : Pour les DÉPENSES, une augmentation est NÉGATIVE (rouge)
            $is_positive = $variation <= 0; // Diminution = positif (vert)
            $is_negative = $variation > 0;  // Augmentation = négatif (rouge)
            ?>
            <div class="depense-item">
                <form method="POST" action="<?= htmlspecialchars(split_name($table)) . '.php' ?>" class="item-form">
                    <input type="hidden" name="selected_table" value="<?= htmlspecialchars($table) ?>">
                    <button type="submit" class="view-btn">
                        <div class="item-header">
                            <div class="item-name"><?= htmlspecialchars($table) ?></div>
                            <div class="item-icon"><i class="fas fa-arrow-right"></i></div>
                        </div>
                        
                        <div class="item-details">
                            <div class="year-data">
                                <div class="year-item">
                                    <div class="year-label">2024</div>
                                    <div class="year-amount"><?= number_format($totals[0], 2, ',', ' ') ?> milliards MGA</div>
                                </div>
                                <div class="year-item">
                                    <div class="year-label">2025</div>
                                    <div class="year-amount"><?= number_format($totals[1], 2, ',', ' ') ?> milliards MGA</div>
                                </div>
                            </div>
                            
                            <div class="item-footer">
                                <!-- CORRECTION DES COULEURS -->
                                <div class="view-text">
                                    <span>Voir le détail</span>
                                    <i class="fas fa-chevron-right"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="progress-container">
                            <div class="progress-bar" style="width: <?= $progress_2025 ?>%"></div>
                        </div>
                    </button>
                </form>
            </div>
        <?php endforeach; ?>
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
            // Animation de comptage pour les montants
            const amountElements = document.querySelectorAll('.year-amount');
            
            amountElements.forEach(element => {
                const originalText = element.textContent;
                const amount = parseFloat(originalText.replace(/\s/g, '').replace(',', '.'));
                
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
                        element.textContent = new Intl.NumberFormat('fr-FR', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        }).format(current) + ' milliards MGA';
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