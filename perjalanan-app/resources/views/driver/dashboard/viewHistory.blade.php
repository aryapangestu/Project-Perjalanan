@extends('driver.layouts.main')

@section('main')
    <div class="pagetitle">
        <h1>Perjalanan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href='/'>Home</a></li>
                <li class="breadcrumb-item"><a href='/driver/history'>History</a></li>
                <li class="breadcrumb-item active">View</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        @if (session()->has('alert'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('alert') }} <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <h5 class="card-title">View perjalanan</h5>
                        <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js"></script>
                        <link rel="stylesheet"
                            href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css"
                            type="text/css">

                        <div class="row mb-3">
                            <div class="col-lg-3 col-md-4 label ">Rute</div>
                            <div class="col-lg-9 col-md-8" id="map" name="map"></div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-3 col-md-4 label ">Durasi</div>
                            <div class="col-lg-9 col-md-8" id="durasi"></div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-3 col-md-4 label ">Jarak</div>
                            <div class="col-lg-9 col-md-8" id="jarak"></div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-3 col-md-4 label ">Biaya</div>
                            <div class="col-lg-9 col-md-8" id="biaya"></div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <script>
        // format int ke currency indonesia
        var formatter = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
        });
        var ride = {!! json_encode($ride->toArray()) !!};
        ride = ride[0]

        const biaya = document.getElementById('biaya');
        const jarak = document.getElementById('jarak');
        const durasi = document.getElementById('durasi');
        biaya.innerHTML = formatter.format(ride.amount);

        mapboxgl.accessToken = 'pk.eyJ1IjoiYXJ5YXAyIiwiYSI6ImNsMXU1MmJ3NjJpemQzcXVrNnQ3cDFibmEifQ.WtmVOqIR6MWhE9HNjQpPkw';
        const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [107.60340, -6.93487],
            zoom: 12,
        });

        if (ride.vehicle_type == 'Mobil') {
            temp = 'mapbox/driving';
        } else if (ride.vehicle_type == 'Motor') {
            temp = 'mapbox/walking';
        }

        var directions = new MapboxDirections({
            accessToken: mapboxgl.accessToken,
            interactive: false,
            unit: 'metric',
            profile: temp,
            language: 'id-ID',
            controls: {
                instructions: false,
                inputs: false,
            }
        });
        map.addControl(directions, 'top-left');
        map.on('load', function() {
            directions.setOrigin([ride.pick_up_form_longitude, ride.pick_up_form_latitude]);
            directions.setDestination([ride.drop_to_longitude, ride.drop_to_latitude]);
            directions.on('route', (event) => {
                seconds = event.route[0].duration;
                distance = event.route[0].distance;

                durasi.innerHTML = secondsToDhms(seconds);
                biaya.innerHTML = formatter.format(ride.amount);

                // lebih dari 500 meter, maka print KM saja
                if (distance > 500) {
                    distanceResult = (distance / 1000).toFixed(1);
                    jarak.innerHTML = distanceResult + " kilometer ";
                } else {
                    distanceResult = distance.toFixed(1);
                    jarak.innerHTML = distanceResult + " meter ";
                }

            });
        })
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
@endsection
