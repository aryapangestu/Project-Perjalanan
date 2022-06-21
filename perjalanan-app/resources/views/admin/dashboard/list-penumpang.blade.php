@extends('admin.layouts.main')

@section('main')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href='/'>Home</a></li>
                <li class="breadcrumb-item active">Data Penumpang</li>
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
                                                <a href="/list-penumpang/detail/{{ $user->id }}" class="btn btn-info"
                                                    style="margin-right:2px">View</a>
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
