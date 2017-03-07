<?php
/*
Template Name: Home
*/

get_header();
?>
    <!-- SLIDER -->
    <div id="outerslider">
        <div class="container">
            <div class="row">
                <div id="slidercontainer" class="twelve columns">

                    <section id="slider">
                        <div id="slideritems" class="flexslider">
                            <ul class="slides">

                                <?php
                                $args = [
                                    'category_name' => 'featured'
//                                    'post_type' => 'post',
//                                    'order' => 'DESC',
//                                    'orderby' => 'date',
//                                    'posts_per_page' => 3
                                ];


                                $the_query = new WP_Query($args);
                                // The Loop
                                if ($the_query->have_posts()) :
                                    while ($the_query->have_posts()) : $the_query->the_post();
                                        ?>
                                        <li>
                                            <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('slider', ['style' => 'width: 1159px']); ?></a>
                                            <div class="flex-caption">
                                                <h1><?php the_title(); ?></h1>
                                                <p>
                                                    <?= shorten_excerpt(get_the_excerpt()); ?>
                                                </p>
                                            </div>
                                        </li>
                                    <?php endwhile;
                                endif;
                                // Reset Post Data
                                wp_reset_postdata();


                                ?>


                            </ul>
                            <img src="<?= get_template_directory_uri() ?>/images/slider-shadow.png" alt=""/>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>
    <!-- END SLIDER -->

    <!-- MAIN CONTENT -->
    <div id="outermain">
        <div class="container">
            <div class="row">
                <section id="maincontent" class="twelve columns">

                    <section class="content">

                        <div class="highlight-content">


                            <h1 style="color: <?= get_theme_mod('boja'); ?>"><?= get_theme_mod('wedding_slogan'); ?></h1>
                        </div>

                        <div id="featured" class="row">
                            <?php dynamic_sidebar('homepage') ?>
                        </div>


                        <div class="separator"></div>

                        <div class="row">
                            <?php
                            $args = [
                                'post_type' => 'about-them',
                                'posts_per_page' => 2,
                                'order' => 'DESC',
                                'orderby' => 'title',
                            ];


                            $the_query = new WP_Query($args);
                            // The Loop
                            if ($the_query->have_posts()) :
                                while ($the_query->have_posts()) : $the_query->the_post();
                                    ?>
                                    <div class="one_half columns">
                                        <div class="frame10 circle">
                                            <?php the_post_thumbnail('about') ?>
                                        </div>
                                        <div class="indentleft">
                                            <h3 class="title"><?php the_title() ?></h3>
                                            <p><?= shorten_excerpt(get_the_excerpt(), 200); ?></p>
                                            <a href="<?php the_permalink();?>" class="button">Read more <span></span></a>
                                        </div>
                                    </div>
                                <?php endwhile;
                            endif;
                            // Reset Post Data
                            wp_reset_postdata();


                            ?>



                        </div>


                    </section>

                </section>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->
<?php
get_footer();