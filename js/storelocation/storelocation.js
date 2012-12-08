function StoreLocation(elCountry, elRegion, elStoresContent) {

	this.elCountry 			= elCountry;
	this.elRegion			= elRegion;
	this.elStoresContent	= elStoresContent;

	this.changeCountry = function(changeRegion) {

		jQuery.ajax({
		  url: elCountry.data('url')+'?countryIso='+elCountry.val(),
		  success: function(data){
			elRegion.html(data);

			changeRegion();
		}});
	};

	this.changeRegion = function() {

		jQuery.ajax({
		  url: elRegion.data('url')+'?countryIso='+elCountry.val()+'&region='+elRegion.val(),
		  success: function(data){
			stores = eval(data);
			map.deleteOverlays();

			elStoresContent.html('');

			jQuery.each(stores, function(i, store){
				map.addMarker(new google.maps.LatLng(store.lat, store.lng), store.address);
				elStoresContent.append(store.text);
			});
			map.fitBounds();

		}});
	};
}

var map = {
	el:null,
	markers: null,
	bounds : null,
	icon : null,
	infowindow: null,
	initMap : function(st) {

		map.markers = [];
		map.bounds 	= new google.maps.LatLngBounds();
		map.icon 	= new google.maps.MarkerImage(storeLocation.elStoresContent.data('iconmap'));

		var myOptions = {
			zoom: 9,
			center: new google.maps.LatLng('42.747012', '-8.670959'),
			mapTypeId: google.maps.MapTypeId.ROADMAP,
		    disableDefaultUI: true,
		    zoomControl: true,
		    zoomControlOptions: {
		      style: google.maps.ZoomControlStyle.SMALL
		    }
		}

		map.el = new google.maps.Map(document.getElementById('store_map'), myOptions);

		storeLocation.changeRegion();
	},


	// Deletes all markers in the array by removing references to them
	deleteOverlays : function() {
	  if (map.markers.length>0) {
        for (var i = 0; i < map.markers.length; i++) {
          map.markers[i].setMap(null);
        }
	    map.markers = [];
	  	map.bounds 	= new google.maps.LatLngBounds();
	  }
	},


	addMarker : function(point, infoPopup) {
		map.bounds.extend(point);

		map.markers.push(new google.maps.Marker({position: point, map: map.el, icon: map.icon}));

		map.markers[map.markers.length-1].infowindow = new google.maps.InfoWindow({
			    content: infoPopup,
			    maxWidth: 200
			});

		google.maps.event.addListener(map.markers[map.markers.length-1], 'click', function() {
			this.infowindow.open(map.el, this);
		});
	},


	openInfo : function(i) {
		if(map.markers[i]) {
			google.maps.event.trigger(map.markers[i], 'click');

			map.el.setCenter(map.markers[i].getPosition());
		}
	},


	fitBounds : function() {
		if(map.markers.length>1) {
			map.el.fitBounds(map.bounds);
		} else if(map.markers.length==1) {
			map.el.setCenter(map.markers[0].getPosition());
		}
	}
};


var storeLocation;


jQuery(document).ready(function(){

	jQuery('.link_view_store').live('click', function(){
		map.openInfo(jQuery(this).data('storepos'));
	});

	storeLocation = new StoreLocation(jQuery('#countries_select'), jQuery('#regions_select'), jQuery('#stores_content'));

	jQuery('#countries_select').live('change', function(){
		storeLocation.changeCountry(storeLocation.changeRegion);
	});

	jQuery('#regions_select').live('change', function(){
		storeLocation.changeRegion();
	});

	if(jQuery('#store_map').size()>0){
		jQuery.getScript('http://maps.google.com/maps/api/js?sensor=false&region=ES&callback=map.initMap');
	}
});