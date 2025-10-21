create database BDC;
USE BDC;
-- Creation de la table 1
CREATE TABLE previsions_macroeconomiques (
    id INT AUTO_INCREMENT PRIMARY KEY,
    agregat_macroeconomique VARCHAR(100) NOT NULL,
    annee_2024 DECIMAL(15,2),
    annee_2025 DECIMAL(15,2),
    annee_2026 DECIMAL(15,2),
    unite VARCHAR(50)
);

-- Insertion des donnees
INSERT INTO previsions_macroeconomiques (agregat_macroeconomique, annee_2024, annee_2025, annee_2026, unite) VALUES
('PIB nominal', 78945.4, 86851.6, 99826.3, 'milliards d''Ariary'),
('Taux de croissance economique', 4.4, 5.0, 5.2, '%'),
('Indice des prix a la consommation (fin de periode)', 8.2, 7.1, 7.2, '%'),
('Ratio de depenses publiques', 16.2, 18.4, 17.8, '% PIB'),
('Solde global (base caisse)', -4.3, -4.1, -4.1, '%'),
('Solde primaire (base caisse)', 214.2, 1097.6, 866.0, 'non specifie'),
('Taux de change - Dollars/Ariary', 4508.6, 4688.8, 4883.2, 'Ariary'),
('Taux de change - Euro/Ariary', 4905.5, 5275.2, 5532.7, 'Ariary'),
('Taux d''investissement - Public', 6.1, 9.6, 8.3, '% PIB'),
('Taux d''investissement - Prive', 14.6, 12.0, 13.7, '% PIB'),
('Taux de pression fiscale', 10.6, 11.2, 11.8, '% PIB');


-- Creation de la table 2
CREATE TABLE Taux_croissance_sectorielle (
    id INT AUTO_INCREMENT PRIMARY KEY,
    secteur VARCHAR(100) NOT NULL,
    taux_2024 DECIMAL(5,2),
    taux_2025 DECIMAL(5,2),
    categorie VARCHAR(50),
    secteur_principal VARCHAR(50)
);

-- Insertion des donnees pour le secteur primaire
INSERT INTO Taux_croissance_sectorielle (secteur, taux_2024, taux_2025, categorie, secteur_principal) VALUES
('SECTEUR PRIMAIRE', 5.3, 7.8, 'Secteur', 'Primaire'),
('Agriculture', 6.0, 9.5, 'Sous-secteur', 'Primaire'),
('elevage et pêche', 3.9, 4.0, 'Sous-secteur', 'Primaire'),
('Sylviculture', 1.0, 1.1, 'Sous-secteur', 'Primaire');

-- Insertion des donnees pour le secteur secondaire
INSERT INTO Taux_croissance_sectorielle (secteur, taux_2024, taux_2025, categorie, secteur_principal) VALUES
('SECTEUR SECONDAIRE', -3.3, 3.4, 'Secteur', 'Secondaire'),
('Industrie extractive', -20.8, 4.0, 'Sous-secteur', 'Secondaire'),
('Alimentaire, boisson, tabac', 0.9, 2.4, 'Sous-secteur', 'Secondaire'),
('Textile', 31.5, 4.0, 'Sous-secteur', 'Secondaire'),
('Bois, papiers, imprimerie', 0.4, 0.7, 'Sous-secteur', 'Secondaire'),
('Materiaux de construction', 7.9, 8.0, 'Sous-secteur', 'Secondaire'),
('Industrie metallique', 7.2, 7.3, 'Sous-secteur', 'Secondaire'),
('Machine, materiels electriques', 3.1, 3.2, 'Sous-secteur', 'Secondaire'),
('Industries diverses', 0.5, 0.6, 'Sous-secteur', 'Secondaire'),
('electricite, eau, gaz', 3.9, 4.0, 'Sous-secteur', 'Secondaire');

-- Insertion des donnees pour le secteur tertiaire
INSERT INTO Taux_croissance_sectorielle (secteur, taux_2024, taux_2025, categorie, secteur_principal) VALUES
('SECTEUR TERTIAIRE', 5.0, 5.4, 'Secteur', 'Tertiaire'),
('BTP', 3.2, 3.6, 'Sous-secteur', 'Tertiaire'),
('Commerce, entretiens, reparations', 4.2, 4.3, 'Sous-secteur', 'Tertiaire'),
('Hôtel, restaurant', 14.7, 16.9, 'Sous-secteur', 'Tertiaire'),
('Transport', 7.0, 7.2, 'Sous-secteur', 'Tertiaire'),
('Poste et telecommunication', 13.4, 13.7, 'Sous-secteur', 'Tertiaire'),
('Banque, assurance', 5.3, 6.1, 'Sous-secteur', 'Tertiaire'),
('Services aux entreprises', 2.3, 2.4, 'Sous-secteur', 'Tertiaire'),
('Administration', 1.7, 1.9, 'Sous-secteur', 'Tertiaire'),
('education', 1.7, 1.8, 'Sous-secteur', 'Tertiaire'),
('Sante', 1.8, 1.9, 'Sous-secteur', 'Tertiaire'),
('Services rendus aux menages', 1.3, 1.4, 'Sous-secteur', 'Tertiaire');


-- Creation de la table 3
CREATE TABLE  recettes_fiscales_interieures (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nature_impot VARCHAR(100) NOT NULL,
    lf_2024 DECIMAL(15,2),
    lf_2025 DECIMAL(15,2),
    categorie VARCHAR(50)
);

-- Insertion des donnees
INSERT INTO recettes_fiscales_interieures (nature_impot, lf_2024, lf_2025, categorie) VALUES
('Impôt sur les revenus', 1179.0, 1411.4, 'Categorie principale'),
('Impôt sur les revenus Salariaux et Assimiles', 848.2, 869.9, 'Sous-categorie'),
('Impôt sur les revenus des Capitaux Mobiliers', 78.2, 99.7, 'Sous-categorie'),
('Impôt sur les plus-values Immobilières', 14.0, 18.3, 'Sous-categorie'),
('Impôt Synthetique', 132.3, 164.7, 'Sous-categorie'),
('Droit d''Enregistrement', 49.0, 62.8, 'Sous-categorie'),
('Taxe sur la Valeur Ajoutee (y compris Taxe sur les transactions Mobiles)', 1400.2, 1742.2, 'Categorie principale'),
('Impôt sur les marches Publics', 148.7, 250.0, 'Categorie principale'),
('Droit d''Accès (y compris Taxe environnementale)', 754.1, 955.4, 'Categorie principale'),
('Taxes sur les Assurances', 17.2, 20.6, 'Categorie principale'),
('Droit de Timbres', 14.1, 16.8, 'Categorie principale'),
('Autres', 1.5, 2.7, 'Categorie principale'),
('TOTAL', 4836.5, 5629.4, 'Total');

-- Creation de la table 4
CREATE TABLE  recettes_douanieres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nature_droits_taxes VARCHAR(100) NOT NULL,
    lf_2024 DECIMAL(15,2),
    lf_2025 DECIMAL(15,2),
    categorie VARCHAR(50)
);

-- Insertion des donnees
INSERT INTO recettes_douanieres (nature_droits_taxes, lf_2024, lf_2025, categorie) VALUES
('Droit de douane', 847.5, 1010.7, 'Droits et taxes'),
('TVA a l''importation', 1768.3, 2148.3, 'Droits et taxes'),
('Taxe sur les produits petroliers', 308.0, 326.0, 'Droits et taxes'),
('TVA sur les produits petroliers', 842.8, 879.0, 'Droits et taxes'),
('Droit de navigation', 1.2, 1.9, 'Droits et taxes'),
('Autres', 0.2, 0.1, 'Droits et taxes'),
('TOTAL', 3768.0, 4366.0, 'Total');

-- Creation de la table 5
CREATE TABLE  recettes_non_fiscales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type_recette VARCHAR(100) NOT NULL,
    lf_2024 DECIMAL(15,2),
    lf_2025 DECIMAL(15,2),
    categorie VARCHAR(50)
);

-- Insertion des donnees
INSERT INTO recettes_non_fiscales (type_recette, lf_2024, lf_2025, categorie) VALUES
('Dividendes', 89.5, 120.2, 'Recette non fiscale'),
('Productions immobilières financières', 0.5, 2.1, 'Recette non fiscale'),
('Redevance de pêche', 10.0, 15.0, 'Recette non fiscale'),
('Redevance minières', 84.9, 331.2, 'Recette non fiscale'),
('Autres redevances', 9.7, 10.0, 'Recette non fiscale'),
('Produits des activites et autres', 11.1, 8.1, 'Recette non fiscale'),
('Autres', 140.1, 5.2, 'Recette non fiscale'),
('TOTAL', 345.8, 481.7, 'Total');

-- Creation de la table 6
CREATE TABLE  composition_des_dons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type_don VARCHAR(50) NOT NULL,
    lf_2024 DECIMAL(15,2),
    lf_2025 DECIMAL(15,2),
    categorie VARCHAR(50)
);

-- Insertion des donnees
INSERT INTO composition_des_dons (type_don, lf_2024, lf_2025, categorie) VALUES
('Courants', 0.3, 31.0, 'Type de don'),
('Capital', 1086.0, 2445.6, 'Type de don'),
('TOTAL', 1086.3, 2478.6, 'Total');

-- Creation de la table 7
CREATE TABLE  ventilation_depenses_par_rubique (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rubrique VARCHAR(100) NOT NULL,
    lfr2024 DECIMAL(15,2),
    lf2025 DECIMAL(15,2),
    categorie VARCHAR(50)
);

-- Insertion des donnees
INSERT INTO ventilation_depenses_par_rubique (rubrique, lfr2024, lf2025, categorie) VALUES
('Interêts de la dette', 672.0, 756.5, 'Depense courante'),
('Depenses courantes de solde (hors indemnites)', 3814.5, 3846.4, 'Depense courante'),
('Depenses courantes hors solde', 3069.0, 2304.3, 'Depense courante'),
('Indemnites', 244.8, 244.8, 'Sous-categorie'),
('Biens/Services', 573.2, 504.7, 'Sous-categorie'),
('Transferts et subventions', 2251.0, 1554.8, 'Sous-categorie'),
('Depenses d''investissement', 4836.8, 8537.2, 'Depense d''investissement'),
('PIP sur financement interne', 1262.5, 2377.3, 'Sous-categorie'),
('PIP sur financement externe', 3574.3, 6159.9, 'Sous-categorie'),
('Autres operations nettes du tresor', 390.2, 860.6, 'Autres'),
('TOTAL', 12782.4, 16304.9, 'Total');

-- Creation de la table 8
CREATE TABLE  evolution_des_depenses_des_soldes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(100) NOT NULL,
    lf_2024 DECIMAL(15,2),
    lf_2025 DECIMAL(15,2),
    ecart DECIMAL(15,2),
    unite VARCHAR(50)
);

-- Insertion des donnees
INSERT INTO evolution_des_depenses_des_soldes (libelle, lf_2024, lf_2025, ecart, unite) VALUES
('Depenses de solde', 3614.5, 3846.4, 31.9, 'milliards d''Ariary'),
('Solde/PIB Nominal', 4.8, 4.3, -0.5, '%'),
('Solde/Recettes fiscales nettes', 47.9, 40.5, -7.4, '%'),
('Solde/Depenses totales', 29.9, 23.6, -6.3, '%');


-- Creation de la table 9
CREATE TABLE  recapitulatif_des_depenses_de_fonctionnement (
    id INT AUTO_INCREMENT PRIMARY KEY,
    poste_depense VARCHAR(100) NOT NULL,
    montant_2024 DECIMAL(15,2),
    montant_2025 DECIMAL(15,2),
    ecart DECIMAL(15,2),
    observations TEXT
);

-- Insertion des donnees
INSERT INTO recapitulatif_des_depenses_de_fonctionnement (poste_depense, montant_2024, montant_2025, ecart, observations) VALUES
('Indemnites', 244.8, 244.8, 0.0, 'En matière de depenses de fonctionnement, une rationalisation importante a ete effectuee. Les depenses hors soldes diminuent de manière significative, passant de 3 068,6 milliards d''ariary en 2024 a 2 304,3 milliards d''ariary en 2025, soit une baisse de près de 24,9 %. Cette reduction est notamment obtenue par une baisse des depenses de biens et services ainsi que des transferts et subventions. Aucune hausse sur les enveloppes globales de fonctionnement allouees aux institutions et Ministères pour l''annee budgetaire 2025.'),
('Biens et Services', 573.2, 504.7, -68.5, 'Nationalisation des allocations budgetaires: exclusion des credits attribues aux fêtes et ceremonies; Maintien du financement des secteurs sociaux prioritaires: sante, education, energie, etc.'),
('Transferts et subventions', 2251.0, 1554.8, -696.2, ''),
('TOTAL', 3068.0, 2304.3, -763.7, '');

-- Creation de la table 10
CREATE TABLE  Repartition_du_budget_par_rattachement_administratif (
    id INT AUTO_INCREMENT PRIMARY KEY,
    institution_ministere VARCHAR(150) NOT NULL,
    lf_2024 DECIMAL(15,2),
    lf_2025 DECIMAL(15,2),
    type_entite VARCHAR(50)
);

-- Insertion des donnees pour les institutions et ministères
INSERT INTO Repartition_du_budget_par_rattachement_administratif (institution_ministere, lf_2024, lf_2025, type_entite) VALUES
('Presidence de la Republique', 177.1, 224.7, 'Institution'),
('Senat', 22.1, 21.3, 'Institution'),
('Assemblee Nationale', 87.4, 85.9, 'Institution'),
('Haute Cour Constitutionnelle', 11.8, 9.3, 'Institution'),
('Primature', 278.3, 339.9, 'Institution'),
('Conseil du Fampihavarana Malagasy', 6.7, 6.3, 'Institution'),
('Commission electorale Nationale Independante', 113.3, 15.4, 'Institution'),
('Ministère de la Defense Nationale', 557.0, 543.2, 'Ministère'),
('Ministère des Affaires etrangères', 99.2, 104.7, 'Ministère'),
('Ministère de la Justice', 199.6, 219.8, 'Ministère'),
('Ministère de l''Interieur', 150.2, 134.7, 'Ministère'),
('Ministère de l''economie et des Finances', 2848.0, 2332.7, 'Ministère'),
('Ministère de la Securite Publique', 228.3, 229.2, 'Ministère'),
('Ministère de l''Industrialisation et du Commerce', 113.2, 119.6, 'Ministère'),
('Ministère de la Decentralisation et de l''Amenagement du Territoire', 356.8, 568.1, 'Ministère'),
('Ministère du Travail, de l''Emploi et de la Fonction Publique', 31.8, 33.7, 'Ministère'),
('Ministère du Tourisme et de l''Artisanat', 19.2, 43.9, 'Ministère'),
('Ministère de l''Enseignement Superieur et de la Recherche Scientifique', 284.2, 285.6, 'Ministère'),
('Ministère de l''Environnement et du Developpement Durable', 94.4, 188.8, 'Ministère'),
('Ministère de l''education Nationale', 1532.8, 1562.0, 'Ministère'),
('Ministère des Transports et de la Meteorologie', 63.9, 216.3, 'Ministère'),
('Ministère de la Sante Publique', 716.6, 921.0, 'Ministère'),
('Ministère de la Communication et de la Culture', 38.4, 32.1, 'Ministère'),
('Ministère des Travaux Publics', 1217.3, 2327.5, 'Ministère'),
('Ministère des Mines et des Ressources Strategiques', 18.3, 18.1, 'Ministère'),
('Ministère de l''Energie et des Hydrocarbures', 407.9, 1332.0, 'Ministère'),
('Ministère de l''Eau, de l''Assainissement et de l''Hygiène', 306.1, 600.2, 'Ministère'),
('Ministère de l''Agriculture et de l''elevage', 469.8, 795.5, 'Ministère'),
('Ministère de la Pêche et de l''Economie Bleue', 29.9, 28.8, 'Ministère'),
('Ministère de l''Enseignement Technique et de la Formation Professionnelle', 103.7, 94.8, 'Ministère'),
('Ministère de l''Artisanat et des Metiers', 2.5, NULL, 'Ministère'),
('Ministère du Developpement Numerique, des Postes et des Telecommunications', 8.4, 8.8, 'Ministère'),
('Ministère de la Population et des Solidarites', 99.1, 193.4, 'Ministère'),
('Ministère de la Jeunesse et des Sports', 40.5, 58.1, 'Ministère'),
('Secretariat d''etat en charge des Nouvelles Villes et de l''Habitat', 247.1, 138.8, 'Secretariat d''etat'),
('Ministère delegue charge de la Gendarmerie', 414.8, 446.4, 'Ministère delegue'),
('Secretariat d''etat en charge de la Souverainete Alimentaire', NULL, 127.3, 'Secretariat d''etat'),
('Total Institutions et Ministères', 11395.9, 14408.9, 'Total'),
('Haut Conseil pour la Defense de la Democratie et de l''etat de Droit [HCDDED]', 2.1, 2.0, 'Organe Constitutionnel'),
('Commission Nationale independante des Droits de l''Homme (CNDIH)', 2.1, 2.0, 'Organe Constitutionnel'),
('Total Organes Constitutionnels', 4.2, 4.0, 'Total'),
('Haute Cour de justice', 3.7, 3.5, 'Institution'),
('Total Hors Operations d''ordre', 11403.8, 14416.4, 'Total');
