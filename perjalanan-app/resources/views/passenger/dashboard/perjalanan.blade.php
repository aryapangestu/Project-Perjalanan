@extends('passenger.layouts.main')

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
    @if ($ride != null)
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            @if ($ride->status == '0')
                                <h5 class="card-title">Perjalanan</h5>
                                <!-- General Form Elements -->
                                <form>
                                    <div class="row mb-3">
                                        <div class="col-sm-2 label ">Nama Driver</div>
                                        <div class="col-sm-10" id='driver'>
                                            {{ $ride->driver_id == null ? 'Sedang mencari driver' : $ride->driver->user->name }}
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

                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-warning btn-primary"
                                                {{ $ride->driver_id == null ? 'disabled' : '' }}>Selesai</button>
                                        </div>
                                    </div>

                                </form><!-- End General Form Elements -->
                            @elseif ($ride->status == '1')
                                <div class="container">

                                    <section
                                        class="section min-vh-100 d-flex flex-column align-items-center justify-content-center">
                                        <h1>Anda belum melakukan pemesanan perjalanan</h1>
                                        <h3>Pesan terlebih dahulu perjalanan Anda</h3>
                                        <img src="https://cdn-icons-png.flaticon.com/512/868/868680.png"
                                            class="img-fluid py-5" alt="Page Not Found">
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
            var ride = {!! json_encode($ride->toArray()) !!};

            const durasi = document.getElementById('durasi');
            const jarak = document.getElementById('jarak');
            const biaya = document.getElementById('biaya');

            mapboxgl.accessToken = 'pk.eyJ1IjoiYXJ5YXAyIiwiYSI6ImNsMXU1MmJ3NjJpemQzcXVrNnQ3cDFibmEifQ.WtmVOqIR6MWhE9HNjQpPkw';
            const map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/streets-v11',
                center: [107.60340, -6.93487],
                zoom: 12,
                setOrigin: [106.80000000, -6.16667000],
                setDestination: [107.60340, -6.93487],
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
                directions.setOrigin([106.80000000, -6.16667000]);
                directions.setDestination([107.56667000, -6.95000000]);
                directions.on('route', (event) => {
                    seconds = event.route[0].duration;
                    distance = event.route[0].distance;

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
                    if (ride.vehicle_type == 'Mobil') {
                        // Mobil 10000/KM
                        biayaResult = ((distance / 1000) * 10000).toFixed(0);
                        biaya.innerHTML = formatter.format(biayaResult);
                    } else if (ride.vehicle_type == 'Motor') {
                        // Motor 3000/KM
                        biayaResult = ((distance / 1000) * 3000).toFixed(0);
                        biaya.innerHTML = formatter.format(biayaResult);
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
    @else
        <div class="container">

            <section class="section min-vh-100 d-flex flex-column align-items-center justify-content-center">
                <h1>Anda belum melakukan pemesanan perjalanan</h1>
                <h3>Pesan terlebih dahulu perjalanan Anda</h3>
                <img src="https://cdn-icons-png.flaticon.com/512/868/868680.png" class="img-fluid py-5"
                    alt="Page Not Found">
            </section>

        </div>
    @endif
@endsection
