<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Jeverly
 */

?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'jeverly' ); ?></a>

    <div class="jeverly-container">
        <div class="javerly-frontier">
            <header id="masthead" class="site-header">
                <div class="site-branding">
                    <?php
                        the_custom_logo();

                        if ( is_front_page() && is_home() ) :
                    ?>

                            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

                    <?php
                        else :
                    ?>

                        <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>

                    <?php
                        endif;

                        $jeverly_description = get_bloginfo( 'description', 'display' );

                        if ( $jeverly_description || is_customize_preview() ) :
                    ?>

                        <p class="site-description"><?php echo $jeverly_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

                    <?php endif; ?>
                </div><!-- .site-branding -->

                <nav id="site-navigation" class="main-navigation">

                    <div class="toggle-menu-wrapper">
                        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                            <div class="lines line-top"></div>
                            <div class="lines line-mid"></div>
                            <div class="lines line-bottom"></div>
                            <span class="hide-text"><?php esc_html_e( 'Primary Menu', 'jeverly' ); ?></span>
                        </button>
                    </div>

                    <?php
                        if ( has_nav_menu( 'menu-1' ) ) {
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'menu-1',
                                    'menu_id'        => 'primary-menu',
                                    'depth'          => 3,
                                    'reverse'        => FALSE,
                                )
                            );
                        } else {
                            echo 'Please set you menus here';
                        }
                    ?>


                </nav><!-- #site-navigation -->
            </header><!-- #masthead -->
            <div class="site-primary-menu-responsive">
               <nav id="site-navigation" class="site-primary-menu-responsive-nav-navigation">
                    <?php
                        if ( has_nav_menu( 'menu-1' ) ) {
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'menu-1',
                                    'menu_id'        => 'primary-menu',
                                    'depth'          => 3,
                                    'reverse'        => FALSE,
                                )
                            );
                        } else {
                            echo 'Please set you menus here';
                        }
                    ?>
                </nav><!-- #site-navigation -->
            </div>
        </div>
    </div>