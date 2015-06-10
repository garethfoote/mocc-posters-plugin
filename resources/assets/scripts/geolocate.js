"use strict";

var Geolocate  = function(config){

  var defaults = {
    'assetURL' : ''
  };

  this.config = $.extend({}, defaults, config);
  this.init();

};

Geolocate.prototype.init = function(){

  var success = $.proxy(this.success, this);
  var error = $.proxy(this.error, this);
  navigator.geolocation.getCurrentPosition(success, error);

};

Geolocate.prototype.createMap =  function(coords) {

  var $el = $('.js-locationImg');
  console.log($el);

  var lMap = L.map($el[0], {
    center: coords,
    zoom: 15,
    zoomControl: false
  });

  // L.Icon.Default.imagePath = window.themeURL+'/assets/styles/images/';
  L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(lMap);

  var marker = L.marker(coords).addTo(lMap);
  marker.bindPopup("<img class=\"moccMap-icon\" width=\"35px\" src='"+this.config.assetURL+"/img/mocc-cctv.png'>");

};

Geolocate.prototype.success =  function(position) {

  var latitude  = parseFloat(position.coords.latitude).toFixed(8);
  var longitude = parseFloat(position.coords.longitude).toFixed(8);

  // var img = new Image();
  // img.src = "https://maps.googleapis.com/maps/api/staticmap?center=" + latitude + "," + longitude + "&zoom=13&size=300x300&sensor=false";

  this.createMap([latitude, longitude]);

  if(window.MoCCPosters.located === false){
    this.post(latitude, longitude);
  }
};

Geolocate.prototype.error =  function(position) {
  // TODO: Inform user.
  console.error('no such luck');
};

Geolocate.prototype.post = function(lat, lng) {

  var jqXHR = $.post(window.MoCCPosters.ajaxURL, {
    action        : 'add_location',
    postID        : window.MoCCPosters.postID,
    coords        : { lat: lat, lng: lng },
    security      : window.MoCCPosters.ajaxNonce
  }, function(res){
    console.log(res);
    // Increment by the count that we've just posted via AJAX.
    $('.js-increment').html(parseInt($('.js-increment').html())+1);
  });

};

new Geolocate({
  assetURL : window.MoCCPosters.assetURL
});
