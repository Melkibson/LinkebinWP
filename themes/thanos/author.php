<?php
$user_id = get_current_user_id();
$username = get_the_author_meta( 'user_login', $user_id);
$email = get_the_author_meta('user_email', $user_id);
$password = get_the_author_meta('user_pass', $user_id);
$firstname = get_the_author_meta('user_firstname', $user_id);
$lastname = get_the_author_meta('user_lastname', $user_id);
$address = get_the_author_meta('user_description', $user_id);
?>

<!doctype html>
<html <?php language_attributes(); ?> style="margin: 0 !important;" xmlns="http://www.w3.org/1999/html">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>
    <nav class="form-nav d-flex justify-content-between">
        <img class="h-100" src="<?= get_template_directory_uri() . '/assets/img/logo_linkebin.png'?>" width="150px" alt="">
        <a href="<?= home_url('/') ?>"><img src="<?= get_template_directory_uri() . '/assets/img/back.svg'?>" width="40px" alt=""></a>
    </nav>

    <body id="user-page" class="container-fluid h-100">
        <div class="row px-3">
            <div id="title" class="col-12">
                <h2 class="profile-title text-left">Bonjour <span class="text-capitalize"><?= $username; ?></span></h2>
            </div>
            <div class="col-7">
                <form method="post" class=" form-login shadow-lg p-0">
                    <div class="col-11 m-auto form-content">
                        <div class="row m-auto">
                            <div class="form-group col-6">
                                <label for="login">Identifiant</label>
                                <input type="text" class="form-control" id="login" name="login" value="<?= $username?>">
                            </div>
                            <div class="form-group col-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>">
                                <span><?php if (isset($errors['user_email'])) : echo $errors['user_email']; endif;?></span>
                            </div>
                        </div>
                        <div class="pt-3">
                        <div class="reset-pwd form-group d-flex justify-content-between">
                            <label for="password">Ancien mot de passe</label>
                            <input type="password" class="form-control" id="old-password" name="old-password" placeholder="•••••••••">
                        </div>
                        <div class="reset-pwd form-group d-flex justify-content-between">
                            <label for="password">Nouveau mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="•••••••••">
                        </div>
                        <div id="message">
                            <p>Le mot de passe doit contenir les elements suivant:</p>
                            <span id="letter" class="invalid">Une minuscule</span><br>
                            <span id="capital" class="invalid">Une majuscule</span><br>
                            <span id="number" class="invalid">Un chiffre</span><br>
                            <span id="length" class="invalid">8 caracteres</span>
                        </div>
                        <div class="reset-pwd form-group d-flex justify-content-between">
                            <label for="password2">Confirmer le mot de passe</label>
                            <input type="password" class="form-control" id="password2" name="password2" placeholder="•••••••••">
                            <div id="message-pwd">
                                <span id="match" class="invalid"></span>
                            </div>
                        </div>
                        <div class="form-group pt-3">
                            <input type="submit" class="shadow" id="submit" name="submitted" value="sauvegarder">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-5">
            <form method="post" class=" form-login shadow-lg p-0">
                <div class="col-11 m-auto form-content">
                    <div class="row m-auto">
                    <div class="form-group col-6">
                        <label for="lastname">Nom</label>
                        <input type="text" class="form-control" id="lastname" name="lastname"
                        <?php if (isset($lastname)):?> value="<?= $lastname; endif;?>">
                    </div>
                    <div class="form-group col-6">
                        <label for="firstname">Prenom</label>
                        <input type="text" class="form-control" id="firstname" name="firstname"
	                        <?php if (isset($firstname)):?> value="<?= $firstname; endif;?>">
                    </div>
                    <div class="form-group col-12">
                        <label for="address">Adresse</label>
                        <input type="text" class="form-control" id="address" name="address"
	                        <?php if (isset($address)):?> value="<?= $address; endif;?>">
                    </div>
                        <div class="form-group pt-3">
                            <input type="submit" class="shadow" id="submit" name="submitted" value="sauvegarder">
                        </div>
                    </div>
                </div>
            </form>
        </div>
<?php
get_footer();
