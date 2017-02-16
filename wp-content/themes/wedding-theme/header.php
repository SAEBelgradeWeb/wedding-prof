<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wedding-theme
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<link rel="profile" href="http://gmpg.org/xfn/11">

<title><?php bloginfo('name'); ?></title>

<link rel="shortcut icon" href="<?= get_template_directory_uri();?>/images/favicon.ico" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="bodychild">
	
	<div id="outercontainer">
    	
        <!-- HEADER -->
        <div id="outerheader">
        	<div class="shadow-l"></div>
            <div class="shadow-r"></div>
        	<div class="container">
            
            <header id="top">
            	<div class="row">
                    <div id="logo" class="twelve columns">
                    	<span class="desc"><?php bloginfo('description'); ?></span>
                        <a href="/"><img src="<?= get_template_directory_uri(); ?>/images/logo.png" alt="" /></a>
                    </div>
                </div>
                <div class="row">
                    <section id="navigation" class="twelve columns">
                        <nav id="nav-wrap">
                            <ul id="topnav" class="sf-menu">
                                <li class="current"><a href="index.html">Home</a></li>
                                <li><a href="wedding.html">Our Wedding</a>
                                    <ul>
                                        <li><a href="#">Only</a></li>
                                        <li><a href="#">Example of</a></li>
                                        <li><a href="#">The Dropdown</a></li>
                                    </ul>
                                </li>
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="gallery.html">Gallery</a></li>
                                <li><a href="rsvp.html">RSVP</a></li>
                                <li><a href="guestbook.html">GuestBook</a></li>
                                <li><a href="contact.html">Contact</a></li>
                            </ul><!-- topnav -->
                            <div class="clear"></div>
                        </nav><!-- nav -->	
                    </section>
                </div>
                <div class="clear"></div>
            </header>
            
            </div>
        </div>
        <!-- END HEADER -->