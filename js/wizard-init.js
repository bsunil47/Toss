/**
 * Created by mosaddek on 3/5/15.
 */
jQuery.noConflict();
jQuery(document).ready(function () {
	


    var formB = jQuery("#basic-form");
	
	formB.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
		onStepChanging: function (event, currentIndex, newIndex) {
			
            formB.validate().settings.ignore = ":disabled,:hidden";
            return formB.valid();
			
        },
        onFinishing: function (event, currentIndex) {
			//jQuery(".category").select2("enable", true);
			alert('kk');
			var placeholder = "Select One";

            formB.validate().settings.ignore = ":disabled";
			
            return formB.valid();
        },
        onFinished: function (event, currentIndex) {
            alert("Submitted!");
        }
		
		

    });
    
//jQuery("#next").click(function() {
	//jQuery(".category").select2("enable", true); });
//jQuery("div").steps({  });
    var form = jQuery("#wizard-validation-form");
    form.validate({
        errorPlacement: function errorPlacement(error, element) {
            element.after(error);
			
        }
		
    });
    form.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        onStepChanging: function (event, currentIndex, newIndex) {
			
            form.validate().settings.ignore = ":disabled,:hidden";
			
            return form.valid();
			
        },
        onFinishing: function (event, currentIndex) {
			//jQuery(".category").select2("enable", true);
            form.validate().settings.ignore = ":disabled";
			
            return form.valid();
        },
        onFinished: function (event, currentIndex) {
            alert("Submitted!");
        }
		//jQuery("#next a").click(function() { jQuery(".category").select2("enable", true); });	
    });




	jQuery('.timepicker-24').timepicker({ 
	 defaultTime: false,
	 //pick12HourFormat: false
	autoclose: true,
    minuteStep: 15,
    showSeconds: true,
    showMeridian: false
	});
	
	jQuery('.timepicker-24_to').timepicker({
		defaultTime: false,
		//pick12HourFormat: false
                autoclose: true,
    minuteStep: 15,
    showSeconds: true,
    showMeridian: false
		});
		
	if (Array.prototype.forEach) {
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function(html) {
        var switchery = new Switchery(html);
    });
	} else {
    var elems = document.querySelectorAll('.js-switch');

    for (var i = 0; i < elems.length; i++) {
        var switchery = new Switchery(elems[i]);
    }
}

// Disabled switch
var disabled = document.querySelector('.js-switch-disabled');
var switchery = new Switchery(disabled, { disabled: true });

var disabledOpacity = document.querySelector('.js-switch-disabled-opacity');
var switchery = new Switchery(disabledOpacity, { disabled: true, disabledOpacity: 0.75 });
	
var small = document.querySelectorAll('.js-switch-small-green');
var elems = Array.prototype.slice.call(small);
elems.forEach(function(html){
	var switchery = new Switchery(html);
});

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*function for button*/
var autocompletedestination, autocompleteOrgin,autocompletewaypoint;
/*var searchBox = new google.maps.places.Autocomplete(
	document.getElementById('tossvenueform-toss_ven_location')
    );*/


// Listen for the event fired when the user selects an item from the
// pick list. Retrieve the matching places for that item.






/*autocompleteplace =  new google.maps.places.Autocomplete(
    *//** @type {HTMLInputElement} *//*(document.getElementById('tollform-toll_location')),
    {types: ['geocode']});*/



var geocoder = new google.maps.Geocoder();
var infowindow = new google.maps.InfoWindow();
var map = null;
var marker = null;
var Lat;
var Lng;
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
    /*google.maps.event.addListener(searchBox, 'place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = searchBox.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }

        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            //map.setZoom(17);  // Why 17? Because it looks good.
        }

        marker.setPosition(place.geometry.location);
        marker.setVisible(true);
        var address = '';
       /* if (place.address_components) {
            address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
        }*/

        //infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
        //infowindow.open(map, marker);
    /*});*/

}
jQuery(document).ready(function () {
			/*google.maps.event.addListener(searchBox, 'places_changed', function() {
            infowindow.close();
            var place = searchBox.getPlace();

        });*/


    if (jQuery('#map-canvas').length > 0) {
        getLocation();
    }

});

function showPosition(position) {
    var circle = new google.maps.Circle({
        center: new google.maps.LatLng(
            position.coords.latitude, position.coords.longitude),
        radius: position.coords.accuracy
    });
//    searchBox.setBounds(circle.getBounds());

    //autocompleteOrgin.setBounds(circle.getBounds());
    //autocompletedestination.setBounds(circle.getBounds());
    ///autocompletewaypoint.setBounds(circle.getBounds());
    var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

    var dragable_value = true;
    if (jQuery('#tossvenueform-toss_ven_location').length > 0  || jQuery('.common-route-location').length > 0) {
        //console.log(jQuery('#tolls-toll_lat').val());
        codeLatLng(position.coords.latitude, position.coords.longitude);
    }else if (jQuery('.toll-view').length > 0) {
        latlng = new google.maps.LatLng(jQuery('table tr:eq(3) > td:eq(0)').text(), jQuery('table tr:eq(4) > td:eq(0)').text());
        dragable_value = false;
    }else{
        latlng = new google.maps.LatLng(jQuery('#tossvenueform-toss_ven_lat').val(), jQuery('#tossvenueform-toss_ven_lng').val());
       //codeLatLng(jQuery('#tolls-toll_lat').val(), jQuery('#tolls-toll_lng').val());
    }
    var mapOptions = {
        zoom: 17,
        center: latlng
    };
	
    map = new google.maps.Map(document.getElementById("map-canvas"),mapOptions);
    marker = new google.maps.Marker({
        position: map.getCenter(),
        draggable: dragable_value,
        map: map
    });
    google.maps.event.addListener(marker, 'dragend', function (event) {
        if (map.getZoom() < 10) {
            map.setZoom(10);
        }
        map.setCenter(event.latLng);
        codeLatLng(event.latLng.lat(), event.latLng.lng());
        drag = true;
        setTimeout(function () {
            drag = false;
        }, 250);
    });

    //searchBox.bindTo('bounds', map);


}

function codeLatLng(lat, Lng) {
    var latlng = new google.maps.LatLng(lat, Lng);
    geocoder.geocode({'latLng': latlng}, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (results[1]) {
                map.setZoom(17);
                if (jQuery('#tossvenueform-toss_ven_location').length > 0) {
                    jQuery('#tossvenueform-toss_ven_location').val(results[1].formatted_address);
                    jQuery('#tossvenueform-toss_ven_lat').val(lat);
                    jQuery('#tossvenueform-toss_ven_lng').val(Lng);
                }
                if (jQuery('#tossvenueform-toss_ven_location').length > 0) {
                    jQuery('#tossvenueform-toss_ven_location').val(results[1].formatted_address);
                    jQuery('#tossvenueform-toss_ven_lat').val(lat);
                    jQuery('#tossvenueform-toss_ven_lng').val(Lng);
                }
                //console.log(results[1].formatted_address);
                //infowindow.setContent(results[1].formatted_address);
                //infowindow.open(map, marker);
            } else {
                alert('No results found');
            }
        } else {
            alert('Geocoder failed due to: ' + status);
        }
    });
}
/*function initialize(lat, lng) {

    var mapOptions = {
        zoom: 17,
        center: new google.maps.LatLng(lat, lng),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
}

google.maps.event.addDomListener(window, 'load', initialize(21.0000, 78.0000));*/


});