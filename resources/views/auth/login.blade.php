@include('layouts.partials.head')
<body class="c-app flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card-group">
            <div class="card p-4">
              <div class="card-body">

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <h1>Login</h1>
                    <p class="text-muted">Sign In to your account</p>

                    {{-- Email Input --}}
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <svg class="c-icon">
                                    <use xlink:href="{{ asset('core-ui/vendors/@coreui/icons/svg/free.svg#cil-user') }}"></use>
                                </svg>
                            </span>
                        </div>
                        <input class="form-control" type="text" placeholder="Email" name="email" value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    {{-- Password Input --}}
                    <div class="input-group mt-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <svg class="c-icon">
                                    <use xlink:href="{{ asset('core-ui/vendors/@coreui/icons/svg/free.svg#cil-lock-locked') }}"></use>
                                </svg>
                            </span>
                        </div>
                        <input class="form-control" type="password" placeholder="Password" name="password">
                    </div>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    
                    <div class="row">
                    <div class="col-6 mt-4">
                        <button type="submit" class="btn btn-primary px-4">Login</button>
                    </div>
                    </div>
                </form>

              </div>
            </div>
            <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
              <div class="card-body text-center">
                <h2>Food Ordering</h2>
                <h2>System</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('core-ui/vendors/@coreui/coreui/js/coreui.bundle.min.js') }}"></script>
    <!--[if IE]><!-->
    <script src="{{ asset('core-ui/vendors/@coreui/icons/js/svgxuse.min.js') }}"></script>
    <!--<![endif]-->
  </body>
</html>