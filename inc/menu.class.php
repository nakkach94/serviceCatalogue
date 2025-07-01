<?php
if (!defined('GLPI_ROOT')) {
    die("Sorry. You can't access this file directly");
}

class PluginServicecatalogueMenu extends CommonGLPI {
    static $rightname = 'config';

    static function getMenuName() {
        return __('Service Catalogue', 'servicecatalogue');
    }

    static function getMenuContent() {
        $menu = [
            'title' => self::getMenuName(),
            'page'  => Plugin::getWebDir('servicecatalogue') . '/front/dashboard.php',
            'icon'  => 'fas fa-book-open',
            'options' => [
                'support' => [
                    'title' => __('Demande de support', 'servicecatalogue'),
                    'page'  => Plugin::getWebDir('servicecatalogue') . '/front/submenu.php?type=support',
                    'icon'  => 'fas fa-headset'
                ],
                'data' => [
                    'title' => __('Données', 'servicecatalogue'),
                    'page'  => Plugin::getWebDir('servicecatalogue') . '/front/submenu.php?type=data',
                    'icon'  => 'fas fa-database'
                ],
                'infra' => [
                    'title' => __('Infrastructure SI', 'servicecatalogue'),
                    'page'  => Plugin::getWebDir('servicecatalogue') . '/front/submenu.php?type=infra',
                    'icon'  => 'fas fa-server'
                ],
                'apps' => [
                    'title' => __('Applications Métier', 'servicecatalogue'),
                    'page'  => Plugin::getWebDir('servicecatalogue') . '/front/submenu.php?type=apps',
                    'icon'  => 'fas fa-window-restore'
                ],
                'advice' => [
                    'title' => __('Conseil SI', 'servicecatalogue'),
                    'page'  => Plugin::getWebDir('servicecatalogue') . '/front/submenu.php?type=advice',
                    'icon'  => 'fas fa-lightbulb'
                ]
            ]
        ];
        return $menu;
    }
}