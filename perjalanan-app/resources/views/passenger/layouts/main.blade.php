<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - Perjalanan Admin Panel</title>

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!-- Template Main CSS File -->
    <link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet">

    <!-- Mapbox -->
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.8.2/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.8.2/mapbox-gl.js"></script>

</head>

<body>

    @include('passenger.partials.header')

    @include('passenger.partials.sidebar')

    <main id="main" class="main">
        @yield('main')
    </main><!-- End #main -->


    <!-- Vendor JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Template Main JS File -->
    <script src="{{ URL::asset('assets/js/main.js') }}"></script>

    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiYXJ5YXAyIiwiYSI6ImNsMXU1MmJ3NjJpemQzcXVrNnQ3cDFibmEifQ.WtmVOqIR6MWhE9HNjQpPkw';
        const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [107.60340, -6.93487],
            zoom: 12
        });

        var directions = new MapboxDirections({
            accessToken: mapboxgl.accessToken,
            unit: 'metric',
            profile: 'mapbox/driving',
            language: 'id-ID',
            placeholderOrigin: 'Pilih titik jemput',
            placeholderDestination: 'Pilih tujuan',
            controls: {
                instructions: false
            }
        });
        map.addControl(directions, 'top-left');

        function changeInstructions(str) {
            if (str == "") {
                directions.on(error);
            } else if (str == "1") {
                document.getElementById("mapbox-directions-profile-driving").click();
            } else if (str == "2") {
                document.getElementById("mapbox-directions-profile-walking").click();
            }
        }
        const tujuan = document.getElementById('tujuan');
        const jemput = document.getElementById('jemput');
        const durasi = document.getElementById('durasi');
        const jarak = document.getElementById('jarak');
        const biaya = document.getElementById('biaya');
        const typeRide = document.getElementById('typeRide');

        // format int ke currency indonesia
        var formatter = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
        });

        map.on('load', () => {
            directions.on('route', (event) => {
                seconds = event.route[0].duration;
                distance = event.route[0].distance;

                tujuan.value = directions.getDestination().geometry.coordinates;
                jemput.value = directions.getOrigin().geometry.coordinates;
                durasi.innerHTML = secondsToDhms(seconds);

                // lebih dari 500 meter, maka print KM saja
                if (distance > 500) {
                    distanceResult = (distance / 1000).toFixed(1);
                    jarak.innerHTML = distanceResult + " kilometer ";
                } else {
                    distanceResult = distance.toFixed(1);
                    jarak.innerHTML = distanceResult + " meter ";
                }

                if (typeRide.value == "1") {
                    // Mobil 10000/KM
                    biayaResult = ((distance / 1000) * 10000).toFixed(0);
                    biaya.innerHTML = formatter.format(biayaResult);
                } else if (typeRide.value == "2") {
                    // Motor 3000/KM
                    biayaResult = ((distance / 1000) * 3000).toFixed(0);
                    biaya.innerHTML = formatter.format(biayaResult);
                }


            });
        });

        // convert detik to hari jam menit detik
        function secondsToDhms(seconds) {
            seconds = Number(seconds);
            var d = Math.floor(seconds / (3600 * 24));
            var h = Math.floor(seconds % (3600 * 24) / 3600);
            var m = Math.floor(seconds % 3600 / 60);
            var s = Math.floor(seconds % 60);

            var dDisplay = d > 0 ? d + (d == 1 ? " day, " : " hari, ") : "";
            var hDisplay = h > 0 ? h + (h == 1 ? " hour, " : " jam, ") : "";
            var mDisplay = m > 0 ? m + (m == 1 ? " minute, " : " menit, ") : "";
            var sDisplay = s > 0 ? s + (s == 1 ? " second" : " detik") : "";
            return dDisplay + hDisplay + mDisplay + sDisplay;
        }
    </script>

</body>

</html>
