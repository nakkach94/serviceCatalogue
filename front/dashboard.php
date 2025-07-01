<?php
include ('../../../inc/includes.php');
Plugin::load('servicecatalogue', true);

Html::header(PluginServicecatalogueMenu::getMenuName(), '', "admin", "pluginservicecataloguemenu");

echo "<div class='center' style='margin-top: 30px;'>";
echo "<div class='alert alert-info' style='max-width: 800px; margin: auto;'>";
echo "<h2><i class='fas fa-chart-bar'></i> " . __('Tableau de Bord Service Catalogue', 'servicecatalogue') . "</h2>";
echo "<div class='row'>";

// Widget 1
echo "<div class='col-md-4'>";
echo "<div class='card'>";
echo "<div class='card-header'>".__('Tickets ouverts', 'servicecatalogue')."</div>";
echo "<div class='card-body text-center' style='font-size: 2em;'>";
echo Ticket::countOpenTickets();
echo "</div></div></div>";

// Widget 2
echo "<div class='col-md-4'>";
echo "<div class='card'>";
echo "<div class='card-header'>".__('Services actifs', 'servicecatalogue')."</div>";
echo "<div class='card-body text-center' style='font-size: 2em;'>";
echo "5"; // Remplacer par vraie donnée
echo "</div></div></div>";

// Widget 3
echo "<div class='col-md-4'>";
echo "<div class='card'>";
echo "<div class='card-header'>".__('Utilisateurs', 'servicecatalogue')."</div>";
echo "<div class='card-body text-center' style='font-size: 2em;'>";
echo User::countActiveUsers();
echo "</div></div></div>";

echo "</div>"; // .row
echo "</div>"; // .alert
echo "</div>"; // .center

Html::footer();