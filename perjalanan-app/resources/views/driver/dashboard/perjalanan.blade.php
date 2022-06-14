@extends('driver.layouts.main')

@section('main')
    <div class="pagetitle">
        <h1>Perjalanan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index-driver.html">Home</a></li>
                <li class="breadcrumb-item active">Perjalanan</li>
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
                                {{ session('alert') }} <button type="button" class="btn-close"
                                    data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <h5 class="card-title">Perjalanan</h5>
                        @if ($perjalanan_ride == null)
                            @if ($driver->ride_status == 1)
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Rute</th>
                                            <th scope="col">Durasi</th>
                                            <th scope="col">Jarak</th>
                                            <th scope="col">Biaya</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rides as $ride)
                                            <tr>
                                                <td>{{ $ride->passenger->user->name }}</td>
                                                <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js"></script>
                                                <link rel="stylesheet"
                                                    href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css"
                                                    type="text/css">
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#modalview{{ $ride->id }}">
                                                        View
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modalview{{ $ride->id }}"
                                                        tabindex="-1" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Rute
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body" id="mapNew">
                                                                    <div class="mapNew" id="mapNew"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td id='durasi'></td>
                                                <td id='jarak'></td>
                                                <td id='biaya'></td>
                                                <td>
                                                    <form action="/driver/perjalanan/{{ $ride->id }}" method="post">
                                                        @method('put')
                                                        @csrf
                                                        <button type="submit" class="btn btn-success"
                                                            onclick="return confirm('Kamu yakin mau ambil perjalanan ini?')"
                                                            style="margin-top: 2px">
                                                            Ambil
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <script>
                                                // format int ke currency indonesia
                                                var formatter = new Intl.NumberFormat('id-ID', {
                                                    style: 'currency',
                                                    currency: 'IDR',
                                                });
                                                var ride = {!! json_encode($ride->toArray()) !!};
                                                var payment = {!! json_encode($ride->payment->toArray()) !!};

                                                const biaya = document.getElementById('biaya');
                                                const jarak = document.getElementById('jarak');
                                                const durasi = document.getElementById('durasi');
                                                biaya.innerHTML = formatter.format(payment.amount);

                                                mapboxgl.accessToken = 'pk.eyJ1IjoiYXJ5YXAyIiwiYSI6ImNsMXU1MmJ3NjJpemQzcXVrNnQ3cDFibmEifQ.WtmVOqIR6MWhE9HNjQpPkw';
                                                const map = new mapboxgl.Map({
                                                    container: 'mapNew',
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
                                                        biaya.innerHTML = formatter.format(payment.amount);

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
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="container">
                                    <section
                                        class="section min-vh-100 d-flex flex-column align-items-center justify-content-center">
                                        <h1>Status perjalanan Anda mati</h1>
                                        <h3>Nyalakan terlebih dahulu untuk mengambil perjalanan</h3>
                                        <img src="https://cdn-icons-png.flaticon.com/512/868/868680.png"
                                            class="img-fluid py-5" alt="Page Not Found">
                                    </section>
                                </div>
                            @endif
                        @else
                            <div class="row mb-3">
                                <div class="col-sm-2 label ">Nama pemesan</div>
                                <div class="col-sm-10" id='passenger'>
                                    {{ $perjalanan_ride->passenger->user->name }}
                                </div>
                            </div>

                            <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js"></script>
                            <link rel="stylesheet"
                                href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css"
                                type="text/css">

                            <div class="row mb-3">
                                <label for="inputMap" class="col-form-label col-sm-2">Rute</label>
                                <div class="col-sm-10" id="map" name="map">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-2 label ">Durasi</div>
                                <div class="col-sm-10" id='durasi'>00 jam 00 menit</div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-2 label ">Jarak</div>
                                <div class="col-sm-10" id='jarak'>00 km 00 meter</div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-2 label ">Biaya</div>
                                <div class="col-sm-10" id='biaya'>Rp 0,00</div>
                            </div>

                            <form action="/driver/perjalanan/selesai/{{ $perjalanan_ride->id }}" method="post">
                                @method('put')
                                @csrf
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary"
                                            onclick="return confirm('Anda yakin mau selesaikan perjalanan ini?')"
                                            style="margin-top: 2px">
                                            Selesai
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <script>
                                // format int ke currency indonesia
                                var formatter = new Intl.NumberFormat('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR',
                                });
                                var ride = {!! json_encode($perjalanan_ride->toArray()) !!};
                                var payment = {!! json_encode($perjalanan_ride->payment->toArray()) !!};

                                const durasi = document.getElementById('durasi');
                                const jarak = document.getElementById('jarak');
                                const biaya = document.getElementById('biaya');

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
                                        biaya.innerHTML = formatter.format(payment.amount);

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
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
