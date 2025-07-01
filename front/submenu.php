<?php
include ('../../../inc/includes.php');
Plugin::load('servicecatalogue', true);

$types = [
    'support' => __('Demande de support', 'servicecatalogue'),
    'data'    => __('Données', 'servicecatalogue'),
    'infra'   => __('Infrastructure SI', 'servicecatalogue'),
    'apps'    => __('Applications Métier', 'servicecatalogue'),
    'advice'  => __('Conseil SI', 'servicecatalogue')
];

$type = $_GET['type'] ?? 'support';
$title = $types[$type] ?? $types['support'];

Html::header($title, '', "admin", "pluginservicecataloguemenu", $type);

echo "<div class='center' style='margin-top: 30px; max-width: 1200px; margin: auto;'>";
echo "<h2><i class='fas fa-folder-open'></i> $title</h2>";

// Exemple de contenu dynamique
switch ($type) {
    case 'support':
        echo "<p>".__('Gestion des demandes de support technique', 'servicecatalogue')."</p>";
        break;
    case 'data':
        echo "<p>".__('Services liés à la gestion des données', 'servicecatalogue')."</p>";
        break;
    // ... autres cas
}

// Ajouter des listes GLPI (exemple)
$ticket = new Ticket();
$ticket->listItems();

echo "</div>";

Html::footer();