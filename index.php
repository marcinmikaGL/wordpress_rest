<?php
 /*
 * @package thai_pan
 */

get_header();
wpm_translate_url ('/', $language = "pl");
        global $wp_query;
        $max_pages = $wp_query->max_num_pages;
        if ( $post->post_type == 'page' ) {
            /*
            $content = get_the_content();
            $content = apply_filters( 'the_content', $content );
            $content = str_replace( ']]>', ']]&gt;', $content );
            echo $content;
            */
            $values = get_post_custom( $post->ID );
            if ( is_array( $values['thaipan_meta_box_template_select'] ) ) {
                get_template_part( $values['thaipan_meta_box_template_select'][0] );
            }else{
                get_template_part( 'default' );
            }
        }else{
            get_template_part( 'produkty'  );
        }
        wp_reset_query(); 
          
    ?>

<?php get_footer();
