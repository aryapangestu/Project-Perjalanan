@extends('passenger.layouts.main')

@section('main')
    <div class="pagetitle">
        <h1>Riwayat Perjalanan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href='/'>Home</a></li>
                <li class="breadcrumb-item active">Riwayat Perjalanan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Riwayat</h5>
                        <p>Berikut Daftar Riwayat Perjalanan Anda </p>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">Nama driver</th>
                                    <th scope="col">Rute</th>
                                    <th scope="col">Durasi</th>
                                    <th scope="col">Jarak</th>
                                    <th scope="col">Biaya</th>
                                    <th scope="col">Ulasan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($histories as $history)
                                    <tr>
                                        <td>{{ $history->driver->user->name }}</td>
                                        <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js"></script>
                                        <link rel="stylesheet"
                                            href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css"
                                            type="text/css">
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#modalview{{ $history->id }}">
                                                View
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="modalview{{ $history->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Rute
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mapNew" id="mapNew{{ $history->id }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td id='durasi{{ $history->id }}'></td>
                                        <td id='jarak{{ $history->id }}'></td>
                                        <td id='biaya{{ $history->id }}'></td>
                                        <td>
                                            @if ($history->review_id == null)
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#ulasan{{ $history->id }}">
                                                    Ulasan
                                                </button>
                                                <div class="modal fade" id="ulasan{{ $history->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Masukkan
                                                                    ulasan
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="/passenger/history/{{ $history->id }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <div class="mb-3">
                                                                        <div><label for="recipient-name"
                                                                                class="col-form-label">Rating:</label></div>

                                                                        <div class="rating">
                                                                            <label>
                                                                                <input type="radio" name="rate" value="1" />
                                                                                <span class="icon">★</span>
                                                                            </label>
                                                                            <label>
                                                                                <input type="radio" name="rate" value="2" />
                                                                                <span class="icon">★</span>
                                                                                <span class="icon">★</span>
                                                                            </label>
                                                                            <label>
                                                                                <input type="radio" name="rate" value="3" />
                                                                                <span class="icon">★</span>
                                                                                <span class="icon">★</span>
                                                                                <span class="icon">★</span>
                                                                            </label>
                                                                            <label>
                                                                                <input type="radio" name="rate" value="4" />
                                                                                <span class="icon">★</span>
                                                                                <span class="icon">★</span>
                                                                                <span class="icon">★</span>
                                                                                <span class="icon">★</span>
                                                                            </label>
                                                                            <label>
                                                                                <input type="radio" name="rate" value="5" />
                                                                                <span class="icon">★</span>
                                                                                <span class="icon">★</span>
                                                                                <span class="icon">★</span>
                                                                                <span class="icon">★</span>
                                                                                <span class="icon">★</span>
                                                                            </label>
                                                                            @error('rate')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="message-text"
                                                                            class="col-form-label">Ulasan:</label>
                                                                        <textarea class="form-control @error('review') is-invalid @enderror" style="height: 100px" name="review" required>{{ old('review') }}</textarea>
                                                                        @error('review')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Tutup</button>
                                                                        <button type="submit" class="btn btn-primary">Kirim
                                                                            ulasan</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="d-flex align-items-start flex-column">
                                                    <div>
                                                        <label>
                                                            @for ($i = 0; $i < $history->review->rate; $i++)
                                                                <span class="icon"
                                                                    style="color:darkorange">★</span>
                                                            @endfor
                                                            @for ($i = 0; $i < 5 - $history->review->rate; $i++)
                                                                <span class="icon">★</span>
                                                            @endfor
                                                        </label>
                                                    </div>
                                                    <div>
                                                        <span
                                                            class="text-muted small pt-2 ps-1">{{ $history->review->review }}
                                                        </span>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                        </td>
                                    </tr>
                                    <script>
                                        // format int ke currency indonesia
                                        var formatter = new Intl.NumberFormat('id-ID', {
                                            style: 'currency',
                                            currency: 'IDR',
                                        });
                                        var ride = {!! json_encode($history->toArray()) !!};

                                        biaya = document.getElementById('biaya' + ride.id.toString());
                                        jarak = document.getElementById('jarak' + ride.id.toString());
                                        durasi = document.getElementById('durasi' + ride.id.toString());
                                        biaya.innerHTML = formatter.format(ride.amount);

                                        mapboxgl.accessToken = 'pk.eyJ1IjoiYXJ5YXAyIiwiYSI6ImNsMXU1MmJ3NjJpemQzcXVrNnQ3cDFibmEifQ.WtmVOqIR6MWhE9HNjQpPkw';
                                        map = new mapboxgl.Map({
                                            container: 'mapNew' + ride.id.toString(),
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
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
