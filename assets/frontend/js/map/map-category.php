<script type="text/javascript">
'use strict';

var latlngcu;
navigator.geolocation.getCurrentPosition(function(location) {
    latlngcu = location.coords.latitude+','+location.coords.longitude;
});
//console.log(latlngcu);

function createListingsMap2(options) {
    var defaults = {
        markerspayimg: '<?php echo base_url('assets/frontend/images/sp.jpg') ?>',
        markernospayimg: '<?php echo base_url('assets/frontend/images/npsp.jpg') ?>',
        markerPath: '<?php echo base_url('assets/frontend/images/spry.png') ?>',
        markerNonPath: '<?php echo base_url('assets/frontend/images/nonspry.PNG') ?>',
        markerShadow: '<?php echo base_url('assets/frontend/images/location-pin.svg') ?>',
        imgBasePath: '<?php echo base_url('uploads/listing_images/') ?>',
        mapPopupType: 'venue',
        useTextIcon: false
    }
    var settings = $.extend({}, defaults, options);
    var dragging = false,
        tap = false;
    if ($(window).width() > 700) {
        dragging = true;
        tap = true;
    }
    /*
    ====================================================
      Create and center the base map
    ====================================================
    */
    var map = L.map(settings.mapId, {
        zoom: 17,
        scrollWheelZoom: false,
        dragging: dragging,
        tap: tap,
        Control: true,
        scrollWheelZoom: false
    });
    map.once('focus', function () {
        map.scrollWheelZoom.enable();
    });
     L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
        minZoom: 1,
        maxZoom: 21,
        subdomains:['mt0','mt1','mt2','mt3']
    }).addTo(map);
    

    // L.tileLayer('https://maps.wikimedia.org/osm-intl/{z}/{x}/{y}{r}.png', {
    //     attribution: '',
    //     minZoom: 1,
    //     maxZoom: 13 // It controls the maximum zoom level of the map
    // }).addTo(map);

    /*
    ====================================================
      Load GeoJSON file with the data
      about the listings
    ====================================================
    */
    $.getJSON(settings.jsonFile).done(function (json) {
            L.geoJSON(json, {
                pointToLayer: pointToLayer,
                onEachFeature: onEachFeature
            }).addTo(map);

            if (markersGroup) {
                var featureGroup = new L.featureGroup(markersGroup);
                map.fitBounds(featureGroup.getBounds());
            }
            // L.map('map', {
            //     center: [settings.long,settings.lat],
            //     zoom: 13
            // });
            setTimeout(function(){
                map.setView(new L.LatLng(settings.long,settings.lat),18); 
                //console.log(settings.mapcode);
                var marker = map.getMarkerById(settings.mapcode);
                marker.openPopup();
            }, 300);
            
         
            
        })
        .fail(function (jqxhr, textStatus, error) {
            console.log(error);
        });

    /*
    ====================================================
      Bind popup and highlighting features
      to each marker
    ====================================================
    */

    var markersGroup = []

    var defaultIcon = L.icon({
        iconUrl: settings.markerPath,
        // shadowUrl: settings.markerShadow,
        iconSize: [38, 37.5], // default size was 25, 37.5
        popupAnchor: [525, 190],
        tooltipAnchor: [0, 0],
        // shadowSize: [25, 37.5],
        // shadowAnchor: [-3, 30]
    });
    var nonsprayIcon = L.icon({
        iconUrl: settings.markerNonPath,
        // shadowUrl: settings.markerShadow,
        iconSize: [38, 37.5], // default size was 25, 37.5
        popupAnchor: [525, 190],
        tooltipAnchor: [0, 0],
        // shadowSize: [25, 37.5],
        // shadowAnchor: [-3, 30]
    });

    var highlightIcon = L.icon({
        iconUrl: settings.markerPath,
        iconSize: [38, 37.5],
        popupAnchor: [525, 190],
        tooltipAnchor: [0,0]
    });


    function onEachFeature(feature, layer) {
        
        layer.on({
            //mouseover: highlightMarker,
            //mouseout: resetMarker,
            click : scrollToListing
        });
        //console.log(feature.properties.id);

        if (feature.properties && feature.properties.about) {
            //This is the code for represent the popover

            layer.bindPopup(getPopupContent(feature.properties), {
                minwidth: 200,
                maxWidth: 600,
                className: 'map-custom-popup'
            });
             
            if (settings.useTextIcon) {
                layer.bindTooltip('<div id="customTooltip-' + feature.properties.id + '">$' + feature.properties.price + '</div>', {
                    direction: 'top',
                    permanent: true,
                    opacity: 1,
                    interactive: true,
                    className: 'map-custom-tooltip'
                });
            }
        }
        markersGroup.push(layer);
    }

    // var markerId = $(this).attr('button-direction-id');
    //     var marker = map.getMarkerById(markerId);
    //     if (marker) {
    //         marker.openPopup(); // this line of code opens up the pop on map
    //         highlight(marker);
    //         if (previousHighLightedMarkerId != markerId) {
    //             var marker = map.getMarkerById(previousHighLightedMarkerId);
    //             if (marker) {
    //                 reset(marker);
    //             }
    //         }
    //         previousHighLightedMarkerId = markerId;
    //     }
    function pointToLayer(feature, latlng) {
         
        if(feature.is_spray == 1){
            var iconmap = defaultIcon;
        }else{
            var iconmap = nonsprayIcon;
        }
        if (settings.useTextIcon) {
            var markerOpacity = 0
        } else {
            var markerOpacity = 1
        }

        return L.marker(latlng, {
            icon: iconmap,
            id: feature.properties.id,
            opacity: markerOpacity,
            title: feature.properties.name
        });
    }

    function highlightMarker(e) {
        highlight(e.target);
    };

    function resetMarker(e) {
        reset(e.target);
    };

    // this function triggers after clicking on a marker
    function scrollToListing(e) {
        var listing_code = e.target.defaultOptions.id;
        var toFocusId = '#listing-banner-image-for-'+listing_code; // this is the id of the link where hovering gives an animation

        if($("#"+listing_code).length > 0) { // this if condition checks if "#"+listing_code this id exists in the view. We've done this to avoid a console error in single listing page
            // to focust the listing
            $('html, body').animate({ scrollTop: $('#'+listing_code).offset().top - 110 }, 'slow', function() {
              // adding a class where listing banner will be scaled up a little bit
              $(toFocusId).addClass('focus-a-listing');
              // Removing the class after seconds
              setTimeout(function(){
                  $(toFocusId).removeClass('focus-a-listing');
              }, 300);
            });
        }
    }

    function highlight(marker) {
        marker.setIcon(highlightIcon);
        if (settings.useTextIcon) {
            findTooltip(marker).addClass('active');
        }
    }

    function reset(marker) {
        marker.setIcon(defaultIcon);
        if (settings.useTextIcon) {
            findTooltip(marker).removeClass('active');
        }
    }

    function findTooltip(marker) {
        var tooltip = marker.getTooltip()
        var id = $(tooltip._content).filter("div").attr("id")
        return $('#' + id).parents('.leaflet-tooltip')
    }

    /*
    ====================================================
      Construct popup content based on the JSON data
      for each marker
    ====================================================
    */

    function getPopupContent(properties) {

        if (properties.name) {
            var title = '<h6><a href="' + properties.link + '">' + properties.name + '</a></h6>'
        } else {
            title = ''
        }

        if (properties.about) {
            var about = '<p class="">' + properties.about + '</p>'
        } else {
            about = ''
        }

        if (properties.image) {

            var imageClass = 'image';
            if (settings.mapPopupType == 'venue') {
                imageClass += ' d-none d-md-block'
            }
            if(properties.is_spray == 1){
                var spryimg = settings.markerspayimg;
            }else{
                var spryimg = settings.markernospayimg;
            }
            var image = '<div class="' + imageClass + '"style="height: 150px; background-image: url(\''   + spryimg + '\'); background-size: cover; background-position: center;"></div>';
           
        } else {
            image = '<div class="image"></div>'
        }
        if (properties.image) {
 
             var image1 = '<div class="' + imageClass + '"style="height: 220px; background-image: url(\''  + settings.imgBasePath + 'thumb-'+properties.image + '\'); background-size: cover; background-position: center;"></div>';
            //var image1 = '<img width="280" src="'  +  settings.imgBasePath + 'thumb-'+properties.image + '"> ';
             
        } else{
            image1 = ''
        }
        if (properties.address) {
            var address = '<p class="text-muted"><i class="fas fa-map-marker-alt fa-fw text-dark mr-2"></i>' + properties.address + '</p>'
        } else {
            address = ''
        }
        if (properties.email) {
            var email = '<p class="text-muted"><i class="fas fa-envelope-open fa-fw text-dark mr-2"></i><a href="mailto:' + properties.email + '" class="text-muted">' + properties.email + '</a></p>'
        } else {
            email = ''
        }
        if (properties.phone) {
            var phone = '<p class="text-muted"><i class="fa fa-phone fa-fw text-dark mr-2"></i>' + properties.phone + '</p>'
        } else {
            phone = ''
        }

        if (properties.stars) {
            var stars = '<div class="text-xs">Cleanliness'
            for (var step = 1; step <= 5; step++) {
                if (step <= properties.stars) {
                    stars += "<i class='fas fa-star text-warning'></i>"
                } else {
                    stars += "<i class='fas fa-star' style = 'color: #BDBDBD'></i>"
                }
            }
            stars += "</div>"
        } else {
            stars = ''
        }
        if (properties.stars2 && properties.is_spray == 1) {
         var stars2 = '<div class="text-xs">Spray Pressure  '
            for (var step2 = 1; step2 <= 5; step2++) {
                if (step2 <= properties.stars2) {
                    stars2 += "<i class='fas fa-star text-warning'></i>"
                } else {
                    stars2 += "<i class='fas fa-star' style = 'color: #BDBDBD'></i>"
                }
            }
            stars2 += "</div>"
        } else {
            stars2 = ''
        }
        // if (properties.stars3) {
        //     var stars3 = '<div class="text-xs">Privacy '
        //     for (var step3 = 1; step3 <= 5; step3++) {
        //         if (step3 <= properties.stars3) {
        //             stars3 += "<i class='fas fa-star text-warning'></i>"
        //         } else {
        //             stars3 += "<i class='fas fa-star' style = 'color: #BDBDBD'></i>"
        //         }
        //     }
        //     stars3 += "</div>"
        // } else {
        //     stars3 = ''
        // }

        if (properties.url) {
            var url = '<a href="' + properties.url + '">' + properties.url + '</a><br>'

        } else {
            url = ''
        }
        // if (properties.handicap == '1') {
        //     var handicap = "<p>Handicap Accessible &#10004;</p>";
        // }else{
        //     var handicap =  "";
        // }
        if(properties.is_spray == 1){
            var spryimg = settings.markerspayimg;
        }else{
            var spryimg = settings.markernospayimg;
        }
        
        // navigator.geolocation.getCurrentPosition(function(location) {
        //     var latlngcu = new L.LatLng(location.coords.latitude, location.coords.longitude);
        // });

        var direc = '<a target="_blank" href="https://www.google.com/maps/dir/?api=1&origin='+properties.name+'&destination='+latlngcu+'" class="btn btn-info" style="width: 100%; margin-bottom: 9px; color:white;"><i class="fas fa-arrow-right fa-fw text-light mr-2"></i>Directions</a>';

        var popupContent = '';

        if (settings.mapPopupType == 'venue') {
            popupContent =

            '<div class="popup-venue card" style="height:440px;">' +
                '<div style = "overflow: hidden; padding: 20px 20px 71px; background-image: url(\''  + spryimg + '\'); background-size: cover; background-position: center;" class="map-direction-image">' + '</div>'+
                image1 +
                '<div class="card-body">'+
                    '<div class="">' +title +' </div>' +
                    '<div>'+ direc +'</div>'+
                    '<div>'+ stars +'</div>'+
                    '<div>'+ stars2 +'</div>'+
                    '<div>'+ address +'</div>'+
                    '<div>'+ phone +'</div>'+
                '</div>' +
            '</div>';

            
            //OLD CODE OF MAPH LISTING POPUP VIEW
            
            // '<div class="popup-venue card">' +
            //     '<div style = "overflow: hidden;">' +'<img src="'  +'thumb-'+properties.image + '" class="card-img-top">'+ '</div>'+
            //     '<div class="card-body">'+
            //         '<div class="">' +title +' </div>' +
            //         '<div>'+ address +'</div>'+
            //         '<div>'+ phone +'</div>'+
            //     '</div>' +
            // '</div>';

        } else if (settings.mapPopupType == 'rental') {
            popupContent =
                '<div class="popup-rental">' +
                image +
                '<div class="text">' +
                title +
                stars +
                '</div>' +
                '</div>';
        }


        return popupContent;
    }
    /*
    ====================================================
      Highlight marker when users hovers above
      corresponding .card in the listing
    ====================================================
    */

    L.Map.include({
        getMarkerById: function (id) {
            var marker = null;
            this.eachLayer(function (layer) {
                if (layer instanceof L.Marker) {
                    if (layer.options.id === id) {
                        marker = layer;
                    }
                }
            });
            return marker;
        }
    });


    // This function hightlights the marker on hovering over a certain listing

    /*
    $('[data-marker-id!=""][data-marker-id]').on('mouseenter', function () {
        var markerId = $(this).data('marker-id');
        var marker = map.getMarkerById(markerId);
        if (marker) {
            highlight(marker);
        }
    });
    */


    // This function remove the highlightness from map marker after mouseleaving event

    /*$('[data-marker-id!=""][data-marker-id]').on('mouseleave', function () {
        var markerId = $(this).data('marker-id');
        var marker = map.getMarkerById(markerId);
        if (marker) {
            reset(marker);
        }
    });*/

    // This function highlights the map marker for a certain listing after clicking on the get direction button
    var previousHighLightedMarkerId;
    $('[button-direction-id!=""][button-direction-id]').on('click', function () {
        var markerId = $(this).attr('button-direction-id');
        var marker = map.getMarkerById(markerId);
        if (marker) {
            marker.openPopup(); // this line of code opens up the pop on map
            highlight(marker);
            if (previousHighLightedMarkerId != markerId) {
                var marker = map.getMarkerById(previousHighLightedMarkerId);
                if (marker) {
                    reset(marker);
                }
            }
            previousHighLightedMarkerId = markerId;
        }
    });
    
$('.leaflet-control-attribution').hide();
 //map.setView(new L.LatLng(51.505, -0.09) );
}



function createListingsMap(options) {
    var defaults = {
        markerspayimg: '<?php echo base_url('assets/frontend/images/sp.jpg') ?>',
        markernospayimg: '<?php echo base_url('assets/frontend/images/npsp.jpg') ?>',
        markerPath: '<?php echo base_url('assets/frontend/images/spry.png') ?>',
        markerNonPath: '<?php echo base_url('assets/frontend/images/nonspry.PNG') ?>',
         markerShadow: '<?php echo base_url('assets/frontend/images/location-pin.svg') ?>',
        imgBasePath: '<?php echo base_url('uploads/listing_images/') ?>',
        mapPopupType: 'venue',
        useTextIcon: false
    }

    var settings = $.extend({}, defaults, options);

    var dragging = false,
        tap = false;

    if ($(window).width() > 700) {
        dragging = true;
        tap = true;
    }

    /*
    ====================================================
      Create and center the base map
    ====================================================
    */
    

    var map = L.map(settings.mapId, {
        zoom: 14,
        scrollWheelZoom: false,
        dragging: dragging,
        tap: tap,
        Control: true,
        scrollWheelZoom: false
    });

    setTimeout(function(){
      map.locate({setView: true, maxZoom: 18});
    }, 1000);

    map.once('focus', function () {
        map.scrollWheelZoom.enable();
    });
     L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
        minZoom: 0,
        maxZoom: 18,
        subdomains:['mt0','mt1','mt2','mt3']
    }).addTo(map);
    // L.tileLayer('https://maps.wikimedia.org/osm-intl/{z}/{x}/{y}{r}.png', {
    //     attribution: '',
    //     minZoom: 1,
    //     maxZoom: 13 // It controls the maximum zoom level of the map
    // }).addTo(map);
    
    /*
    ====================================================
      Load GeoJSON file with the data
      about the listings
    ====================================================
    */

    

    $.getJSON(settings.jsonFile).done(function (json) {
            L.geoJSON(json, {
                pointToLayer: pointToLayer,
                onEachFeature: onEachFeature
            }).addTo(map);

            if (markersGroup) {
                var featureGroup = new L.featureGroup(markersGroup);
                map.fitBounds(featureGroup.getBounds());
            }

        })
        .fail(function (jqxhr, textStatus, error) {
            console.log(error);
        });

    /*
    ====================================================
      Bind popup and highlighting features
      to each marker
    ====================================================
    */

    var markersGroup = []

    var defaultIcon = L.icon({
        iconUrl: settings.markerPath,
        // shadowUrl: settings.markerShadow,
        iconSize: [38, 37.5], // default size was 25, 37.5
        popupAnchor: [525, 190],
        tooltipAnchor: [0, 0],
        // shadowSize: [25, 37.5],
        // shadowAnchor: [-3, 30]
    });
    var nonsprayIcon = L.icon({
        iconUrl: settings.markerNonPath,
        // shadowUrl: settings.markerShadow,
        iconSize: [38, 37.5], // default size was 25, 37.5
        popupAnchor: [525, 190],
        tooltipAnchor: [0, 0],
        // shadowSize: [25, 37.5],
        // shadowAnchor: [-3, 30]
    });

    var highlightIcon = L.icon({
        iconUrl: settings.markerPath,
        iconSize: [38, 37.5],
        popupAnchor: [525, 190],
        tooltipAnchor: [0,0]
    });


    function onEachFeature(feature, layer) {
        
       
           
        
        layer.on({
            //mouseover: highlightMarker,
            //mouseout: resetMarker,
            click : scrollToListing
        });

        if (feature.properties && feature.properties.about) {
            //This is the code for represent the popover

            layer.bindPopup(getPopupContent(feature.properties), {
                minwidth: 200,
                maxWidth: 600,
                className: 'map-custom-popup'
            });
             
            if (settings.useTextIcon) {
                layer.bindTooltip('<div id="customTooltip-' + feature.properties.id + '">$' + feature.properties.price + '</div>', {
                    direction: 'top',
                    permanent: true,
                    opacity: 1,
                    interactive: true,
                    className: 'map-custom-tooltip'
                });
            }
        }
        markersGroup.push(layer);
    }


    function pointToLayer(feature, latlng) {
         
        if(feature.is_spray == 1){
            var iconmap = defaultIcon;
        }else{
            var iconmap = nonsprayIcon;
        }
        if (settings.useTextIcon) {
            var markerOpacity = 0
        } else {
            var markerOpacity = 1
        }
    //     L.marker(latlng)
    // .openPopup('A sweet static label!', { noHide: true })
    // .addTo(map);
   
        return L.marker(latlng, {
            icon: iconmap,
            id: feature.properties.id,
            opacity: markerOpacity,
            title: feature.properties.name
        });
    }

    function highlightMarker(e) {
        highlight(e.target);
    };

    function resetMarker(e) {
        reset(e.target);
    };

    // this function triggers after clicking on a marker
    function scrollToListing(e) {
        var listing_code = e.target.defaultOptions.id;
        var toFocusId = '#listing-banner-image-for-'+listing_code; 
        // this is the id of the link where hovering gives an animation

        if($("#"+listing_code).length > 0) { // this if condition checks if "#"+listing_code this id exists in the view. We've done this to avoid a console error in single listing page
            // to focust the listing
            $('html, body').animate({ scrollTop: $('#'+listing_code).offset().top - 110 }, 'slow', function() {
              // adding a class where listing banner will be scaled up a little bit
              $(toFocusId).addClass('focus-a-listing');
              // Removing the class after seconds
              setTimeout(function(){
                  $(toFocusId).removeClass('focus-a-listing');
              }, 300);
            });
        }
    }

    function highlight(marker) {
        marker.setIcon(highlightIcon);
        if (settings.useTextIcon) {
            findTooltip(marker).addClass('active');
        }
    }

    function reset(marker) {
        marker.setIcon(defaultIcon);
        if (settings.useTextIcon) {
            findTooltip(marker).removeClass('active');
        }
    }

    function findTooltip(marker) {
        var tooltip = marker.getTooltip()
        var id = $(tooltip._content).filter("div").attr("id")
        return $('#' + id).parents('.leaflet-tooltip')
    }

    /*
    ====================================================
      Construct popup content based on the JSON data
      for each marker
    ====================================================
    */

    function getPopupContent(properties) {


        if (properties.name) {
            var title = '<h6><a href="' + properties.link + '">' + properties.name + '</a></h6>'
        } else {
            title = ''
        }

        if (properties.about) {
            var about = '<p class="">' + properties.about + '</p>'
        } else {
            about = ''
        }

        if (properties.image) {

            var imageClass = 'image';
            if (settings.mapPopupType == 'venue') {
                imageClass += ' d-none d-md-block'
            }
            
            if(properties.is_spray == 1){
                var spryimg = settings.markerspayimg;
            }else{
                var spryimg = settings.markernospayimg;
            }
            var image = '<div class="' + imageClass + '"style="height: 150px; background-image: url(\''  + spryimg + '\'); background-size: cover; background-position: center;"></div>';
             //console.log(settings);
        } else {
            image = '<div class="image"></div>'
        }
        if (properties.image) {
            var image1 = '<div class="' + imageClass + '"style="height: 220px; background-image: url(\''  + settings.imgBasePath + 'thumb-'+properties.image + '\'); background-size: cover; background-position: center;"></div>';

           // var image1 = '<img width="280" src="'  +  settings.imgBasePath + 'thumb-'+properties.image + '"> ';
             
        } else{
            image1 = ''
        }

        if (properties.address) {
            var address = '<p class="text-muted"><i class="fas fa-map-marker-alt fa-fw text-dark mr-2"></i>' + properties.address + '</p>'
        } else {
            address = ''
        }
        if (properties.email) {
            var email = '<p class="text-muted"><i class="fas fa-envelope-open fa-fw text-dark mr-2"></i><a href="mailto:' + properties.email + '" class="text-muted">' + properties.email + '</a></p>'
        } else {
            email = ''
        }
        if (properties.phone) {
            var phone = '<p class="text-muted"><i class="fa fa-phone fa-fw text-dark mr-2"></i>' + properties.phone + '</p>'
        } else {
            phone = ''
        }

        if (properties.stars) {
            var stars = '<div class="text-xs">Cleanliness '
            for (var step = 1; step <= 5; step++) {
                if (step <= properties.stars) {
                    stars += "<i class='fas fa-star text-warning'></i>"
                } else {
                    stars += "<i class='fas fa-star' style = 'color: #BDBDBD'></i>"
                }
            }
            stars += "</div>"
        } else {
            stars = ''
        }
        if (properties.stars2 && properties.is_spray == 1) {
            var stars2 = '<div class="text-xs">Spray Pressure  '
            for (var step2 = 1; step2 <= 5; step2++) {
                if (step2 <= properties.stars2) {
                    stars2 += "<i class='fas fa-star text-warning'></i>"
                } else {
                    stars2 += "<i class='fas fa-star' style = 'color: #BDBDBD'></i>"
                }
            }
            stars2 += "</div>"
        } else {
            stars2 = ''
        }
        // if (properties.stars3) {
        //     var stars3 = '<div class="text-xs">Privacy '
        //     for (var step3 = 1; step3 <= 5; step3++) {
        //         if (step3 <= properties.stars3) {
        //             stars3 += "<i class='fas fa-star text-warning'></i>"
        //         } else {
        //             stars3 += "<i class='fas fa-star' style = 'color: #BDBDBD'></i>"
        //         }
        //     }
        //     stars3 += "</div>"
        // } else {
        //     stars3 = ''
        // }

        if (properties.url) {
            var url = '<a href="' + properties.url + '">' + properties.url + '</a><br>'

        } else {
            url = ''
        }
        // if (properties.handicap == '1') {
        //     var handicap = "<p>Handicap Accessible &#10004;</p>";
        // }else{
        //     var handicap =  "";
        // }
        
        if(properties.is_spray == 1){
            var spryimg = settings.markerspayimg;
        }else{
            var spryimg = settings.markernospayimg;
        }
        
       

        
        var direc = '<a target="_blank" href="https://www.google.com/maps/dir/?api=1&origin='+properties.name+'&destination='+latlngcu+'" class="btn btn-info" style="width: 100%; margin-bottom: 9px; color:white;"><i class="fas fa-arrow-right fa-fw text-light mr-2"></i>Directions</a>';

        var popupContent = '';

        if (settings.mapPopupType == 'venue') {
            popupContent =

            '<div class="popup-venue card" style="height:440px;">' +
                '<div style = "overflow: hidden; padding: 20px 20px 71px; background-image: url(\''  +  spryimg + '\'); background-size: cover; background-position: center;" class="map-direction-image">' + '</div>'+
                image1+
                '<div class="card-body">'+
                    '<div class="">' +title +' </div>' +
                    '<div>'+ direc +'</div>'+
                    '<div>'+ stars +'</div>'+
                    '<div>'+ stars2 +'</div>'+
                    '<div>'+ address +'</div>'+
                    '<div>'+ phone +'</div>'+
                '</div>' +
            '</div>';

            
            //OLD CODE OF MAPH LISTING POPUP VIEW
            
            // '<div class="popup-venue card">' +
            //     '<div style = "overflow: hidden;">' +'<img src="'  +'thumb-'+properties.image + '" class="card-img-top">'+ '</div>'+
            //     '<div class="card-body">'+
            //         '<div class="">' +title +' </div>' +
            //         '<div>'+ address +'</div>'+
            //         '<div>'+ phone +'</div>'+
            //     '</div>' +
            // '</div>';

        } else if (settings.mapPopupType == 'rental') {
            popupContent =
                '<div class="popup-rental">' +
                image +
                image1+
                '<div class="text">' +
                title +
                stars +
                '</div>' +
                '</div>';
        }


        return popupContent;
    }
    /*
    ====================================================
      Highlight marker when users hovers above
      corresponding .card in the listing
    ====================================================
    */

    L.Map.include({
        getMarkerById: function (id) {
            var marker = null;
            this.eachLayer(function (layer) {
                if (layer instanceof L.Marker) {
                    if (layer.options.id === id) {
                        marker = layer;
                    }
                }
            });
            return marker;
        }
    });


    // This function hightlights the marker on hovering over a certain listing

    /*
    $('[data-marker-id!=""][data-marker-id]').on('mouseenter', function () {
        var markerId = $(this).data('marker-id');
        var marker = map.getMarkerById(markerId);
        if (marker) {
            highlight(marker);
        }
    });
    */


    // This function remove the highlightness from map marker after mouseleaving event

    /*$('[data-marker-id!=""][data-marker-id]').on('mouseleave', function () {
        var markerId = $(this).data('marker-id');
        var marker = map.getMarkerById(markerId);
        if (marker) {
            reset(marker);
        }
    });*/

    // This function highlights the map marker for a certain listing after clicking on the get direction button
    var previousHighLightedMarkerId;
    $('[button-direction-id!=""][button-direction-id]').on('click', function () {
        var markerId = $(this).attr('button-direction-id');
        var marker = map.getMarkerById(markerId);
        if (marker) {
            marker.openPopup(); // this line of code opens up the pop on map
            highlight(marker);
            if (previousHighLightedMarkerId != markerId) {
                var marker = map.getMarkerById(previousHighLightedMarkerId);
                if (marker) {
                    reset(marker);
                }
            }
            previousHighLightedMarkerId = markerId;
        }
    });
    $('.leaflet-control-attribution').hide();
}

</script>
