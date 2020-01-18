<?php
/*
 Template Name: Login
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> style="margin: 0 !important;" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>
<body id="reset-page" class="h-100">
    <img src="<?= get_template_directory_uri() . '/assets/img/logo_linkebin.png'?>" width="150px" alt="">
    <section class="col-xl-5 col-md-8 col-sm-10 m-auto py-0">
        <div class="form-group form-title">
            <h2 class="text-left">Se connecter</h2>
        </div>
        <form method="post" class="form-login shadow-lg p-0">
            <div class="col-10 m-auto form-content">
                <div class="form-group">
                    <label for="login">Identifiant</label>
                    <input type="text" class="form-control" id="login" name="login" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="stay-connected">
                    <label class="form-check-label" for="stay-connected">Rester connecté</label>
                </div>
                <div class="form-group pt-3">
                    <input type="submit" class="shadow" id="submit" name="submitted" value="envoyer">
                </div>
            </div>
        </form>
    </section>
<?php  get_footer()?>
