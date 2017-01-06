<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<meta name="format-detection" content="telephone=no" />
<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php wp_head();?>
</head>
<body <?php body_class(); ?>>
<div class="site-container">
<div class="pusher">
    <header>
    <div class="grid">
            <a href="#" class="toggle" id="toggle"></a>
            <a href="<?= home_url(); ?>" class="logo">
            <img src="<?php bloginfo("template_directory"); ?>/images/les-fees-de-lassiette.png" alt="<?php bloginfo("name"); ?>">
            </a>
            <nav>
            <?php wp_nav_menu( array(
                                'theme_location' => 'main-menu',
                                'container'      => false,
            )); ?>
            </nav>
    </div>
    </header>
