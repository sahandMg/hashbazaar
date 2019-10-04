<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mapbox-gl/1.1.0/mapbox-gl.js"></script>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/v1.0.0/mapbox-gl.css">
    <style>
        #map {height: 600px}
    </style>
    <title>Document</title>
</head>
<body>

<div id='map'></div>


<script>
    var apiKey =
            'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImU2MTRkNWZlYTkxZDQyMDJhMWNjZTRiNjUyNjFjNTkxNGNiZDk5NmRkMmM0MTIxNTc4ODc2NjkxNDVhZjBiMTMwMmYyMDI4ZjJmNDkyNDNkIn0.eyJhdWQiOiI2MzIxIiwianRpIjoiZTYxNGQ1ZmVhOTFkNDIwMmExY2NlNGI2NTI2MWM1OTE0Y2JkOTk2ZGQyYzQxMjE1Nzg4NzY2OTE0NWFmMGIxMzAyZjIwMjhmMmY0OTI0M2QiLCJpYXQiOjE1NzAwMzEzOTQsIm5iZiI6MTU3MDAzMTM5NCwiZXhwIjoxNTcyNTM2OTk0LCJzdWIiOiIiLCJzY29wZXMiOlsiYmFzaWMiXX0.szJGMmyLHQob17ZLmRfZ1WTIZL2zKTj5WFnRB2hGkArSywuBMmuoaBVtwK4ESQOHfQQqHl-oo5GO-gAo6u-irDzhhPpGbMtwrWI0AYYBM9xFxjNHrORs_wH6KW1I28TYd25G_F2XK57KKVWZrwRybPKO6AER9t-XddLymHnsBU2VtkcLuWJ5aaY-M-I-3S-6WEhOEhIzoEic5dvSK-2w1Q0TRWXcCcHoCxBi3evNSvHiE_w71ibodokaNZTXCj8408uNQEtKrw8HBzcB5whF88RRJFbq3cBDDuo9OHQ8_chtBnmZ_8c_k3Z99_bQqW-nd3UTJuF0Cjn64ztxB4XzmA';

    mapboxgl.setRTLTextPlugin('https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-rtl-text/v0.2.0/mapbox-gl-rtl-text.js');

    var map = new mapboxgl.Map({
        container: 'map',
        center: [51.420470, 35.729054],
        zoom: 15,
        style: `https://map.ir/vector/styles/main/mapir-xyz-style.json?x-api-key=${apiKey}`,
        hash: true,
        tms: true,
        transformRequest: (url, resourceType)=> {
            return {
                url: url,
                headers: { 'x-api-key': apiKey}
            }
        }
    });

</script>

</body>
</html>