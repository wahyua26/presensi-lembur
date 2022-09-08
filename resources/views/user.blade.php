{{-- <!DOCTYPE html>
<html>
<head>
	<title>Belajar Ambil Lokasi</title>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

<p>lokasi anda saat ini: <span id="lokasi"></span></p>
<p id="latitude"></p>
<p id="longitude"></p>


<script type="text/javascript">
	$(document).ready(function() {
		navigator.geolocation.getCurrentPosition(function (position) {
   			tampilLokasi(position);
			getaddress(position.coords.latitude, position.coords.longitude);
		}, function (e) {
		    alert('Geolocation Tidak Mendukung Pada Browser Anda');
		}, {
		    enableHighAccuracy: true
		});
	});
	function tampilLokasi(posisi) {
		console.log(posisi);
		var latitude 	= posisi.coords.latitude;
		var longitude 	= posisi.coords.longitude;
        console.log(latitude);
        console.log(longitude);
        document.getElementById("latitude").innerHTML = latitude;
        document.getElementById("longitude").innerHTML = longitude;
	}
	function getReverseGeocodingData(lat, lng) {
		var latlng = new google.maps.LatLng(lat, lng);
		// This is making the Geocode request
		var geocoder = new google.maps.Geocoder();
		geocoder.geocode({ 'latLng': latlng },  (results, status) =>{
			if (status !== google.maps.GeocoderStatus.OK) {
				alert(status);
			}
			// This is checking to see if the Geoeode Status is OK before proceeding
			if (status == google.maps.GeocoderStatus.OK) {
				console.log(results);
				var address = (results[0].formatted_address);
			}
		});
	}
	function getaddress($lat,$lng)
	{
		$url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lng).'&sensor=false';
		console.log($url);
		$json = @file_get_contents($url);
		$data=json_decode($json);
		$status = $data->status;
		if($status=="OK")
		{
			return $data->results[0]->formatted_address;
		}
		else
		{
			return false;
		}
	}
</script>

</body>
</html> --}}

<html>
<head> 
<title> Google Maps API: Mengubah Latitude Longitude Menjadi Alamat dengan Geocoder </title>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBax4O4XquCBbGGtxIK-jaJzIsYqU&callback=initMap" async defer></script>
<script type="text/javascript">
function initialize() {
var latlng = {lat: -6.262581048548821, lng: 106.86614602804184};
var geocoder = new google.maps.Geocoder;
geocoder.geocode({'location': latlng}, function(results, status) {
  if (status === 'OK') {
	if (results[0]) {
	  rs = results[0].formatted_address;
	} else {
	  rs = 'No results found';
	}
  } else {
	  rs = 'Geocoder failed due to: ' + status;
  }
	 alert(rs);
});
}
</script>
</head>
<body> </body>
</html>	