@extends('passenger.layouts.main')

@section('main')
    <div class="pagetitle">
        <h1>History Perjalanan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">History Perjalanan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">History</h5>
                        <p>Berikut Daftar History Perjalanan Anda </p>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Nama Driver</th>
                                    <th scope="col">Titik Jemput</th>
                                    <th scope="col">Titik Tujuan</th>
                                    <th scope="col">Biaya</th>
                                    <th scope="col">Jam</th>
                                    <!-- <th scope="col">Status</th> -->
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Brandon Jacob</td>
                                    <td>Jl. H aswan, Jakarta</td>
                                    <td>Jl. H Amir, Jakarta</td>
                                    <td>Rp.20.000</td>
                                    <td>2016-05-25, 19.50</td>
                                    <!-- <td>Dalam Perjalanan</td> -->
                                    <td><button type="submit" class="btn btn-primary" disabled> Lihat Ulasan</button></td>
                                </tr>
                                <tr>
                                    <!-- <th scope="row">2</th>
                        <td>Brandon Jacob</td>
                        <td>Jl. H aswan, Jakarta</td>
                        <td>Jl. H Amir, Jakarta</td>
                        <td>Rp.20.000</td>
                        <td>2016-05-25, 19.50</td>
                        <td>Dalam Perjalanan</td>
                        <td><button type="submit" class="btn btn-primary">Review</button></td>
                      </tr>
                      <tr>
                        <th scope="row">3</th>
                        <td>Brandon Jacob</td>
                        <td>Jl. H aswan, Jakarta</td>
                        <td>Jl. H Amir, Jakarta</td>
                        <td>Rp.20.000</td>
                        <td>2016-05-25, 19.50</td>
                        <td>Dalam Perjalanan</td>
                        <td><button type="submit" class="btn btn-primary">Review</button></td>
                      </tr>
                      <tr>
                        <th scope="row">4</th>
                        <td>Brandon Jacob</td>
                        <td>Jl. H aswan, Jakarta</td>
                        <td>Jl. H Amir, Jakarta</td>
                        <td>Rp.20.000</td>
                        <td>2016-05-25, 19.50</td>
                        <td>Dalam Perjalanan</td>
                        <td><button type="submit" class="btn btn-primary">Review</button></td>
                      </tr>
                      <tr>
                        <th scope="row">5</th>
                        <td>Brandon Jacob</td>
                        <td>Jl. H aswan, Jakarta</td>
                        <td>Jl. H Amir, Jakarta</td>
                        <td>Rp.20.000</td>
                        <td>2016-05-25, 19.50</td>
                        <td>Dalam Perjalanan</td>
                        <td><button type="submit" class="btn btn-primary">Review</button></td>
                      </tr> -->
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
