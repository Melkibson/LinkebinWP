<?php
/*
 Template Name: Home
 */
if ( isset( $_POST['submitted'] ) ):

	$login_data                  = array();
	$login_data['user_login']    = sanitize_user( $_POST['login'] );
	$login_data['user_password'] = esc_attr( $_POST['password'] );


	$user_data = wp_signon( $login_data, false );

	if (is_wp_error($user_data)  ):
		echo '<script>alert("Utilisateur inconnu")</script>';
	else:
		wp_clear_auth_cookie();
		wp_set_current_user( $user_data->ID );
		wp_set_auth_cookie( $user_data->ID, true );
		wp_safe_redirect( home_url( '/' ) );
		exit;
	endif;
endif;
get_header();
?>
        <section id="map-section" class="">
            <div class="map-container">
                <div id='map'></div>
                <div class="map-cover"></div>
            </div>
        </section>
        
    </section>

    


    <script>

        

    </script>



<?php  get_footer()?>