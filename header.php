<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<meta name="format-detection" content="telephone=no" />
<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/style.min.css" />
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
            <img src="<?php bloginfo("template_directory"); ?>/images/image.png" alt="<?php bloginfo("name"); ?>">
            </a>
            <nav role="navigation">
            <?php wp_nav_menu( array(
                                'theme_location' => 'nav',
                                'container'      => false,
            )); ?>
            </nav>
    </div>
</header>




