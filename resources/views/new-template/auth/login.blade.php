<!DOCTYPE html>
<html lang="es">
	<head>

		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
        <meta name="description" content="Sistema a medida para agencia de seguros">
        <meta name="author" content="YOUR BEST DEV EIRL">
        
        <!-- TITLE -->
        <title>{{ config('app.name', 'CRM') }}</title>

        <!-- FAVICON -->
        <link rel="icon" href="{{ asset('') }}assets/img/brand/favicon.ico">

        @include('new-template.layouts.components.style')
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        @yield('style')
    </head>

    <body class="ltr main-body leftmenu error-1">

        <!-- END SWITCHER -->
        
        <!-- LOADEAR -->
		<div id="global-loader">
			<img src="{{ asset('') }}assets/img/loader.svg" class="loader-img" alt="Loader">
		</div>
		<!-- END LOADEAR -->

        <!-- PAGE -->
        <div class="page main-signin-wrapper">

            <!-- END SIDEBAR -->

            <!-- Row -->
			<div class="text-center row signpages">
				{{ $slot }}
			</div>
			<!-- End Row -->


        </div>
        <!-- END PAGE -->

        <!-- SCRIPTS -->
        @include('new-template.layouts.components.script')
        @livewireScripts
        @yield('script')
        
        <!-- STICKY JS -->
		<script src="{{ asset('') }}assets/js/sticky.js"></script>

        <!-- COLOR THEME JS -->
        <script src="{{ asset('') }}assets/js/themeColors.js"></script>

        <!-- CUSTOM JS -->
        <script src="{{ asset('') }}assets/js/custom.js"></script>

        <!-- SWITCHER JS -->
        <script src="{{ asset('') }}assets/switcher/js/switcher.js"></script>

        <!-- END SCRIPTS -->

    </body>
</html>
