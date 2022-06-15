@extends('passenger.layouts.main')

@section('main')
    <div class="pagetitle">
        <h1>Pemesanan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href='/'>Home</a></li>
                <li class="breadcrumb-item active">Pemesanan</li>
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
                        @if ($status == '1' || $status == '-1')
                            <h5 class="card-title">Form Pemesanan</h5>
                            <!-- General Form Elements -->
                            <form action="/passenger/pemesanan" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Pilih Kendaraan</label>
                                    <div class="col-sm-10">
                                        <select class="form-select @error('vehicle_type') is-invalid @enderror"
                                            aria-label="Default select example" id="typeRide" name="vehicle_type"
                                            onchange="changeInstructions(this.value)" required>
                                            <option {{ old('vehicle_type') === 'Mobil' ? 'selected=""' : '' }}
                                                value="Mobil">Mobil</option>
                                            <option {{ old('vehicle_type') === 'Motor' ? 'selected=""' : '' }}
                                                value="Motor">Motor</option>
                                            @error('vehicle_type')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3 hide">
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id='pick_up_form_latitude'
                                            name='pick_up_form_latitude'>
                                    </div>
                                </div>
                                <div class="row mb-3 hide">
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id='pick_up_form_longitude'
                                            name='pick_up_form_longitude'>
                                    </div>
                                </div>
                                <div class="row mb-3 hide">
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id='drop_to_latitude'
                                            name='drop_to_latitude'>
                                    </div>
                                </div>
                                <div class="row mb-3 hide">
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id='drop_to_longitude'
                                            name='drop_to_longitude'>
                                    </div>
                                </div>
                                <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js"></script>
                                <link rel="stylesheet"
                                    href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css"
                                    type="text/css">

                                <div class="row mb-3">
                                    <label for="inputMap" class="col-form-label col-sm-2">Pilih Map</label>
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
                                    <div class="col-sm-10" id='biaya' name='amount'>Rp 0,00</div>
                                </div>
                                <div class="row mb-3 hide">
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id='amount' name='amount'>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Pesan</button>
                                    </div>
                                </div>

                            </form><!-- End General Form Elements -->
                        @elseif ($status == '0')
                            <div class="container">

                                <section
                                    class="section min-vh-100 d-flex flex-column align-items-center justify-content-center">
                                    <h1>Anda sedang melakukan perjalanan</h1>
                                    <h3>Selesaikan terlebih dahulu perjalanan Anda</h3>
                                    <img src="https://cdn-icons-png.flaticon.com/512/868/868680.png" class="img-fluid py-5"
                                        alt="Page Not Found">
                                </section>

                            </div>
                        @endif
                    </div>
                </div>

            </div>

            </form><!-- End General Form Elements -->

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

        // get elemet id form html
        const pick_up_form_latitude = document.getElementById('pick_up_form_latitude');
        const pick_up_form_longitude = document.getElementById('pick_up_form_longitude');
        const drop_to_latitude = document.getElementById('drop_to_latitude');
        const drop_to_longitude = document.getElementById('drop_to_longitude');
        const durasi = document.getElementById('durasi');
        const jarak = document.getElementById('jarak');
        const biaya = document.getElementById('biaya');
        const amount = document.getElementById('amount');
        const typeRide = document.getElementById('typeRide');

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

        map.on('load', () => {
            directions.on('route', (event) => {
                seconds = event.route[0].duration;
                distance = event.route[0].distance;

                pick_up_form_latitude.value = directions.getOrigin().geometry.coordinates[1];
                pick_up_form_longitude.value = directions.getOrigin().geometry.coordinates[0];
                drop_to_latitude.value = directions.getDestination().geometry.coordinates[1];
                drop_to_longitude.value = directions.getDestination().geometry.coordinates[0];

                durasi.innerHTML = secondsToDhms(seconds);

                // lebih dari 500 meter, maka print KM saja
                if (distance > 500) {
                    distanceResult = (distance / 1000).toFixed(1);
                    jarak.innerHTML = distanceResult + " kilometer ";
                } else {
                    distanceResult = distance.toFixed(1);
                    jarak.innerHTML = distanceResult + " meter ";
                }

                // Biaya
                if (typeRide.value == 'Mobil') {
                    // Mobil 10000/KM
                    biayaResult = ((distance / 1000) * 10000).toFixed(0);
                    biaya.innerHTML = formatter.format(biayaResult);
                    amount.value = biayaResult;
                } else if (typeRide.value == 'Motor') {
                    // Motor 3000/KM
                    biayaResult = ((distance / 1000) * 3000).toFixed(0);
                    biaya.innerHTML = formatter.format(biayaResult);
                    amount.value = biayaResult;
                }
            });
        });

        // change type kendaraan
        function changeInstructions(str) {
            if (str == "") {
                directions.on(error);
            } else if (str == "Mobil") {
                document.getElementById("mapbox-directions-profile-driving").click();
            } else if (str == "Motor") {
                document.getElementById("mapbox-directions-profile-walking").click();
            }
        }

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
