<?php 
/*
 * @package thai_pan
 */
?>
<!-- pl /home/masaztajskikatowice/public_html/deny/pl/index.html-->
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php wp_title('');  echo " | "; bloginfo( 'name' ); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo get_template_directory_uri(); ?>/css/index.css?v=4" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="/"><img src="<?php echo get_template_directory_uri(); ?>/image/logo.png" alt="" class="logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <?php 
            $start = "\n<li class=\"nav-item\">\n";
            $args = array(
                'menu_class'        => "collapse navbar-collapse", 
                'menu_id'           => "navbarNavAltMarkup",
                'container'         => "div", 
                'container_class'   => "navbar-nav",
                'theme_location'    => "new-menu",
                'depth' => 0,
                'echo' => false,
                'items_wrap' => $start.'%3$s', 
                'walker' => new Description_Walker 
            );
            $menu = str_replace("<ul class=\"sub-menu\">","<li class=\"nav-item dropdown\"> ",wp_nav_menu($args));
            $menu = str_replace("</li>"," ",$menu);
            $menu = str_replace("</ul>","\n</div>\n</li>",$menu);
            $menu = str_replace("<div class=\"navbar-nav\">           ","<div class=\"navbar-nav\">\n",$menu);      
            $menu = str_replace("<li class=\"nav-item dropdown\">","</li>\n <li class=\"nav-item dropdown\"> \n                <a class=\"nav-link dropdown-toggle menu\" href=\"/menu/\" id=\"navbarDropdown\" data-toggle=\"dropdown\" role=\"button\">Menu <span class=\"caret\"></span></a> \n<div class=\"dropdown-menu menu\" aria-labelledby=\"navbarDropdown\">\n",$menu);    
            //todo
            $menu = str_replace("<a class=\"nav-item nav-link menu\"  href=\"#\">Menu</a>","",$menu);   
            $menu = str_replace("<a class=\"nav-item nav-link menu\"  href=\"#\">Menu</a>","<li class=\"nav-item\">",$menu); 
           
            echo $menu; 
?>
            <div class="lang">
  <?php           
if ( function_exists ( 'wpm_language_switcher' ) ) wpm_language_switcher ('list','flag');
         ?>
            </div>
        </div>
    </nav>


