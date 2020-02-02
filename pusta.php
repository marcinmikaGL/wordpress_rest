
<?php
if(has_post_thumbnail()){ 
    the_post_thumbnail( 'full', array( 'class' => 'wat_pho' ) ); 
} 
?>
<div class="container-fluid">
<?php 
    echo thaipan_make_content( $post->post_content );
?>
</div>