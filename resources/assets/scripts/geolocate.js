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

  var latitude  = parseFloat(position.coords.latitude).toFixed(8);
  var longitude = parseFloat(position.coords.longitude).toFixed(8);

  var img = new Image();
  img.src = "https://maps.googleapis.com/maps/api/staticmap?center=" + latitude + "," + longitude + "&zoom=13&size=300x300&sensor=false";

  $('.js-locationImg').html(img);

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

new Geolocate();
