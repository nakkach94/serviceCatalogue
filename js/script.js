// Scripts pour les fonctionnalités interactives
$(document).ready(function() {
    // Exemple: Gestion des onglets dans le tableau de bord
    $('.servicecatalogue-tab').on('click', function() {
        $('.servicecatalogue-tab').removeClass('active');
        $(this).addClass('active');
        
        const target = $(this).data('target');
        $('.servicecatalogue-tab-content').hide();
        $(target).show();
    });
    
    // Initialisation
    $('.servicecatalogue-tab:first').click();
});