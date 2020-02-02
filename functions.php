 <?php 

 /*
 * @package thai_pan
 */
include "advanced-bootstrap-carousel/advanced-bootstrap-carousel.php";
class Description_Walker extends Walker_Nav_Menu
{
    function start_el (&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $classes = empty($item->classes) ? array () : (array) $item->classes;
        $class_names = join(' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        !empty ( $class_names ) and $class_names = ' class="nav-item nav-link menu"';
        $output .= "                ";
        $attributes  = 'class="nav-item nav-link menu" ';
        !empty( $item->attr_title ) and $attributes .= ' title="'  . esc_attr( $item->attr_title ) .'"';
        !empty( $item->target ) and $attributes .= ' target="' . esc_attr( $item->target     ) .'"';
        !empty( $item->xfn ) and $attributes .= ' rel="'    . esc_attr( $item->xfn        ) .'"';
        !empty( $item->url ) and $attributes .= ' href="'   . esc_attr( $item->url        ) .'"';
        $title = apply_filters( 'the_title', $item->title, $item->ID );
        $item_output = $args->before
        . "<a $attributes>"
        . $args->link_before
        . $title
        . '</a>'
       ;
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

}



function additional_custom_styles() { wp_enqueue_style( 'uniquestylesheetid', get_template_directory_uri() . '/css/index.css' );  }
function footer_function() {  include_once('footer.php'); }
function header_function() {  include_once('header.php'); }
function register_my_menu() { register_nav_menu('new-menu',__( 'New Menu' )); }


add_action( 'init', 'register_my_menu' );
add_action( 'wp_enqueue_scripts', 'additional_custom_styles' );
add_action( 'wp_footer', 'footer_function' );
add_action('wp_head', 'header_function');
add_theme_support( 'post-thumbnails' );


add_action( 'add_meta_boxes', 'thaipan_add_meta_box_template' );
function thaipan_add_meta_box_template()
{
    add_meta_box(
        'thaipan-meta-box-template',
        __( 'Rodzaj template' ),
        'thaipan_meta_box_template_cb',
        'page',
        'side',
        'low'
    );
    add_meta_box(
        'thaipan-meta-box-cennik',
        __( 'Cennik popup body' ),
        'thaipan_meta_box_cennik_cb',
        'post',
        'normal',
        'high'
    );
    add_meta_box(
        'thaipan-meta-box-background',
        __( 'Cennik box background' ),
        'thaipan_meta_box_cennikbackground_cb',
        'post',
        'side',
        'high'
    );
}

function thaipan_meta_box_cennik_cb ( $post ) {
    $values = get_post_custom( $post->ID );
    $text = isset( $values['thaipan_meta_box_cennik_text'] ) ? $values['thaipan_meta_box_cennik_text'][0] : "";
    $quicktags_settings = array( 'buttons' => 'strong,em,link,block,del,ins,img,ul,ol,li,code,close' );
    wp_nonce_field( 'thaipan_meta_box_cennik_nonce', 'meta_box_nonce' );
    wp_editor($text, 'thaipan_meta_box_cennik_text', array( 'media_buttons' => false, 'tinymce' => true, 'quicktags' => $quicktags_settings ) );
}

function thaipan_meta_box_cennikbackground_cb( $post ) {
    $values = get_post_custom( $post->ID );
    $selected = isset( $values['thaipan_meta_box_cennik_background'] ) ? esc_attr( $values['thaipan_meta_box_cennik_background'][0] ) : "";
    ?>
    <p>
        <select name="thaipan_meta_box_cennik_background" id="thaipan_meta_box_cennik_background">
            <option value="masaze_tlo_bloku1" <?php selected( $selected, 'masaze_tlo_bloku1' ); ?>>masaze_tlo_bloku1</option>
            <option value="masaze_tlo_bloku2" <?php selected( $selected, 'masaze_tlo_bloku2' ); ?>>masaze_tlo_bloku2</option>
            <option value="masaze_tlo_bloku3" <?php selected( $selected, 'masaze_tlo_bloku3' ); ?>>masaze_tlo_bloku3</option>
            <option value="masaze_tlo_bloku4" <?php selected( $selected, 'masaze_tlo_bloku4' ); ?>>masaze_tlo_bloku4</option>
            <option value="masaze_tlo_bloku5" <?php selected( $selected, 'masaze_tlo_bloku5' ); ?>>masaze_tlo_bloku5</option>
            <option value="masaze_tlo_bloku6" <?php selected( $selected, 'masaze_tlo_bloku6' ); ?>>masaze_tlo_bloku6</option>
            <option value="masaze_tlo_bloku7" <?php selected( $selected, 'masaze_tlo_bloku7' ); ?>>masaze_tlo_bloku7</option>
        </select>
    </p>
    <?php
}

function thaipan_meta_box_template_cb( $post ) {
    $values = get_post_custom( $post->ID );
    $selected = isset( $values['thaipan_meta_box_template_select'] ) ? esc_attr( $values['thaipan_meta_box_template_select'][0] ) : "";
    wp_nonce_field( 'thaipan_add_meta_box_template', 'meta_box_nonce' );
    ?>
    <p>
        <select name="thaipan_meta_box_template_select" id="thaipan_meta_box_template_select">
            <option value="content" <?php selected( $selected, 'content' ); ?>>Strona glówna</option>
            <option value="pusta" <?php selected( $selected, 'pusta' ); ?>>Pusta</option>
            <option value="galery" <?php selected( $selected, 'galery' ); ?>>Galeria</option>
            <option value="produkty" <?php selected( $selected, 'produkty' ); ?>>Produkty</option>
            <option value="menu" <?php selected( $selected, 'menu' ); ?>>Menu</option>
        </select>
    </p>
    <?php
}

add_action( 'save_post', 'thaipan_add_meta_box_template_save' );
function thaipan_add_meta_box_template_save( $post_id )
{
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if( !current_user_can( 'edit_post' ) ) return;
    if( isset( $_POST['meta_box_nonce'] ) && wp_verify_nonce( $_POST['meta_box_nonce'], 'thaipan_add_meta_box_template' ) ) {
        if( isset( $_POST['thaipan_meta_box_template_select'] ) ) update_post_meta( $post_id, 'thaipan_meta_box_template_select', esc_attr( $_POST['thaipan_meta_box_template_select'] ) );
    }
    if( isset( $_POST['meta_box_nonce'] ) && wp_verify_nonce( $_POST['meta_box_nonce'], 'thaipan_meta_box_cennik_nonce' ) ) {
        if( isset( $_POST['thaipan_meta_box_cennik_text'] ) ) update_post_meta( $post_id, 'thaipan_meta_box_cennik_text', $_POST['thaipan_meta_box_cennik_text'] );
        if( isset( $_POST['thaipan_meta_box_cennik_background'] ) ) update_post_meta( $post_id, 'thaipan_meta_box_cennik_background', esc_attr( $_POST['thaipan_meta_box_cennik_background'] ) );
    }

}

function thaipan_make_content( $output ) {
    $output = force_balance_tags( $output );
    $output = apply_filters( 'the_content', $output );
    $output = str_replace( ']]>', ']]&gt;', $output );
    return $output;
}

function thaipan_slider($atts){


    $args = array(
        'post_type' => 'twabc',
        'posts_per_page' => '-1',
        'twabc_category' =>  $atts['category']
    );
  

  
    if(!isset($atts['image_size'])) $atts['image_size'] = 'full';
    if(!isset($atts['use_javascript_animation'])) $atts['use_javascript_animation'] = '1';
    if($atts['id'] != ''){
        $args['p'] = $atts['id'];
    }
    ?>
      <div id="przykladowaKaruzela4" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
    <?php


    // Collect the carousel content. Needs printing in two loops later (bullets and content)
    $loop = new WP_Query( $args );
   $i = -1;
    $images = array();
    $output_top = '';
    $output_bottom = '';

    while ( $loop->have_posts() ) {
        $i++;
        if($i == 0) { $active = ' active';} else {  $active = '';}
     
      
      $output_top  .= '<li data-target="#przykladowaKaruzela4" data-slide-to="'.$i.'" class="item'.$i.''.$active.'"></li>';
      $output_top  .= "\n";
        $loop->the_post();
        if ( '' != get_the_post_thumbnail(get_the_ID(), $atts['image_size']) ) {
            $post_id = get_the_ID();
            $title = get_the_title();
            $content = get_the_excerpt();
            
            $image_src = wp_get_attachment_image_src(get_post_thumbnail_id(), $atts['image_size']);
            $image_src_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'featured_preview');
            $image_src = $image_src[0];
            $image_src_thumb = $image_src_thumb[0];
            $images[] = array('post_id' => $post_id, 'title' => $title, 'content' => $content, 'img_src' => $image_src);
        }
       $output_bottom .= '<div class="carousel-item tlo_slajd2">';
       $output_bottom .= "\n";
       $output_bottom .= '<img src="'.$image_src.'" alt="slajd" class="slajdy_masazu">';
       $output_bottom .= "\n";
       $output_bottom .= '<div class="carousel-caption">';
       $output_bottom .= "\n";
       $output_bottom .= '<h4 class="masaz_slajd_tekst">'.$title.'</h4>';
       $output_bottom .= "\n";
       $output_bottom .= '<p>'.$content.'</p>';
       $output_bottom .=  '</div>';
       $output_bottom .= "\n";
       $output_bottom .=  '</div>';
    }
    
    echo $output_top ;

?> 
    </ol>
     <div class="carousel-inner">
<?php echo $output_bottom; ?>
<a class="carousel-control-prev" href="#przykladowaKaruzela4" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Poprzedni</span>
                    </a>
                    <a class="carousel-control-next" href="#przykladowaKaruzela4" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Następny</span>
                    </a>
     </div>       
          

        </div>



    
<?php

}

function thai_pan_get_photo() {
$i = 2;    
$args = array(
    'post_type' => 'attachment',
    'post_status' => 'published',
    'orderby' => 'title',
    'order'   => 'ASC',
    'posts_per_page' =>25,
    'numberposts' => null
);

$attachments = get_posts($args);
$post_count = count ($attachments);
 echo '<div class="row">';
if ($attachments) {
    foreach ($attachments as $attachment) {
        if($attachment->post_excerpt == 'galeria') {
          
            if($i == 2) { 
                $i= 0; 
                $kolumna = 'galeria_kolumna';
            } else { 
                $kolumna = '';
                $i++;

        }

             echo "\n<div class=\"col-xl-3 col-lg-5 col-md-8  ".$kolumna." galeria_1366px\">";   
             $img = wp_get_attachment_url($attachment->ID);
             echo "\n";
        echo '<img  alt="'.$attachment->post_title.'" src="'.$img.'" class="galeria">';
        echo "\n</div>";
       
        }
    }   
}

echo '</div>';

}


