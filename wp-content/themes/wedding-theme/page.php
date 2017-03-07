<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wedding-theme
 */

get_header(); ?>


			<?php
			while ( have_posts() ) : the_post(); ?>

                <!-- BEFORE CONTENT -->
                <div id="outerbeforecontent">
                    <div class="container">
                        <div class="row">
                            <div id="beforecontent" class="twelve columns">
                                <div id="pagetitle-container">
                                    <h1 class="pagetitle"><?php the_title() ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END BEFORE CONTENT -->


                <!-- MAIN CONTENT -->
                <div id="outermain">
                    <div class="container">
                        <div class="row">

                            <section id="maincontent" class="nine columns positionleft">

                                <section class="content">
                                   <?php the_content() ?>

                                </section>

                            </section>
                            <?php get_sidebar(); ?>
                        </div>
                    </div>
                </div>
                <!-- END MAIN CONTENT -->
                <?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
<?php

get_footer();
