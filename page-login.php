<?php 
/*
 * Template Name: Login Page
 */?>
<?php get_header();?>
<?php while (have_posts()):the_post();?>
 <div class="content_main login">
 <div class="theme_gallery about_us">
 <div class="theme_gallery_title">
 <h1><?php the_title();?></h1>
 </div>
 <div class="category_description"><?php the_content(); ?> </div>
 <div class="login-form">
 </div>
 </div>
 </div>
 <?php $args = array( 
 'redirect' => home_url(), 
 'id_username' => 'user', 
 'id_password' => 'pass', 
 ) 
 ;?> 
 <?php wp_login_form( $args ); ?> ?>
 <!-- End gallery -->
<?php endwhile;?>
<?php get_footer();?>