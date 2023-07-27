<?php
/**
 * @since 1.0.0
 */
if( is_404() ){
    return;
} else {
    do_action( 'socoders_elements_footer_before' );
    do_action( 'socoders_elements_footer' );
} ?>
</div><!-- #page -->



 
<?php 
wp_footer(); ?>
</body>
</html> 
