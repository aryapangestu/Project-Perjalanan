@extends('passenger.layouts.main')

@section('main')
    <div class="pagetitle">
        <h1>Pemesanan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Pemesanan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Pemesanan</h5>

                        <!-- General Form Elements -->
                        <form action="/passenger/pemesanan/store" method="POST">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Pilih Kendaraan</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example" id="typeRide"
                                        onchange="changeInstructions(this.value)">
                                        <option selected>Ride Type</option>
                                        <option value="1">Mobil</option>
                                        <option value="2">Motor</option>
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Titik Jemput</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Titik Tujuan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control">
                                </div>
                            </div> --}}
                            <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js"></script>
                            <link rel="stylesheet"
                                href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css"
                                type="text/css">

                            <div class="row mb-3">
                                <label for="inputMap" class="col-sm-2 col-form-label">Pilih Map</label>
                                <div class="col-sm-10" id="map">
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Submit Button</label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->

                    </div>
                </div>

            </div>

            </form><!-- End General Form Elements -->

        </div>
        </div>

        </div>
        </div>
    </section>
@endsection
