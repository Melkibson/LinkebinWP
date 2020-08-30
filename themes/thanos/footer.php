<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package thanos
 */

?>
<footer id="contact" class="fixed-bottom shadow-sm">
    <div>
    <span class="footer-text">Copyright © LinkeBin 2019 | Tous Droits Réservés</span>
    </div>
</footer>
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.0.2/mapbox-gl-directions.js"></script>
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.4.2/mapbox-gl-geocoder.min.js"></script>
<script src="https://api.tiles.mapbox.com/mapbox-gl-js/v1.6.1/mapbox-gl.js"></script>
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
<script src="<?=get_template_directory_uri() . '/assets/js/mapbox.js'?>"></script>
<script src="<?=get_template_directory_uri() . '/assets/js/script.js'?>"></script>
</body>
</html>
