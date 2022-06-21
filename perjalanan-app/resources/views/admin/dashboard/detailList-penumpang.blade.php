@extends('admin.layouts.main')

@section('main')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href='/'>Home</a></li>
                <li class="breadcrumb-item active"><a href='/list-penumpang'>Data Penumpang</a></li>
                <li class="breadcrumb-item active">Detail</li>
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

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Nama driver</th>
                                    <th scope="col">Rute</th>
                                    <th scope="col">Biaya</th>
                                    <th scope="col">Ulasan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rides as $history)
                                    <tr>
                                        <td>
                                            {{ $history->driver->user->name }}
                                        </td>
                                        <td>
                                            <a href="/list-penumpang/detail/view/{{ $history->id }}" class="btn btn-info"
                                                style="margin-right:2px">View</a>
                                        </td>
                                        <td id='biaya{{ $history->id }}'>
                                        </td>
                                        <td>
                                            @if ($history->review_id != null)
                                                <div class="d-flex align-items-start flex-column">
                                                    <div>
                                                        <label>
                                                            @for ($i = 0; $i < $history->review->rate; $i++)
                                                                <span class="icon" style="color:darkorange">★</span>
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
                                            @else
                                                <div>
                                                    <span class="text-danger small pt-2 ps-1">Ulasan
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
                                        biaya.innerHTML = formatter.format(ride.amount);
                                    </script>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
