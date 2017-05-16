/**
 * Created by jucachap on 5/13/17.
 */

jQuery(document).ready(function(){
    jQuery('#page-title').html('Recuperación de Información');

    $html_content = jQuery('#cluster').html();
    jQuery('#cluster').hide();
    jQuery('#categories-left-nav').html($html_content);

    jQuery('#cluster ul li, #categories-left-nav ul li').click(function(e) {
        e.preventDefault();
        $cat_name = jQuery(this).find('span').html();
        $results = jQuery('#results');

        switch ($cat_name) {

            case 'Mostrar Todos':
                show_by_cluster($results, $cat_name, false);
                break;

            default:
                show_by_cluster($results, $cat_name, true);
                break;
        }
        return false;
    });
});

function show_by_cluster($results, $cluster_name, $switch) {
    $results.find('> div').each(function() {
        if ($switch && jQuery(this).attr('class') != $cat_name) {
            jQuery(this).hide();
        }
        else {
            jQuery(this).show();
        }
    });
}