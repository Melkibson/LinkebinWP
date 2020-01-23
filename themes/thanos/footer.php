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

<script>
    function openNav() {
        document.getElementById("myNav").style.width = "100%";
    }

    function closeNav() {
        document.getElementById("myNav").style.width = "0%";
    }

    document.getElementById("prout-nav").addEventListener("click", toggleNav);
    function toggleNav(){
        navSize = document.getElementById("sidebar-menu").style.width;
        if (navSize == '200px') {
            return close();
        } else
            return open();
    }

    function open() {
        document.getElementById("sidebar-menu").style.width = "200px";
        document.getElementById("mainContent").style.marginLeft = "250px";
    }
    function close() {
        document.getElementById("sidebar-menu").style.width = "55px";
        document.getElementById("mainContent").style.margin = "auto";
    }

</script>
</body>
</html>
