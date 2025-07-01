<?php
include ('../../../inc/includes.php');
Plugin::load('servicecatalogue', true);

Html::header(
    PluginServicecatalogueMenu::getMenuName(), 
    '', 
    "config", 
    "pluginservicecataloguemenu", 
    "config"
);

// Vérifier les droits
if (!Session::haveRight('config', UPDATE)) {
    Html::displayRightError();
    exit;
}

echo "<div class='center' style='width: 80%; margin: 30px auto;'>";
echo "<h2><i class='fas fa-cog'></i> " . __('Configuration du Service Catalogue', 'servicecatalogue') . "</h2>";

// Formulaire de configuration
echo "<form method='post' action='".Toolbox::getItemTypeFormURL('Config')."'>";
echo "<input type='hidden' name='config_context' value='plugin:servicecatalogue'>";
echo "<input type='hidden' name='config_class' value='Config'>";

// Exemple de paramètre
echo "<div class='form-group row'>";
echo "<label class='col-form-label col-sm-4'>".__('Position du menu', 'servicecatalogue')."</label>";
echo "<div class='col-sm-8'>";
Dropdown::showFromArray('menu_position', [
    'left'  => __('Gauche'),
    'top'   => __('Haut')
], [
    'value' => Config::getConfigurationValue('plugin:servicecatalogue', 'menu_position', 'left')
]);
echo "</div></div>";

// Bouton de soumission
echo "<div class='form-group row'>";
echo "<div class='col-sm-12 text-center'>";
echo "<button type='submit' name='update' class='btn btn-primary'>";
echo "<i class='fas fa-save'></i> " . __('Enregistrer');
echo "</button>";
echo "</div></div>";

echo "</form>";
echo "</div>";

Html::footer();