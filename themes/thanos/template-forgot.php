<?php
/*
	Template Name: Forgot
 */

if (isset($_POST['submitted'])):
	$login = $_POST['login'];
	$email = $_POST['email'];

//	wp_set_current_user($email);
	$stored_email = get_user_by('email', $email);

	if ($stored_email === $email):
		retrieve_password();
		echo '<script>alert("je te connais toua")</script>';


	else:
		echo '<script>alert("je te connais po")</script>';
	endif;
endif;

get_header();
?>

<form method="post" style="margin-top: 100px; height: 100px; background: #efefef;">
	<div class="form-group">
		<label for="login">Identifiant</label>
		<input type="text" class="form-control" id="login" name="login" placeholder="Michel">
	</div>
	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" class="form-control" id="email" name="email" placeholder="example@linkebin.com">
	</div>
	<button type="submit" class="btn btn-primary" name="submitted">Connexion</button>

</form>

<?php get_footer();
