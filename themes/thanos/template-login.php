<?php get_header();
/*
 Template Name: Login
 */
if ( isset( $_POST['submitted'] ) ):
	$login_data                  = array();
	$login_data['user_login']    = sanitize_user( $_POST['login'] );
	$login_data['user_password'] = esc_attr( $_POST['password'] );

	$user_data = wp_signon( $login_data, false );


	if ( is_user_logged_in() ):
		wp_clear_auth_cookie();
		wp_set_current_user( $user_data->ID );
		wp_set_auth_cookie( $user_data->ID, true );
		wp_safe_redirect( home_url( '/' ) );
		exit;
	else:
        echo '<script>alert("T\'es pas co")</script>';
	endif;
endif;

?>

<form method="post" action="">
	<div class="form-group" style="margin-top: 100px; height: 100px; background: #efefef; ">
		<label for="login">Email</label>
		<input type="text" class="form-control" id="login" name="login" aria-describedby="emailHelp">
		<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
	</div>
	<div class="form-group">
		<label for="password">Mot de passe</label>
		<input type="password" class="form-control" id="password" name="password">
	</div>
	<div class="form-group form-check">
		<input type="checkbox" class="form-check-input" id="exampleCheck1">
		<label class="form-check-label" for="exampleCheck1">Rester connecté</label>
	</div>
	<button type="submit" class="btn btn-primary" name="submitted">Connexion</button>
</form>
<?php  get_footer()?>
