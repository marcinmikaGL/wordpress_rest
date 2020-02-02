
<?php 


    $li = 0;
    $boxy = '';
    $modale = '';
   
    
    while ( have_posts() ) : the_post();
    $li ++;
    
    if($li%2) {
    $boxy .= "\n<div class=\"d-none d-xl-block col-lg-6 col-md-12 aktualnosci_col\">".
                "<img src=\"".get_the_post_thumbnail_url($post->ID)."\" class=\"lokale1\" />".
                "</div>\n".
                "<div class=\"col-lg-6 col-md-12 lokal aktualnosci_col\" style=\"color:#fff\">\n".
                "<h2 class=\"aktualnosci_h2\">".$post->post_title.
                "</h2>\n<p class=\"aktualnosci_p\">".thaipan_make_content($post->post_content)."</p>\n".
                "</div>";
    } else {
        $boxy .="\n<div class=\"col-lg-6 col-md-12 lokal aktualnosci_col\" style=\"color:#fff\">".
                "<h2 class=\"aktualnosci_h2\">".$post->post_title.
                "</h2>\n <p class=\"aktualnosci_p\">".thaipan_make_content($post->post_content)."</p>\n".
                "</div>".
                "\n<div class=\"d-none d-xl-block col-lg-6 col-md-12 aktualnosci_col\">".
                "<img src=\"".get_the_post_thumbnail_url($post->ID)."\" class=\"lokale1\" />".
                "</div>";
                
        
    }

    endwhile;
?>
<div class="container-fluid">
     <div class="row aktualnosci_row">
    <?php echo $boxy; ?>
        </div>

    


