<?php
$user_id = get_current_user_id();
$username = get_the_author_meta( 'user_login', $user_id);
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
        <a href="<?= home_url('/') ?>">Retour</a>
    </nav>

    <body id="user-page" class="container-fluid">
    <?php

//        $url = 'http://localhost:8000/AddUser/' . $user_id;
//        $response = wp_remote_get($url);
//        $body = wp_remote_retrieve_body($response);
//        var_dump($body);
        ?>
        <div class="row h-100">
            <div class="col-12">
                <h2 class="profile-title text-left">Bonjour <span class="text-capitalize"><?php echo $username; ?></span></h2>
            </div>
            <div class="col-7">
                <form method="post" class=" form-login shadow-lg p-0">
                    <div class="col-10 m-auto form-content">
                        <div class="row m-auto">
                            <div class="form-group col-6">
                                <label for="login">Identifiant</label>
                                <input type="text" class="form-control" id="login" name="login">
                            </div>
                            <div class="form-group col-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                                <span><?php if (isset($errors['user_email'])) : echo $errors['user_email']; endif;?></span>
                            </div>
                        </div>
                        <div>
                        <div class="form-group d-flex">
                            <label for="password">Ancien mot de passe</label>
                            <input type="password" class="form-control" id="old-password" name="old-password" placeholder="•••••••••">
                        </div>
                        <div class="form-group">
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
                        <div class="form-group">
                            <label for="password2">Confirmer le mot de passe</label>
                            <input type="password" class="form-control" id="password2" name="password2" placeholder="•••••••••">
                            <div id="message-pwd">
                                <span id="match" class="invalid"></span>
                            </div>
                        </div>
                        <div class="form-group pt-3">
                            <input type="submit" class="shadow" id="submit" name="submitted" value="envoyer">
                        </div>
                    </div>
                </form>
            </div>
                <div class="col-5">
                    <form method="post" class=" form-login shadow-lg p-0">
                        <div class="col-10 m-auto form-content">
                            <div class="form-group">
                                <label for="lastname">Nom</label>
                                <input type="text" class="form-control" id="lastname" name="lastname">
                                <label for="firstname">Prenom</label>
                                <input type="text" class="form-control" id="firstname" name="firstname">
                            </div>
                            <div class="form-group">
                                <label for="address">Adresse</label>
                                <input type="text" class="form-control" id="address" name="address">
                            </div>
                        </div>
                    </form>
                </div>
        </div>

<?php
get_footer();
