<?php get_header();
/*
 Template Name: Register
 */
?>
<form>
	<div class="form-group">
		<label for="user_">Email</label>
		<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
	</div>
	<div class="form-group">
		<label for="exampleInputPassword1">Mot de passe</label>
		<input type="password" class="form-control" id="exampleInputPassword1">
	</div>
	<div class="form-group">
		<label for="exampleInputPassword1">Confirmer le mot de passe</label>
		<input type="password" class="form-control" id="exampleInputPassword1">
	</div>
	<button type="submit" class="btn btn-primary">S'inscrire</button>
</form>

<?php get_footer();