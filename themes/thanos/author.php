<!doctype html>
<html <?php language_attributes(); ?> style="margin: 0 !important;" xmlns="http://www.w3.org/1999/html">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>
<body id="user-page" class="h-100">
<div class="form-nav d-inline-block">
    <img src="<?= get_template_directory_uri() . '/assets/img/logo_linkebin.png'?>" width="150px" alt="">
    <a href="<?= home_url('/') ?>">Retour</a>
</div>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php

			if ( have_posts() ) : ?>

				<header class="page-header">
					<?php
                    $user_id = get_current_user_id();
					var_dump(get_the_author_meta( 'user_login', $user_id));
					the_archive_description( '<div class="archive-description">', '</div>' );
					?>
				</header><!-- .page-header -->

				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

				endwhile;

				the_posts_navigation();

			endif;
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
