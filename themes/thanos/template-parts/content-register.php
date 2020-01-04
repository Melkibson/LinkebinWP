<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package thanos
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php thanos_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();
        ?>
        <div class="">
            <div class="login-dark mx-auto my-auto">
                <form method="post" style="  background:linear-gradient(70deg, #d6d9d4 30%, rgba(0,0,0,0) 30%), linear-gradient(30deg, rgb(199, 253, 202) 60%, #fff 60%);">
                    <h2 class="sr-only">Login Form</h2>
                    <div class="illustration"><i class="icon ion-ios-locked-outline" style="color: green;"></i></div>
                    <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email" style="font-family: Ubuntu, sans-serif;"></div>
                    <div class="form-group"><input class="form-control" type="password" placeholder="Mot de passe" name="password" style="font-family: Ubuntu, sans-serif;"></div>
                    <div class="form-group"><button class="btn btn-primary btn-block" type="submit" style="background-color: green;font-family: Ubuntu, sans-serif;">Se connecter</button>
                    </div><a class="forgot" href="#" style="font-family: Ubuntu, sans-serif;">Identifiant ou mot de passe oublié ?</a>
                </form>
            </div>
        </div>
		<?php wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'thanos' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'thanos' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
