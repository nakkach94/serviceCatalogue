<?php
include ('../../../inc/includes.php');
Plugin::load('servicecatalogue', true);

// Types valides
$valid_types = [
    'support' => ['title' => 'Demandes de Support', 'icon' => 'ticket-alt'],
    'data' => ['title' => 'Données', 'icon' => 'database'],
    'infra' => ['title' => 'Infrastructure SI', 'icon' => 'server'],
    'apps' => ['title' => 'Application Métier', 'icon' => 'window-restore'],
    'advice' => ['title' => 'Conseil SI', 'icon' => 'lightbulb']
];

$type = $_GET['type'] ?? 'support';
if (!array_key_exists($type, $valid_types)) {
    $type = 'support';
}

$title = $valid_types[$type]['title'];
$icon = $valid_types[$type]['icon'];

Html::header(
    "GIFI - $title", 
    $_SERVER['PHP_SELF'], 
    "admin", 
    "pluginservicecataloguemenu"
);

echo "<div class='sc-dashboard'>";

// Barre de titre et navigation
echo "<div class='sc-header'>";
echo "<h1><i class='fas fa-book'></i> Service Catalogue</h1>";
echo "<div class='sc-breadcrumb'>";
echo "<a href='#'>GLPI</a> > <a href='#'>Accueil</a> > <a href='#'>Parc</a> > <span>Service Catalogue</span>";
echo "</div>";
echo "</div>";

// Menu latéral gauche (identique à dashboard.php)
echo "<div class='sc-container'>";
echo "<div class='sc-sidebar'>";
// ... (le même code de menu que dans dashboard.php) ...
echo "</div>"; // fin .sc-sidebar

// Contenu spécifique
echo "<div class='sc-content'>";
echo "<h2><i class='fas fa-$icon'></i> $title</h2>";

// Contenu différent selon le type
switch ($type) {
    case 'support':
        echo "<p>Contenu spécifique aux demandes de support...</p>";
        break;
    case 'data':
        echo "<p>Contenu spécifique aux données...</p>";
        break;
    case 'infra':
        echo "<p>Contenu spécifique à l'infrastructure SI...</p>";
        break;
    case 'apps':
        echo "<p>Contenu spécifique aux applications métier...</p>";
        break;
    case 'advice':
        echo "<p>Contenu spécifique au conseil SI...</p>";
        break;
}

echo "</div>"; // fin .sc-content
echo "</div>"; // fin .sc-container
echo "</div>"; // fin .sc-dashboard

Html::footer();