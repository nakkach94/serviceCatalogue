<?php
if (!defined('GLPI_ROOT')) {
    die("Sorry. You can't access this file directly");
}

class PluginServicecatalogueMenu extends CommonGLPI {
    static $rightname = 'plugin_servicecatalogue';

    static function getTypeName($nb = 0) {
        return __('Service Catalogue', 'servicecatalogue');
    }

    static function getMenuName() {
        return self::getTypeName();
    }

    static function getMenuContent() {
        // Vérifier les droits d'accès
        if (!Session::haveRight(self::$rightname, READ)) {
            return false;
        }

        $menu = [
            'title' => self::getMenuName(),
            'page'  => self::getDashboardUrl(),
            'icon'  => 'fas fa-book-open',
            'options' => [
                'dashboard' => [
                    'title' => __('Tableau de bord', 'servicecatalogue'),
                    'page'  => self::getDashboardUrl(),
                    'icon'  => 'fas fa-chart-bar'
                ],
                'support' => [
                    'title' => __('Demande de support', 'servicecatalogue'),
                    'page'  => self::getSubmenuUrl('support'),
                    'icon'  => 'fas fa-headset'
                ],
                'data' => [
                    'title' => __('Données', 'servicecatalogue'),
                    'page'  => self::getSubmenuUrl('data'),
                    'icon'  => 'fas fa-database'
                ],
                'infra' => [
                    'title' => __('Infrastructure SI', 'servicecatalogue'),
                    'page'  => self::getSubmenuUrl('infra'),
                    'icon'  => 'fas fa-server'
                ],
                'apps' => [
                    'title' => __('Applications Métier', 'servicecatalogue'),
                    'page'  => self::getSubmenuUrl('apps'),
                    'icon'  => 'fas fa-window-restore'
                ],
                'advice' => [
                    'title' => __('Conseil SI', 'servicecatalogue'),
                    'page'  => self::getSubmenuUrl('advice'),
                    'icon'  => 'fas fa-lightbulb'
                ],
                'config' => [
                    'title' => __('Configuration', 'servicecatalogue'),
                    'page'  => self::getConfigUrl(),
                    'icon'  => 'fas fa-cog',
                    'right' => 'config' // Nécessite les droits de configuration
                ]
            ]
        ];

        // Ajouter l'élément de menu au menu "Administration"
        $menu['default'] = $menu['options']['dashboard']['page'];
        
        return $menu;
    }

    static function getDashboardUrl() {
        return Plugin::getWebDir('servicecatalogue') . '/front/dashboard.php';
    }

    static function getSubmenuUrl($type = 'support') {
        $valid_types = ['support', 'data', 'infra', 'apps', 'advice'];
        $type = in_array($type, $valid_types) ? $type : 'support';
        return Plugin::getWebDir('servicecatalogue') . "/front/submenu.php?type=$type";
    }

    static function getConfigUrl() {
        return Plugin::getWebDir('servicecatalogue') . '/front/config.form.php';
    }

    static function getIcon() {
        return 'fas fa-book-open';
    }

    static function removeRightsFromSession() {
        if (isset($_SESSION['glpimenu']['admin']['types']['PluginServicecatalogueMenu'])) {
            unset($_SESSION['glpimenu']['admin']['types']['PluginServicecatalogueMenu']);
        }
        if (isset($_SESSION['glpimenu']['admin']['content']['pluginservicecataloguemenu'])) {
            unset($_SESSION['glpimenu']['admin']['content']['pluginservicecataloguemenu']);
        }
    }

    // Fonction pour définir les droits dans les profils
    static function getAllRights($all = false) {
        $rights = [
            [
                'itemtype'  => __CLASS__,
                'label'     => __('Accès au catalogue de services', 'servicecatalogue'),
                'field'     => self::$rightname,
                'rights'    => [
                    READ    => __('Lire'),
                    UPDATE  => __('Modifier'),
                    CREATE  => __('Créer'),
                    PURGE   => __('Supprimer')
                ],
                'default'   => [
                    READ    => 1,
                    UPDATE  => 0,
                    CREATE  => 0,
                    PURGE   => 0
                ]
            ]
        ];

        if ($all) {
            $rights[] = [
                'itemtype'  => __CLASS__,
                'label'     => __('Configuration avancée', 'servicecatalogue'),
                'field'     => 'plugin_servicecatalogue_config',
                'rights'    => [
                    UPDATE  => __('Modifier')
                ],
                'default'   => [
                    UPDATE  => 0
                ]
            ];
        }

        return $rights;
    }

    // Ajout de l'élément dans le menu principal
    static function addToMainMenu() {
        global $CFG_GLPI;

        $menu = self::getMenuContent();
        if ($menu !== false) {
            Plugin::registerClass(__CLASS__, ['addtabon' => ['Config']);

            $CFG_GLPI['admin_types'][] = __CLASS__;
            $CFG_GLPI['admin_menu'][] = 'pluginservicecataloguemenu';
            
            $_SESSION['glpimenu']['admin']['types']['PluginServicecatalogueMenu'] = 0;
            $_SESSION['glpimenu']['admin']['content']['pluginservicecataloguemenu'] = $menu;
        }
    }
}

// Ajouter le menu au démarrage de GLPI
if (method_exists('Plugin', 'registerClass')) {
    Plugin::registerClass('PluginServicecatalogueMenu', [
        'addtabon' => ['Config']
    ]);
}