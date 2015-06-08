"use strict";

var Geolocate  = function(config){

  var defaults = {
  };

  this.config = $.extend({}, defaults, config);
  this.init();

};

Geolocate.prototype.init = function(){

  var success = $.proxy(this.success, this);
  var error = $.proxy(this.error, this);
  navigator.geolocation.getCurrentPosition(success, error);

};

Geolocate.prototype.success =  function(position) {

  var latitude  = position.coords.latitude;
  var longitude = position.coords.longitude;

  // output.innerHTML = '<p>Latitude is ' + latitude + '° <br>Longitude is ' + longitude + '°</p>';

  var img = new Image();
  img.src = "https://maps.googleapis.com/maps/api/staticmap?center=" + latitude + "," + longitude + "&zoom=13&size=300x300&sensor=false";

  $('.js-moccStats-locationImg').html(img);

};

Geolocate.prototype.error =  function(position) {
  // TODO: Inform user.
  console.error('no such luck');
};

Geolocate.prototype.post = function() {

  var jqXHR = $.post(window.ajaxURL, {
    action        : 'add_location',
    postID        : window.postID,
    coords        : { lat: "-33.805789", lng: "151.002060" },
    security      : window.ajaxNonce
  }, function(res){
    console.log(res);
  });

};

new Geolocate();
