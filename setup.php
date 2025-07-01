<?php
define('PLUGIN_SERVICECATALOGUE_VERSION', '1.0.0');
define('PLUGIN_SERVICECATALOGUE_MIN_GLPI', '10.0.17');
define('PLUGIN_SERVICECATALOGUE_MAX_GLPI', '11.0');

function plugin_init_servicecatalogue() {
    global $PLUGIN_HOOKS;
    
    $PLUGIN_HOOKS['menu_toadd']['servicecatalogue'] = [
        'admin' => 'PluginServicecatalogueMenu'
    ];
    
    $PLUGIN_HOOKS['csrf_compliant']['servicecatalogue'] = true;
    $PLUGIN_HOOKS['config_page']['servicecatalogue'] = 'front/dashboard.php';
}

// CORRECTION : Fonction de versionnement correctement définie
function plugin_version_servicecatalogue() {
    return [
        'name'           => 'Service Catalogue',
        'version'        => PLUGIN_SERVICECATALOGUE_VERSION,
        'author'         => 'Votre Nom',
        'license'        => 'GPLv3+',
        'homepage'       => '',
        'requirements'   => [
            'glpi' => [
                'min' => PLUGIN_SERVICECATALOGUE_MIN_GLPI,
                'max' => PLUGIN_SERVICECATALOGUE_MAX_GLPI
            ]
        ]
    ];
}

// AJOUT : Vérification des prérequis
function plugin_servicecatalogue_check_prerequisites() {
    if (version_compare(GLPI_VERSION, PLUGIN_SERVICECATALOGUE_MIN_GLPI, 'lt')) {
        echo "Ce plugin nécessite GLPI version " . PLUGIN_SERVICECATALOGUE_MIN_GLPI . " ou supérieure";
        return false;
    }
    return true;
}

// AJOUT : Vérification de la configuration
function plugin_servicecatalogue_check_config() {
    return true;
}