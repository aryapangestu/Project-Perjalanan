@extends('admin.layouts.main')

@section('main')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href='/'>Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="alert alert-success" id="alertStatusDriver" style="display:none;">
            Penumpang status updated successfully!
        </div>
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">List Penumpang</h5>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nama Lengkap</th>
                                    <th scope="col">email</th>
                                    <th scope="col">Total Ride</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    @if ($user->role == 1)
                                        <tr>
                                            <th scope="row">{{ $user->id }}</th>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $rides->where('passenger_id', $user->id)->count() }}</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        onclick="ubahStatus({{ $user->id }})"
                                                        {{ $user->status === 1 ? 'checked = ""' : '' }}>
                                                </div>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary" data-bs-toggle="modal"
                                                    href="#modalview{{ $user->id }}" role="button">Detail</a>
                                                <!-- Modal -->
                                                <div class="modal fade" id="modalview{{ $user->id }}"
                                                    aria-hidden="true"
                                                    aria-labelledby="exampleModalLabel{{ $user->id }}" tabindex="-1">
                                                    <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="exampleModalLabel{{ $user->id }}">Info
                                                                    Pengemudi
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div>
                                                                    <table class="table table-bordered">
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
                                                                            @foreach ($rides->where('passenger_id', $user->id)->where('status', 1) as $history)
                                                                                <tr>
                                                                                    <td>
                                                                                        {{ $history->driver->user->name }}
                                                                                    </td>
                                                                                    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js"></script>
                                                                                    <link rel="stylesheet"
                                                                                        href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css"
                                                                                        type="text/css">
                                                                                    <td>
                                                                                        <button class="btn btn-primary"
                                                                                            data-bs-target="#rute{{ $history->id }}"
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-dismiss="modal">Rute</button>

                                                                                        <div class="modal fade"
                                                                                            id="rute{{ $history->id }}"
                                                                                            aria-hidden="true"
                                                                                            aria-labelledby="ruteLabel{{ $history->id }}"
                                                                                            tabindex="-1">
                                                                                            <div
                                                                                                class="modal-dialog modal-lg modal-dialog-centered">
                                                                                                <div class="modal-content">
                                                                                                    <div
                                                                                                        class="modal-header">
                                                                                                        <h5 class="modal-title"
                                                                                                            id="ruteLabel{{ $history->id }}">
                                                                                                            Rute</h5>
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="btn-close"
                                                                                                            data-bs-dismiss="modal"
                                                                                                            aria-label="Close"></button>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="modal-body">
                                                                                                        <div class="mapNew"
                                                                                                            id="mapNew{{ $history->id }}">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td id='durasi{{ $history->id }}'>
                                                                                    </td>
                                                                                    <td id='jarak{{ $history->id }}'>
                                                                                    </td>
                                                                                    <td id='biaya{{ $history->id }}'>
                                                                                    </td>
                                                                                    <td>
                                                                                        @if ($history->review_id != null)
                                                                                            <div
                                                                                                class="d-flex align-items-start flex-column">
                                                                                                <div>
                                                                                                    <label>
                                                                                                        @for ($i = 0; $i < $history->review->rate; $i++)
                                                                                                            <span
                                                                                                                class="icon"
                                                                                                                style="color:darkorange">★</span>
                                                                                                        @endfor
                                                                                                        @for ($i = 0; $i < 5 - $history->review->rate; $i++)
                                                                                                            <span
                                                                                                                class="icon">★</span>
                                                                                                        @endfor
                                                                                                    </label>
                                                                                                </div>
                                                                                                <div>
                                                                                                    <span
                                                                                                        class="text-muted small pt-2 ps-1">{{ $history->review->review }}
                                                                                                    </span>
                                                                                                </div>
                                                                                            </div>
                                                                                        @else
                                                                                            <div>
                                                                                                <span
                                                                                                    class="text-danger small pt-2 ps-1">Ulasan
                                                                                                    belum
                                                                                                    dimasukkan
                                                                                                    penumpang
                                                                                                </span>
                                                                                            </div>
                                                                                        @endif
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
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function ubahStatus(id) {
            $.ajax({
                type: 'POST',
                url: '/list-penumpang/status/' + id,
                data: {
                    user_id: id
                },
                success: function() {
                    $('#alertStatusDriver').fadeOut();
                    $('#alertStatusDriver').fadeIn();
                    setTimeout(function() {
                        $('#alertStatusDrivers').fadeOut();
                    }, 5000);
                }
            });
        }
    </script>
@endsection
