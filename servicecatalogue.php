<?php
if (!defined('GLPI_ROOT')) {
    die("Sorry. You can't access this file directly");
}

class PluginServicecatalogueServicecatalogue extends CommonDBTM {
    static $rightname = 'config';
}

function plugin_init_servicecatalogue() {
    global $PLUGIN_HOOKS;
    
    $PLUGIN_HOOKS['menu_toadd']['servicecatalogue'] = [
        'admin' => 'PluginServicecatalogueMenu'
    ];
    
    $PLUGIN_HOOKS['csrf_compliant']['servicecatalogue'] = true;
    $PLUGIN_HOOKS['config_page']['servicecatalogue'] = 'front/dashboard.php';
}

function plugin_version_servicecatalogue() {
    return [
        'name'           => 'Service Catalogue',
        'version'        => '1.0.0',
        'author'         => 'Votre Nom',
        'license'        => 'GPLv3+',
        'homepage'       => '',
        'requirements'   => [
            'glpi' => [
                'min' => '10.0.17',
                'max' => '11.0'
            ]
        ]
    ];
}