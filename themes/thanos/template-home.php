<?php
/*
 Template Name: Home
 */
get_header();?>


<main id="mainContent" class="p-0">
    <div class="row">
        <aside id="sidebar-menu" class="shadow-sm">
            <ul>
                <li><a href="">Item</a></li>
            </ul>
        </aside>
    </div>
        <div class="container main-title">
            <div class="row">
                <div class="col-lg-9 m-auto">
                    <h1>La plateforme qui vous réconcilie avec le recyclage</h1>
                </div>
            </div>
        </div>
    <div id="map" class="container pull-up">
        <div class="row">
            <div class="col-lg-9 m-auto">
                <div class="card-m-b-30 bg-light rounded-lg shadow-sm">
                    <div class="card-header border-0">
                        <div class="card-title">Localisation des bennes</div>
                    </div>
                    <div class="card-body">
                        <iframe class="bg-primary rounded-lg" allowfullscreen="" frameborder="0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDAopkC8WFvI3UD0z-nyQmdVoZ81QVGJlk&amp;q=Rouen%2C+France&amp;zoom=15" width="100%" height="450"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php  get_footer()?>