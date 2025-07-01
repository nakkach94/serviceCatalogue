<?php
include ('../../../inc/includes.php');
Plugin::load('servicecatalogue', true);

Html::header(
    'GIFI - Service Catalogue', 
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

// Menu latéral gauche
echo "<div class='sc-container'>";
echo "<div class='sc-sidebar'>";

// Section: Demandes de Support
echo "<div class='sc-sidebar-section'>";
echo "<div class='sc-sidebar-title'><i class='fas fa-life-ring'></i> Demandes de Support</div>";
echo "<ul>";
echo "<li><a href='#' class='active'><i class='fas fa-ticket-alt'></i> Tickets ouverts</a></li>";
echo "<li><a href='#'><i class='fas fa-history'></i> Historique</a></li>";
echo "<li><a href='#'><i class='fas fa-chart-line'></i> Statistiques</a></li>";
echo "</ul>";
echo "</div>";

// Section: Données
echo "<div class='sc-sidebar-section'>";
echo "<div class='sc-sidebar-title'><i class='fas fa-database'></i> Données</div>";
echo "<ul>";
echo "<li><a href='#'><i class='fas fa-file-contract'></i> Documents</a></li>";
echo "<li><a href='#'><i class='fas fa-key'></i> Licences</a></li>";
echo "</ul>";
echo "</div>";

// Section: Infrastructure SI
echo "<div class='sc-sidebar-section'>";
echo "<div class='sc-sidebar-title'><i class='fas fa-server'></i> Infrastructure SI</div>";
echo "<ul>";
echo "<li><a href='#'><i class='fas fa-desktop'></i> Ordinateurs</a></li>";
echo "<li><a href='#'><i class='fas fa-print'></i> Imprimantes</a></li>";
echo "<li><a href='#'><i class='fas fa-network-wired'></i> Réseau</a></li>";
echo "<li><a href='#'><i class='fas fa-phone'></i> Téléphonie</a></li>";
echo "</ul>";
echo "</div>";

// Section: Application Métier
echo "<div class='sc-sidebar-section'>";
echo "<div class='sc-sidebar-title'><i class='fas fa-window-maximize'></i> Application Métier</div>";
echo "<ul>";
echo "<li><a href='#'><i class='fas fa-box'></i> Logiciels</a></li>";
echo "<li><a href='#'><i class='fas fa-cloud'></i> Services Cloud</a></li>";
echo "</ul>";
echo "</div>";

// Section: Conseil SI
echo "<div class='sc-sidebar-section'>";
echo "<div class='sc-sidebar-title'><i class='fas fa-lightbulb'></i> Conseil SI</div>";
echo "<ul>";
echo "<li><a href='#'><i class='fas fa-project-diagram'></i> Projets</a></li>";
echo "<li><a href='#'><i class='fas fa-chalkboard-teacher'></i> Formations</a></li>";
echo "</ul>";
echo "</div>";

echo "</div>"; // fin .sc-sidebar

// Contenu principal - VIDE comme dans l'image
echo "<div class='sc-content'>";
echo "<div class='sc-content-empty'>";
echo "<p>Sélectionnez une option dans le menu de gauche pour afficher le contenu</p>";
echo "</div>";
echo "</div>"; // fin .sc-content

echo "</div>"; // fin .sc-container
echo "</div>"; // fin .sc-dashboard

Html::footer();