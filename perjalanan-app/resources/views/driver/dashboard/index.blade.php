@extends('driver.layouts.main')

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

    <section class="section dashboard">
        <div class="alert alert-success" id="alertStatusDriver" style="display:none;">
            Driver status updated successfully!
        </div>
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                    <!-- Sales Card -->
                    <div class="col-xxl-6 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Kendaraan <span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-calculator-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <p>Jenis: {{ $driver->vehicle->vehicle_type }}</p>
                                        <p>Model: {{ $driver->vehicle->model }}</p>
                                        <p>Plat: {{ $driver->vehicle->plat }}</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Ride <span>| Total</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $total_ride }}</h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Ride <span>| Status</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-info"></i>
                                    </div>
                                    <div class="ps-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input form-check-label" type="checkbox"
                                                onclick="ubahStatus({{ $driver->user_id }})"
                                                {{ $driver->ride_status === 1 ? 'checked = ""' : '' }}>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Sales Card -->

                    </div>
                </div><!-- End Left side columns -->

            </div>
    </section>
    <script>
        function ubahStatus(id) {
            $.ajax({
                type: 'POST',
                url: '/driver/status/' + id,
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
