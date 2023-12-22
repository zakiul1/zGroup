<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package zgroup
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="< ?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#blue-600">
            <?php esc_html_e('Skip to content', 'zgroup'); ?>
        </a>

        <header id="masthead" class="site-header">
            <!-- Header.Ribbon -->
            <div class="bg-slate-400 py-1">
                <div class="container flex justify-between items-center">
                    <!-- Social Icon -->
                    <div>Social</div>
                    <!-- Mail Icon -->
                    <div>Mail</div>
                </div>
            </div>
            <!-- Header.Ribbon End-->


            <!-- Logo and Other Cntact section Start-->

            <div>
                <div class="container flex justify-between items-center py-1">
                    <!-- Side Branding Logo -->
                    <div>

                        <div class="site-branding logo flex items-center">
                            <div>
                                <?php the_custom_logo(); ?>
                            </div>
                            <?php
                            if (is_front_page() && is_home()):
                                ?>
                            <div>
                                <h2 class="site-title text-gray-900 text-2xl font-semibold uppercase"><a
                                        href=" <?php echo esc_url(home_url('/')); ?>" rel="home">
                                        <?php bloginfo('name'); ?>
                                    </a>
                                </h2>
                            </div>
                            <?php
                            else:
                                ?>
                            <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                    <?php bloginfo('name'); ?>
                                </a>
                            </p>
                            <?php
                            endif;
                            $zgroup_description = get_bloginfo('description', 'display');
                            if ($zgroup_description || is_customize_preview()):
                                ?>
                            <p class="site-description">
                                <?php echo $zgroup_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                            </p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- Contact Info-->
                    <div>
                        Contact
                    </div>
                </div>
            </div>

            <!-- Logo and Other Cntact section End-->






            <!-- Menu  Section -->




            <!-- Menu  Section -->






        </header><!-- #masthead -->