<?php
if (!defined('GLPI_ROOT')) {
    die("Sorry. You can't access this file directly");
}
define('PLUGIN_SERVICECATALOGUE_VERSION', '1.0.0');
define('PLUGIN_SERVICECATALOGUE_MIN_GLPI', '10.0.17');
define('PLUGIN_SERVICECATALOGUE_MAX_GLPI', '11.0');

function plugin_init_servicecatalogue() {
    global $PLUGIN_HOOKS;
    
    // Enregistrer le nouveau menu principal
    $PLUGIN_HOOKS['menu_toadd']['servicecatalogue'] = [
        'servicecatalogue' => 'PluginServicecatalogueMenu'
    ];
    
    $PLUGIN_HOOKS['csrf_compliant']['servicecatalogue'] = true;
    
    // Ajouter CSS et JS
    $PLUGIN_HOOKS['add_css']['servicecatalogue'] = 'css/style.css';
    $PLUGIN_HOOKS['add_javascript']['servicecatalogue'] = ['js/chart.min.js', 'js/script.js'];
}

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
    
    // Vérification de la présence de la classe Migration
    if (!class_exists('Migration')) {
        require_once(GLPI_ROOT . '/install/update_94_95/migration.class.php');
    }
    
    // Création de la table de configuration
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
    
    // Création des tables pour chaque service (optionnel)
    $services = ['support', 'data', 'infra', 'apps', 'advice'];
    foreach ($services as $service) {
        $table_name = "glpi_plugin_servicecatalogue_{$service}_items";
        if (!$DB->tableExists($table_name)) {
            $query = "CREATE TABLE `$table_name` (
                `id` INT(11) NOT NULL AUTO_INCREMENT,
                `name` VARCHAR(255) NOT NULL,
                `description` TEXT,
                `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                `updated_at` TIMESTAMP NULL DEFAULT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
            $DB->queryOrDie($query, $DB->error());
            $migration->displayMessage("Table $table_name créée");
        }
    }
    
    return true;
}

function plugin_servicecatalogue_uninstall() {
    global $DB;
    
    $migration = new Migration(PLUGIN_SERVICECATALOGUE_VERSION);
    
    // Suppression des tables de service
    $services = ['support', 'data', 'infra', 'apps', 'advice'];
    foreach ($services as $service) {
        $table_name = "glpi_plugin_servicecatalogue_{$service}_items";
        if ($DB->tableExists($table_name)) {
            $DB->queryOrDie("DROP TABLE `$table_name`", $DB->error());
            $migration->displayMessage("Table $table_name supprimée");
        }
    }
    
    // Suppression de la table de configuration
    if ($DB->tableExists('glpi_plugin_servicecatalogue_configs')) {
        $DB->queryOrDie("DROP TABLE `glpi_plugin_servicecatalogue_configs`", $DB->error());
        $migration->displayMessage("Table de configuration supprimée");
    }
    
    // Nettoyage des fichiers temporaires
    $files_to_remove = [
        PLUGIN_SERVICECATALOGUE_ROOT . '/css/style.css',
        PLUGIN_SERVICECATALOGUE_ROOT . '/js/script.js',
        PLUGIN_SERVICECATALOGUE_ROOT . '/_tmp/*'
    ];
    
    foreach ($files_to_remove as $file) {
        if (file_exists($file)) {
            if (is_dir($file)) {
                array_map('unlink', glob("$file/*"));
                rmdir($file);
            } else {
                unlink($file);
            }
        }
    }
    
    return true;
}

function plugin_servicecatalogue_upgrade($version) {
    $migration = new Migration(PLUGIN_SERVICECATALOGUE_VERSION);
    
    // Mises à jour pour les versions futures
    switch ($version) {
        case '1.0.0':
            // Ajouter des mises à jour spécifiques pour les versions futures
            // $migration->addField('glpi_plugin_servicecatalogue_configs', 'new_field', 'string');
            break;
    }
    
    return true;
}