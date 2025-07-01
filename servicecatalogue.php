<?php
if (!defined('GLPI_ROOT')) {
    die("Sorry. You can't access this file directly");
}

class PluginServicecatalogueServicecatalogue extends CommonDBTM {
    static $rightname = 'plugin_servicecatalogue';
    
    static function getTypeName($nb = 0) {
        return __('Service Catalogue', 'servicecatalogue');
    }
    
    static function install() {
        // Créer le droit dans la base de données
        $right = new ProfileRight();
        $right->updateProfileRights([0], [
            self::$rightname => READ + UPDATE + CREATE + PURGE
        ]);
        
        return true;
    }
    
    static function uninstall() {
        // Supprimer le droit
        $right = new ProfileRight();
        $right->deleteByCriteria(['name' => self::$rightname]);
        
        return true;
    }
    
    // Fonction cruciale pour l'affichage du menu
    static function addToMainMenu() {
        global $CFG_GLPI;
        
        $menu = PluginServicecatalogueMenu::getMenuContent();
        if ($menu !== false) {
            $CFG_GLPI['menu'][$menu['title']] = $menu;
        }
    }
}

// Ajouter le menu au démarrage de GLPI
PluginServicecatalogueServicecatalogue::addToMainMenu();