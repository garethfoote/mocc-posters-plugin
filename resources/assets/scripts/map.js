"use strict";

var Map  = function(config){

  var defaults = {
    // South east'ish. Will be overriden with fitBounds.
    center: [51.505, -0.09],
    zoom: 13,
    cluster : {
      singleMarkerMode : true
    }
  };

  this.config = $.extend({}, defaults, config);

  var $mapContainer = $('.js-map');

  this.lMap = L.map($mapContainer[0], {
    center: this.config.center,
    zoom: this.config.zoom
  });

  // L.Icon.Default.imagePath = window.themeURL+'/assets/styles/images/';
  L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(this.lMap);

  this.addMarkers($mapContainer.data('locations'));

};


Map.prototype.addMarkers = function(data){

  var markers = new L.MarkerClusterGroup();
  var len, allBounds = [];
  for(var i=0, len = data.length; i<len; i++){
    allBounds[i] = [data[i].latitude,data[i].longitude];
    markers.addLayer(new L.Marker(allBounds[i]));
  }
  this.lMap.addLayer(markers);

  if(allBounds.length > 0){
    this.lMap.fitBounds(allBounds);
  }

};


new Map();
