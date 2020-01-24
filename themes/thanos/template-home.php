<?php
/*
 Template Name: Home
 */
get_header();?>
    <section class="container-fluid main-title bg-light">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 mx-auto pt-5 h-100">
                <h1 class="h1">La plateforme qui vous reconcilie avec le recyclage</h1>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-8">
                <img class="img-fluid" src="<?= get_template_directory_uri() . '/assets/img/recycle.svg'?>" alt="" width="100%" height="600px">
            </div>
            <div class="learn-more col-lg-3 col-md-6 col-sm-6 shadow rounded-lg text-center">
                <p>Déja des milliers d'inscrits<br>Rejoignez le mouvement !</p>
                <p class=""><a href="#map-section"><i class="fas fa-chevron-circle-down m-auto"></i></a></p>
            </div>
        </div>
    </section>
        <section id="map-section" class="map-container container-fluid h-100">
        <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="card-m-b-30 bg-light rounded-lg shadow-sm">
                        <div class="card-body"><div id='map'></div></div>
                    </div>
                </div>
        </div>
        </section>

        <script>
            mapboxgl.accessToken = 'pk.eyJ1IjoibGlua2ViaW4iLCJhIjoiY2szbzcxNGIzMDVwdTNibXV6MWV6MXgxeiJ9.SU_Tmcud24UTRnCFDIJJVw';

            var options = {
                enableHighAccuracy: true,
                timeout: 5000,
                maximumAge: 0
            };

            function success(pos) {
                setup(pos.coords.latitude, pos.coords.longitude);
            }


            function error(err) {
                console.warn(`ERREUR (${err.code}): ${err.message}`);
            }



            var coordonnes = navigator.geolocation.getCurrentPosition(success, error, options);

            //Initialisation de la map

            function setup(longitude, latitude) {
                var map = new mapboxgl.Map({
                    container: 'map',
                    style: 'mapbox://styles/mapbox/streets-v11',
                    center: [latitude, longitude],
                    zoom: 15
                });


                map.addControl(
                    new MapboxDirections({
                        accessToken: mapboxgl.accessToken,
                        unit: 'metric',
                        container: 'directions',
                        language: 'fr'
                    }),
                    'bottom-left'
                );


                //Fonction pour récupérer le geojson

                function httpGet(theUrl) {
                    var xmlHttp = new XMLHttpRequest();
                    xmlHttp.open("GET", theUrl, false); // false for synchronous request
                    xmlHttp.send(null);
                    return xmlHttp.responseText;
                }

                function damaged(idbin, iduser) {
                    var damaged = true;
                    var url = 'http://localhost:8000/AddReportHistoric/' + idbin + '/' + iduser + '/' + damaged;
                    window.location.assign(url);
                }

                //Intégration du geojson dans une variable
                var request = JSON.parse(httpGet("http://localhost:8000/bins/getAllBins"));

                var baseurl = 'http://localhost:8888/wordpress/';
                console.log(request);
                console.log(request);


                map.on('load', function () {

                    map.loadImage(baseurl + 'wp-content/themes/thanos/assets/img/poubelleverre.png', function (error, image) {
                        if (error) throw error;
                        map.addImage('poubelle', image);

// Add a new source from our GeoJSON data and set the
// 'cluster' option to true. GL-JS will add the point_count property to your source data.
                        map.addSource("BIN", {
                            type: "geojson",
                            data: request,
                            cluster: true,
                            clusterMaxZoom: 14, // Max zoom to cluster points on
                            clusterRadius: 50 // Radius of each cluster when clustering points (defaults to 50)
                        });


//GEOLOCALISATION

                        map.addControl(new mapboxgl.GeolocateControl({
                            positionOptions: {
                                enableHighAccuracy: true
                            },
                            trackUserLocation: true
                        }));


                        var geocoder = new MapboxGeocoder({
                            accessToken: mapboxgl.accessToken,
                            marker: {
                                color: 'orange',
                                radius: 1000
                            },
                            mapboxgl: mapboxgl,
                            limit: 10
                        });

                        map.addControl(geocoder, 'top-right');


                        map.addLayer({
                            id: "clusters",
                            type: "circle",
                            source: "BIN",
                            filter: ["has", "point_count"],
                            //layout:{"visibility": "none"},
                            paint: {
                                "circle-color": [
                                    "step",
                                    ["get", "point_count"],
                                    "#51bbd6",
                                    100,
                                    "#f1f075",
                                    750,
                                    "#f28cb1"
                                ],
                                "circle-radius": [
                                    "step",
                                    ["get", "point_count"],
                                    20,
                                    100,
                                    30,
                                    750,
                                    40
                                ]
                            }
                        });

                        map.addLayer({
                            id: "cluster-count",
                            type: "symbol",
                            source: "BIN",
                            filter: ["has", "point_count"],
                            layout: {
                                "visibility": "visible",
                                "text-field": "{point_count_abbreviated}",
                                "text-font": ["DIN Offc Pro Medium", "Arial Unicode MS Bold"],
                                "text-size": 12
                            }
                        });

                        map.addLayer({
                            id: "unclustered-point",
                            type: "symbol",
                            source: "BIN",
                            filter: ["!", ["has", "point_count"]],
                            layout: {
                                "icon-image": "poubelle",
                                "icon-size": 0.05
                            }
                        });
                    });

// inspect a cluster on click
                    map.on('click', 'clusters', function (e) {
                        var features = map.queryRenderedFeatures(e.point, {layers: ['clusters']});
                        var clusterId = features[0].properties.cluster_id;
                        map.getSource('BIN').getClusterExpansionZoom(clusterId, function (err, zoom) {
                            if (err)
                                return;

                            map.easeTo({
                                center: features[0].geometry.coordinates,
                                zoom: zoom
                            });
                        });
                    });

                    map.on('click', 'unclustered-point', function (e) {
                        var coordinates = e.features[0].geometry.coordinates.slice();
                        var commune = e.features[0].properties.commune;
                        var adresse = e.features[0].properties.adress;
                        var uid = e.features[0].properties.id;
                        var iduser = 25;
                        //var iduser = get_current_user_id();
                        console.log(uid);
                        console.log(adresse);
                        console.log(commune);
                        console.log(iduser);

                        new mapboxgl.Popup()
                            .setLngLat(coordinates)
                            .setHTML(adresse + '<p><strong>' + commune + '</strong></p><p><input type="button" value="Bonne etat"><input id="MyButton" type="button" value="Mauvais etat"><input type="button" value="Pleine">')
                            .addTo(map)

                        $(document).ready(function () {
                            $('#MyButton').click(function () {
                                damaged();
                            });
                        });
                    });

                    map.on('mouseenter', 'clusters', function () {
                        map.getCanvas().style.cursor = 'pointer';
                    });
                    map.on('mouseleave', 'clusters', function () {
                        map.getCanvas().style.cursor = '';
                    });

                });
                // var toggleableLayerIds = ['clusters', 'unclustered-point'];
                //
                // for (var i = 0; i < toggleableLayerIds.length; i++) {
                //     var id = toggleableLayerIds[i];
                //
                //     var link = document.createElement('a');
                //     link.href = '#';
                //     link.className = 'active';
                //     link.textContent = id;
                //
                //     link.onclick = function (e) {
                //         var clickedLayer = this.textContent;
                //         e.preventDefault();
                //         e.stopPropagation();
                //
                //         var visibility = map.getLayoutProperty(clickedLayer, 'visibility');
                //
                //         if (visibility === 'visible') {
                //             map.setLayoutProperty(clickedLayer, 'visibility', 'none');
                //             this.className = '';
                //         } else {
                //             this.className = 'active';
                //             map.setLayoutProperty(clickedLayer, 'visibility', 'visible');
                //         }
                //     };
                //
                //     var layers = document.getElementById('menu');
                //     layers.appendChild(link);
                // }
            }


            $("a").on('click',function() {
                $('html,body').animate({
                        scrollTop: $("#map-section").offset().top},
                    'slow');
            });


        </script>



<?php  get_footer()?>