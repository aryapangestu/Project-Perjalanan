<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Pages / Login - Perjalanan Admin Panel</title>

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" />

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
    <main>
        <div class="container">
            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/logo.png" alt="" />
                                    <span class="d-none d-lg-block">Perjalanan</span>
                                </a>
                            </div>
                            <!-- End Logo -->
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                                        <p class="text-center small">Enter your personal details to create account</p>
                                    </div>
                                    <ul class="nav nav-tabs nav-tabs-bordered">
                                        <li class="nav-item"> <button class="nav-link active" data-bs-toggle="tab"
                                                data-bs-target="#register-Penumpang">Penumpang</button></li>
                                        <li class="nav-item"> <button class="nav-link" data-bs-toggle="tab"
                                                data-bs-target="#register-driver">Driver</button></li>
                                    </ul>
                                    <div class="tab-content pt-2">
                                        <div class="tab-pane fade profile-overview active show" id="register-Penumpang">
                                            <form action="/register/passenger" method="post"
                                                class="row g-3 needs-validation" novalidate>
                                                @csrf
                                                <div class="col-12">
                                                    <label for="yourName" class="form-label">Your Name</label>
                                                    <input type="text" name="name"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        id="yourName" required value="{{ old('name') }}">
                                                    @error('name')
                                                        <div class="invalid-feedback">Please, enter your name!</div>
                                                    @enderror
                                                </div>

                                                <div class="col-12">
                                                    <label for="yourEmail" class="form-label">Your Email</label>
                                                    <input type="email" name="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        id="yourEmail" required value="{{ old('email') }}">
                                                    @error('email')
                                                        <div class="invalid-feedback">Please enter a valid Email adddress!
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="col-12">
                                                    <label for="yourPassword" class="form-label">Password</label>
                                                    <input type="password" name="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        id="yourPassword" required value="{{ old('password') }}">
                                                    @error('password')
                                                        <div class="invalid-feedback">Please enter your password!</div>
                                                    @enderror
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-check">
                                                        <input
                                                            class="form-check-input @error('terms') is-invalid @enderror"
                                                            name="terms" type="checkbox" value="1" id="acceptTerms"
                                                            required value="{{ old('terms') }}">
                                                        <label class="form-check-label" for="acceptTerms">I agree and
                                                            accept
                                                            the
                                                            <a href="#">terms and conditions</a></label>
                                                        @error('terms')
                                                            <div class="invalid-feedback">You must agree before submitting.
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button class="btn btn-primary w-100" type="submit">Create
                                                        Account</button>
                                                </div>
                                                <div class="col-12">
                                                    <p class="small mb-0">Already have an account? <a
                                                            href="/login">Log
                                                            in</a></p>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade register-driver pt-3" id="register-driver">
                                            <form action="/register/driver" method="post"
                                                class="row g-3 needs-validation" novalidate>
                                                @csrf
                                                <div class="col-12">
                                                    <label for="yourName" class="form-label">Your Name</label>
                                                    <input type="text" name="name"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        id="yourName" required value="{{ old('name') }}">
                                                    @error('name')
                                                        <div class="invalid-feedback">Please, enter your name!</div>
                                                    @enderror
                                                </div>

                                                <div class="col-12">
                                                    <label for="yourEmail" class="form-label">Your Email</label>
                                                    <input type="email" name="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        id="yourEmail" required value="{{ old('email') }}">
                                                    @error('email')
                                                        <div class="invalid-feedback">Please enter a valid Email adddress!
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="col-12">
                                                    <label for="yourPassword" class="form-label">Password</label>
                                                    <input type="password" name="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        id="yourPassword" required value="{{ old('password') }}">
                                                    @error('password')
                                                        <div class="invalid-feedback">Please enter your password!</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12">
                                                    <label for="yourVehicle_type">Pilih jenis kendaraan</label>
                                                    <select
                                                        class="form-select @error('vehicle_type') is-invalid @enderror"
                                                        aria-label="Default select example" name="vehicle_type"
                                                        required>
                                                        <option
                                                            {{ old('vehicle_type') === 'Mobil' ? 'selected=""' : '' }}
                                                            value="Mobil">Mobil</option>
                                                        <option
                                                            {{ old('vehicle_type') === 'Motor' ? 'selected=""' : '' }}
                                                            value="Motor">Motor</option>
                                                        @error('vehicle_type')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </select>
                                                </div>

                                                <div class="col-12">
                                                    <label for="yourModel" class="form-label">Model
                                                        kendaraan</label>
                                                    <input type="text" name="model"
                                                        class="form-control @error('model') is-invalid @enderror"
                                                        id="yourModel" required value="{{ old('model') }}">
                                                    @error('model')
                                                        <div class="invalid-feedback">Please, enter your model!</div>
                                                    @enderror
                                                </div>

                                                <div class="col-12">
                                                    <label for="yourPlat" class="form-label">Plat kendaraan</label>
                                                    <input type="text" name="plat"
                                                        class="form-control @error('plat') is-invalid @enderror"
                                                        id="yourPlat" required value="{{ old('plat') }}">
                                                    @error('plat')
                                                        <div class="invalid-feedback">Please, enter your plat!</div>
                                                    @enderror
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-check">
                                                        <input
                                                            class="form-check-input @error('terms') is-invalid @enderror"
                                                            name="terms" type="checkbox" value="1" id="acceptTerms"
                                                            required value="{{ old('terms') }}">
                                                        <label class="form-check-label" for="acceptTerms">I agree and
                                                            accept
                                                            the
                                                            <a href="#">terms and conditions</a></label>
                                                        @error('terms')
                                                            <div class="invalid-feedback">You must agree before submitting.
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button class="btn btn-primary w-100" type="submit">Create
                                                        Account</button>
                                                </div>
                                                <div class="col-12">
                                                    <p class="small mb-0">Already have an account? <a
                                                            href="/login">Log
                                                            in</a></p>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <!-- Vendor JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
</body>

</html>
