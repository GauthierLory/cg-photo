function initMap() 
{
  var matane = {lat: 48.841032, lng: -67.496641};
  var map = new google.maps.Map(document.getElementById('map'), 
  {
    zoom: 10,
    center: matane
  });
  var marker = new google.maps.Marker(
  {
    position: matane,
    map: map
  });
}