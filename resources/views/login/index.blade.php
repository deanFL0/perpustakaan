<head>
    <title>
        Login
    </title>

    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon') }}/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon') }}/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon') }}/favicon-16x16.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous">
    </script>
</head>
<section class="vh-100">
    @if (session()->has('success'))
        <div class="alert alert-success text-center" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger text-center" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <div class="container py-5 h-100">
        <div class="row d-flex align-items-center justify-content-center h-100">
            <div class="col-md-8 col-lg-7 col-xl-6">
                <img src="{{ asset('adminlte')}}/dist/img/login.png"
                    class="img-fluid" alt="Phone image">
            </div>
            <div class="col-md-7 col-lg-5 col-xl-5">

                <form method="POST" action="/login">
                    @csrf
                    <!-- Username input -->
                    <div class="form-floating mb-4">
                        <input type="text" class="form-control form-control-lg" name="username" id="username" placeholder="Username"
                            autofocus required>
                        <label for="username">Username</label>
                    </div>

                    <!-- Password input -->
                    <div class="form-floating mb-4">
                        <input type="password" class="form-control form-control-lg" name="password" id="password"
                            placeholder="Password" required>
                        <label for="password">Password</label>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Log in</button>
                </form>
            </div>
        </div>
    </div>
</section>
