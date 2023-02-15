jQuery('.about-toggle___button').on( 'click', function() {
    jQuery('.about-toggle__table').slideToggle();
    jQuery('.open-tab .fa-plus').slideToggle(0);
    jQuery('.open-tab .fa-minus').slideToggle(0);
});

jQuery(document).ready(function() {


    if( window.screen.width < 768 ) {

        jQuery('#table-link-plan-79mil').show();
        jQuery('#table-link-plan-149mil').hide();
        jQuery('#table-link-plan-299mil').hide();

        jQuery('#tabs li a:not(:first)').addClass('inactive');

        jQuery('.juzto-wrapper').hide();
        jQuery('.container').hide();

        jQuery('.container:first').show();
        jQuery('.juzto-wrapper:first').show();

        jQuery('#tabs li a').click(function(){
            console.log( jQuery( this ) );
            var t = jQuery(this).attr('id');
            console.log( t );
            jQuery(this).parent().siblings().removeClass('active');
            console.log(`Class removed!`);
            console.log(`Class removed! ${jQuery(this).parent()}`);

            if(jQuery(this).hasClass('inactive')){ //this is the start of our condition
                jQuery('#tabs li a').addClass('inactive');
                jQuery(this).removeClass('inactive');

                jQuery(this).parent().addClass('active');


                jQuery('.container').hide();
                jQuery('.juzto-wrapper').hide();
                jQuery('#'+ t + 'C').fadeIn('slow');
            }

            if( jQuery('#link-plan-1C').is(':visible') ) {
                jQuery('#table-link-plan-79mil').show();
                jQuery('#table-link-plan-149mil').hide();
                jQuery('#table-link-plan-299mil').hide();
            } else if( jQuery('#link-plan-2C').is(':visible') ) {
                jQuery('#table-link-plan-79mil').hide();
                jQuery('#table-link-plan-149mil').show();
                jQuery('#table-link-plan-299mil').hide();

            } else if( jQuery('#link-plan-3C').is(':visible')) {
                jQuery('#table-link-plan-79mil').hide();
                jQuery('#table-link-plan-149mil').hide();
                jQuery('#table-link-plan-299mil').show();
            }
        });
    }
});