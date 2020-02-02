<?php
wp_enqueue_style( 'twabc', plugins_url('asset/css/twabc-advanced-3.css',__FILE__ ), array(), TWABC_VERSION );
// First content - the carousel indicators
			if( count( $images ) > 1 ){ 
			
			if($atts['showindicator'] != 'false') { ?>
            
				<ol class="carousel-indicators">
				<?php 
				$ind = 0;
				foreach ($images as $key => $image) { 
				$ind++;
				?>
					<li data-target="carousel-example-generic" data-slide-to="<?php echo $key; ?>" <?php echo $key == 0 ? 'class="active"' : ''; ?>><?php if($atts['showindicator'] === 'numbered') {echo $ind;} ?></li>
				<?php } ?>
				</ol>
			<?php }
			}?>

			<div class="carousel-inner">
			<?php
			// Carousel Content
			foreach ($images as $key => $image) {
				?>

				<div class="carousel-item <?php echo $key == 0 ? 'active' : ''; ?>">
					<?php
					// Regular behaviour - display image with link around it
					// The Caption div
					// Caption
						echo "<img class=\"zdjecie_carousel\" src=\"".$image['img_src']."\" alt=\"".$image['title']."\" />\n";
						if(strlen($image['content']) > 0){
							echo '		  		<div class="carousel-caption">';
                                                        echo  "\n                  <h3 class=\"carusel_text\">";
							echo $image['content'];
							echo " \n               </h3>\n</div>\n";
						}	
					?>
				</div>
			<?php } ?>
			</div>

			<?php // Previous / Next controls
			if( count( $images ) > 1 ){
				if($atts['showcontrols'] === 'true') { ?>
					<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
					<a class="right carousel-control" href="#carousel-example-generic" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
				<?php }
			} ?>