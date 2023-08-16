<!DOCTYPE html>
<html lang="en">
    <style type="text/css">
        .center {
              display: block;
              margin-left: auto;
              margin-right: auto;
              width: 50%;
            }
    </style>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Register</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('adminassets') }}/assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="{{ asset('adminassets') }}/assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="{{ asset('adminassets') }}/assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="{{ asset('adminassets') }}/assets/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row flex-grow">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo">
                <img src="{{ asset('adminassets') }}/assets/images/logo_13.svg" class="center">
              </div>
              <h4>Baru Disini?</h4>
              <h6 class="font-weight-light">Daftar dengan mudah. Hanya butuh beberapa langkah</h6>
              <form class="pt-3" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nama">

                  @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror


                </div>
                <div class="form-group">
                  <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat') }}" required autocomplete="alamat" autofocus placeholder="Alamat">

                  @error('alamat')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror


                </div>
                <div class="form-group">
                  <input id="nomor_hp" type="number" class="form-control @error('nomor_hp') is-invalid @enderror" name="nomor_hp" value="{{ old('nomor_hp') }}" required autocomplete="nomor_hp" autofocus placeholder="Nomor Hp" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "13">

                  @error('alamat')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror


                </div>
                <div class="form-group">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

                  @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">

                  @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group">
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi Password">

                  <label for="jaminan" class=" col-form-label text-md-right">{{ __('Jaminan') }}</label>
                  <input id="jaminan" type="file" name="jaminan">
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">Daftar</button>
                </div>
                <div class="text-center mt-4 font-weight-light"> Sudah Memiliki Akun? <a href="{{ route('login') }}" class="text-primary">Login</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ asset('adminassets') }}/assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('adminassets') }}/assets/js/off-canvas.js"></script>
  <script src="{{ asset('adminassets') }}/assets/js/hoverable-collapse.js"></script>
  <script src="{{ asset('adminassets') }}/assets/js/misc.js"></script>
  <!-- endinject -->
</body>

</html>