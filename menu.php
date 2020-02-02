
<div class="container-fluid">
       <div class="row">
            <div class="col-lg-12">
                <img src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" alt="" class="zdjecie_dania_glowne">
                <div class="centered"><?php echo $post->post_title; ?></div>
            </div>

        </div>
    
    <?php echo thaipan_make_content( $post->post_content ); ?>
</div>
