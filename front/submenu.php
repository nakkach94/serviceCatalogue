<?php
include ('../../../inc/includes.php');
Plugin::load('servicecatalogue', true);

// Types valides
$valid_types = ['support', 'data', 'infra', 'apps', 'advice'];
$type = isset($_GET['type']) && in_array($_GET['type'], $valid_types) ? $_GET['type'] : 'support';

// Titres des pages
$titles = [
    'support' => __('Demandes de Support', 'servicecatalogue'),
    'data'    => __('Données', 'servicecatalogue'),
    'infra'   => __('Infrastructure SI', 'servicecatalogue'),
    'apps'    => __('Application Métier', 'servicecatalogue'),
    'advice'  => __('Conseil SI', 'servicecatalogue')
];

// Icônes
$icons = [
    'support' => 'fas fa-headset',
    'data'    => 'fas fa-database',
    'infra'   => 'fas fa-server',
    'apps'    => 'fas fa-window-restore',
    'advice'  => 'fas fa-lightbulb'
];

Html::header(
    $titles[$type], 
    $_SERVER['PHP_SELF'], 
    "servicecatalogue", 
    "pluginservicecataloguemenu",
    $type
);

echo "<div class='servicecatalogue-container'>";
echo "<h1><i class='{$icons[$type]}'></i> {$titles[$type]}</h1>";

// Contenu spécifique à chaque type
switch ($type) {
    case 'support':
        echo "<p>Gestion des demandes de support technique</p>";
        // Ajouter des listes ou fonctionnalités spécifiques
        break;
    case 'data':
        echo "<p>Gestion des données et documents</p>";
        break;
    case 'infra':
        echo "<p>Gestion de l'infrastructure système</p>";
        break;
    case 'apps':
        echo "<p>Gestion des applications métier</p>";
        break;
    case 'advice':
        echo "<p>Conseil et stratégie SI</p>";
        break;
}

echo "</div>";

Html::footer();