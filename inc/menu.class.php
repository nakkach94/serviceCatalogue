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
        if (!Session::haveRight(self::$rightname, READ)) {
            return false;
        }

        // Menu principal "Service Catalogue"
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
                    'title' => __('Demandes de Support', 'servicecatalogue'),
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
                    'title' => __('Application Métier', 'servicecatalogue'),
                    'page'  => self::getSubmenuUrl('apps'),
                    'icon'  => 'fas fa-window-restore'
                ],
                'advice' => [
                    'title' => __('Conseil SI', 'servicecatalogue'),
                    'page'  => self::getSubmenuUrl('advice'),
                    'icon'  => 'fas fa-lightbulb'
                ]
            ]
        ];

        // Positionnement dans le menu principal
        $menu['position'] = 15; // Avant "Parc" (Assets) qui est à 20
        
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
}