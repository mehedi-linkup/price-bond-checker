<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- <link rel="shortcut icon" href="{{ $content->logo }}" type="image/x-icon"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@100;200;300;400;500;600;700;800;900&family=Lato:wght@100;300;400;700;900&family=Roboto:wght@100;300;400;500;700;900&family=Work+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('website/assets/fontawesome-pro-5.15.1-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('website/assets/bootstrap-5.2.0/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('website/assets/css/viewbox.css') }}">
    <link rel="stylesheet" href="{{ asset('website/assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('website/style.css') }}" />
    <title>{{ $content->name }}</title>
    @stack('web-css')
</head>

<body>
 
    @include('layouts.partials.web_header')
    
    {{-- Main Section --}}
    @yield('web-content')
    
    {{-- Footer Partial --}}
    @include('layouts.partials.web_footer')
    {{-- End Footer Partial --}}

    <script src="{{ asset('website/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('website/assets/bootstrap-5.2.0/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('website/assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{asset('website/assets/js/bootstrap3-typeahead.min.js')}}" ></script>
    <script src="{{ asset('website/assets/js/jquery.viewbox.min.js') }}"></script>

    <script type="text/javascript">
        var baseUri = "{{ url('/') }}";
        $('.keyword').typeahead({
            minLength: 1,
            source: function (keyword, process) {
                return $.get(`${baseUri}/get_suggestions/${keyword}`, function (data) {
                    return process(data);
                });
            },
            updater:function (item) {
                $(location).attr('href', '/search?q='+item);
                return item;
            }
        });
    </script>
    
    <script>
        $(window).on('scroll', function() {
          if ($(window).scrollTop() > 80) {
              $('.scrolling-navbar').addClass('top-fixed');
          } else {
              $('.scrolling-navbar').removeClass('top-fixed');
          }
        });
    </script>
    <script>
        $('.img-link').viewbox();
    </script>
    <script>
        var $grid = $('.grid').isotope({});
        // filter items on button click
        $('.filter-button-group').on( 'click', 'button', function() {
            var filterValue = $(this).attr('data-filter');
            $grid.isotope({ filter: filterValue });
        });
    </script>
    @stack('web-js')
</body>

</html>