@extends('driver.layouts.main')

@section('main')
    <div class="pagetitle">
        <h1>History</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index-driver.html">Home</a>
                </li>
                <li class="breadcrumb-item active">History</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">History Data Driver</h5>
                        <p>Berikut adalah data history anda</p>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Penumpang</th>
                                    <th scope="col">Jemput</th>
                                    <th scope="col">Tujuan</th>
                                    <th scope="col">Biaya</th>
                                    <th scope="col">Jam</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <button type="submit" class="btn btn-warning btn-primary">
                                            Lihat Ulasan
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <button type="submit" class="btn btn-warning btn-primary">
                                            Lihat Ulasan
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <button type="submit" class="btn btn-warning btn-primary">
                                            Lihat Ulasan
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">4</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <button type="submit" class="btn btn-warning btn-primary">
                                            Lihat Ulasan
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">5</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <button type="submit" class="btn btn-warning btn-primary">
                                            Lihat Ulasan
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
