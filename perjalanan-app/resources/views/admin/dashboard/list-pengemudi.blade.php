@extends('admin.layouts.main')

@section('main')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="alert alert-success" id="alertStatusDriver" style="display:none;">
            Pengemudi status updated successfully!
        </div>
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">List Pengemudi</h5>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nama Lengkap</th>
                                    <th scope="col">email</th>
                                    <th scope="col">Jenis Kendaraan</th>
                                    <th scope="col">Total Ride</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            @foreach ($users as $user)
                                @if ($user->role == 2)
                                    <tr>
                                        <th scope="row">{{ $user->id }}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->driver->vehicle->vehicle_type }}</td>
                                        <td>{{ $rides->where('driver_id', $user->id)->count() }}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    onclick="ubahStatus({{ $user->id }})"
                                                    {{ $user->status === 1 ? 'checked = ""' : '' }}>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#modalview{{ $user->id }}">
                                                View
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="modalview{{ $user->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Info Pengemudi
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div>

                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">Nama passenger</th>
                                                                            <th scope="col">Rute</th>
                                                                            <th scope="col">Durasi</th>
                                                                            <th scope="col">Jarak</th>
                                                                            <th scope="col">Biaya</th>
                                                                            <th scope="col">Ulasan</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                            @foreach ($rides->where('driver_id', $user->id)->where('status', 1) as $history)
                                                                                <tr>
                                                                                    <td>{{ $history->passenger->user->name }}</td>
                                                                                    <td>{{ $history->passenger->user->name }}</td>
                                                                                    <td>Natto</td>
                                                                                    <td>@samso</td>
                                                                                    <td>Natto</td>
                                                                                    <td>Natto</td>
                                                                                </tr>
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
                url: '/list-pengemudi/status/' + id,
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
