<!DOCTYPE html>
<html lang="en">
@include('layouts.partials.head')
<body class="c-app">
    @include('layouts.partials.sidebar')
    <div class="c-wrapper c-fixed-components">
      @include('layouts.partials.navbar')

      <div class="c-body">
        <main class="c-main">
          <div class="container-fluid">
            <div class="fade-in">
              {{-- start card --}}
              <div class="card">
                <div class="card-body">
                  {{-- start card content --}}
                  {{-- <h4>Your Content Here</h4> --}}
                  @yield('content')
                  {{-- end card content --}}
                </div>
              </div>
              {{-- end card --}}
            </div>
          </div>
        </main>
        @include('layouts.partials.footer')
      </div>

      
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('core-ui/vendors/@coreui/coreui/js/coreui.bundle.min.js') }}"></script>
    <!--[if IE]><!-->
    <script src="vendors/@coreui/icons/js/svgxuse.min.js"></script>
    <!--<![endif]-->
    <!-- Plugins and scripts required by this view-->
    <script src="vendors/@coreui/chartjs/js/coreui-chartjs.bundle.js"></script>
    <script src="vendors/@coreui/utils/js/coreui-utils.js"></script>
    <script src="{{ asset('core-ui/js/main.js') }}"></script>

    <!-- extra js -->
    @stack('extra-scripts')

  </body>
</html>