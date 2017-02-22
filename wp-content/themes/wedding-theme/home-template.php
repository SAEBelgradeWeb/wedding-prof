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


                                $the_query = new WP_Query( $args );
                                // The Loop
                                if ( $the_query->have_posts() ) :
                                    while ( $the_query->have_posts() ) : $the_query->the_post();
                                        ?>
                                        <li>
                                            <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('slider'); ?></a>
                                            <div class="flex-caption">
                                                <h1><?php the_title(); ?></h1>
                                                <p>
                                                <?php
                                                $content = get_the_excerpt();
                                                $no_char = strlen($content);
                                                $content = substr($content, 0, 100);
                                                echo $content;
                                                if ($no_char > 100) echo  "...";
                                                ?>
                                                </p>
                                            </div>
                                        </li>
                                <?php endwhile;
                                endif;
                                // Reset Post Data
                                wp_reset_postdata();



                                ?>


                            </ul>
                            <img src="<?= get_template_directory_uri()?>/images/slider-shadow.png" alt="" />
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>
    <!-- END SLIDER -->
<?php
get_footer();