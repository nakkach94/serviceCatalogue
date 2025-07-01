<?php
include ('../../../inc/includes.php');
Plugin::load('servicecatalogue', true);

Html::header(
    'Service Catalogue', 
    $_SERVER['PHP_SELF'], 
    "servicecatalogue", 
    "pluginservicecataloguemenu"
);

echo "<div class='servicecatalogue-container'>";
echo "<h1><i class='fas fa-book-open'></i> Service Catalogue</h1>";
echo "<p>Bienvenue dans le catalogue de services de votre organisation.</p>";

echo "<div class='sc-cards'>";
echo "<a href='".Plugin::getWebDir('servicecatalogue')."/front/submenu.php?type=support' class='sc-card'>";
echo "<div class='sc-icon'><i class='fas fa-headset fa-3x'></i></div>";
echo "<div class='sc-title'>Demandes de Support</div>";
echo "</a>";

echo "<a href='".Plugin::getWebDir('servicecatalogue')."/front/submenu.php?type=data' class='sc-card'>";
echo "<div class='sc-icon'><i class='fas fa-database fa-3x'></i></div>";
echo "<div class='sc-title'>Données</div>";
echo "</a>";

echo "<a href='".Plugin::getWebDir('servicecatalogue')."/front/submenu.php?type=infra' class='sc-card'>";
echo "<div class='sc-icon'><i class='fas fa-server fa-3x'></i></div>";
echo "<div class='sc-title'>Infrastructure SI</div>";
echo "</a>";

echo "<a href='".Plugin::getWebDir('servicecatalogue')."/front/submenu.php?type=apps' class='sc-card'>";
echo "<div class='sc-icon'><i class='fas fa-window-restore fa-3x'></i></div>";
echo "<div class='sc-title'>Application Métier</div>";
echo "</a>";

echo "<a href='".Plugin::getWebDir('servicecatalogue')."/front/submenu.php?type=advice' class='sc-card'>";
echo "<div class='sc-icon'><i class='fas fa-lightbulb fa-3x'></i></div>";
echo "<div class='sc-title'>Conseil SI</div>";
echo "</a>";
echo "</div>"; // fin .sc-cards

echo "</div>"; // fin .servicecatalogue-container

Html::footer();