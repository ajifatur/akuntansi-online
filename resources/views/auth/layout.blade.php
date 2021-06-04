<!DOCTYPE html>
<html dir="ltr">

<head>
    <title>@yield('title') | {{ setting('site.name') }} &#8211; {{ setting('site.tagline') }}</title>
    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="{{ asset('templates/vali-admin/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}">
    <!-- Icon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/icon/'.setting('site.icon')) }}">
    <!-- Internal Stylesheets -->
    <style type="text/css">
        body{ background-color: var(--light)}
        .auth-wrapper {height: calc(100vh)!important;}
		#loginform img {max-width: 100%;}
        .input-group > .input-group-append:not(:last-child) > .input-group-text {border-top-right-radius: 2px; border-bottom-right-radius: 2px;}
        .btn-theme-1 {background-color: {{ setting('site.color.primary_dark') }}; color: #fff; transition: .25s ease}
        .btn-theme-1:hover {filter: saturate(0.5);}
        .rounded {border-radius: .25em!important}
        .rounded-1 {border-radius: .5em}
        .rounded-2 {border-radius: 1em}
        .form-group .fa {width: 16px;}
        .form-group .btn .fa {margin-right: 0;}
    </style>
    @yield('css-extra')
</head>

<body>

    @yield('content')

    <!-- JavaScript -->
    <script src="{{ asset('templates/vali-admin/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('templates/vali-admin/js/popper.min.js') }}"></script>
    <script src="{{ asset('templates/vali-admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('templates/vali-admin/js/plugins/pace.min.js') }}"></script>
    <script>
        // Button Toggle Password
        $(document).on("click", ".btn-toggle-password", function(e){
            e.preventDefault();
            if(!$(this).hasClass("show")){
                $(this).parents(".form-group").find("input[type=password]").attr("type","text");
                $(this).find(".fa").removeClass("fa-eye").addClass("fa-eye-slash");
                $(this).addClass("show");
            }
            else{
                $(this).parents(".form-group").find("input[type=text]").attr("type","password");
                $(this).find(".fa").removeClass("fa-eye-slash").addClass("fa-eye");
                $(this).removeClass("show");
            }
        });
    </script>

    @yield('js-extra')

</body>

</html>