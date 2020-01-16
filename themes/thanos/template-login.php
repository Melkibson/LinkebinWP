<?php get_header();
/*
 Template Name: Login
 */

?>

<form method="post" action="">
	<div class="form-group" style="margin-top: 100px; height: 100px; background: #efefef; ">
		<label for="login">Email</label>
		<input type="text" class="form-control" id="login" name="login" aria-describedby="emailHelp">
		<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.
        </small>
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
