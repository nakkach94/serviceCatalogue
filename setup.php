<?php
define('PLUGIN_SERVICECATALOGUE_VERSION', '1.0.0');
define('PLUGIN_SERVICECATALOGUE_MIN_GLPI', '10.0.17');
define('PLUGIN_SERVICECATALOGUE_MAX_GLPI', '11.0');

function plugin_init_servicecatalogue() {
    global $PLUGIN_HOOKS;
    
    // CORRECTION : Utiliser 'menu_toadd' pour ajouter un nouveau menu principal
    $PLUGIN_HOOKS['menu_toadd']['servicecatalogue'] = [
        'servicecatalogue' => 'PluginServicecatalogueMenu'
    ];
    $PLUGIN_HOOKS['menu_entries']['servicecatalogue'] = function() {
        return PluginServicecatalogueMenu::getMenuContent();
    };
    $PLUGIN_HOOKS['csrf_compliant']['servicecatalogue'] = true;
    $PLUGIN_HOOKS['config_page']['servicecatalogue'] = 'front/dashboard.php';
    
    // Ajouter les hooks nécessaires
    $PLUGIN_HOOKS['post_init']['servicecatalogue'] = 'plugin_servicecatalogue_postinit';
}

// Nouvelle fonction pour l'initialisation
function plugin_servicecatalogue_postinit() {
    Plugin::registerClass('PluginServicecatalogueMenu', [
        'addtabon' => ['Config']
    ]);
}


function plugin_version_servicecatalogue() {
    return [
        'name'           => 'Service Catalogue',
        'version'        => PLUGIN_SERVICECATALOGUE_VERSION,
        'author'         => 'Imad Nakkach',
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

function plugin_servicecatalogue_check_prerequisites() {
    if (version_compare(GLPI_VERSION, PLUGIN_SERVICECATALOGUE_MIN_GLPI, 'lt')) {
        echo "Ce plugin nécessite GLPI version " . PLUGIN_SERVICECATALOGUE_MIN_GLPI . " ou supérieure";
        return false;
    }
    return true;
}

function plugin_servicecatalogue_check_config($verbose = false) {
    if ($verbose) {
        echo "Configuration du plugin Service Catalogue est valide";
    }
    return true;
}

function plugin_servicecatalogue_install() {
    global $DB;
    
    $migration = new Migration(PLUGIN_SERVICECATALOGUE_VERSION);
    
    // Créer la table de configuration
    if (!$DB->tableExists('glpi_plugin_servicecatalogue_configs')) {
        $query = "CREATE TABLE `glpi_plugin_servicecatalogue_configs` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `value` TEXT COLLATE utf8mb4_unicode_ci,
            PRIMARY KEY (`id`),
            UNIQUE KEY `name` (`name`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
        $DB->queryOrDie($query, $DB->error());
        $migration->displayMessage("Table de configuration créée");
    }
    
    // Configuration par défaut
    $defaults = [
        'version' => PLUGIN_SERVICECATALOGUE_VERSION,
        'enable_dashboard' => 1,
        'menu_position' => 'left'
    ];
    
    foreach ($defaults as $name => $value) {
        $DB->insertOrDie('glpi_plugin_servicecatalogue_configs', [
            'name' => $name,
            'value' => is_array($value) ? json_encode($value) : $value
        ], "Erreur d'insertion de configuration par défaut");
    }
    
    return true;
}

function plugin_servicecatalogue_uninstall() {
    global $DB;
    
    $migration = new Migration(PLUGIN_SERVICECATALOGUE_VERSION);
    
    // Suppression de la table de configuration
    if ($DB->tableExists('glpi_plugin_servicecatalogue_configs')) {
        $DB->queryOrDie("DROP TABLE `glpi_plugin_servicecatalogue_configs`", $DB->error());
        $migration->displayMessage("Table de configuration supprimée");
    }
    
    // Nettoyage des fichiers temporaires (utilisation de la constante définie)
    $files_to_remove = [
        PLUGIN_SERVICECATALOGUE_ROOT . '/css/style.css',
        PLUGIN_SERVICECATALOGUE_ROOT . '/js/script.js',
        PLUGIN_SERVICECATALOGUE_ROOT . '/_tmp/*'
    ];
    
    foreach ($files_to_remove as $file) {
        if (file_exists($file)) {
            if (is_dir($file)) {
                array_map('unlink', glob("$file/*"));
                @rmdir($file);
            } else {
                @unlink($file);
            }
        }
    }
    
    return true;
}