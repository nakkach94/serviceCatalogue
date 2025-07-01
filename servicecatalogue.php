<?php
if (!defined('GLPI_ROOT')) {
    die("Sorry. You can't access this file directly");
}

class PluginServicecatalogueServicecatalogue extends CommonDBTM {
    static $rightname = 'config';
    
    static function getTypeName($nb = 0) {
        return __('Service Catalogue', 'servicecatalogue');
    }
    
    static function getMenuContent() {
        return PluginServicecatalogueMenu::getMenuContent();
    }
}