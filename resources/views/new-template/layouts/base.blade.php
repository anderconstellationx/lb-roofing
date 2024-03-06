<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1" />
    <meta name="description" content="Sistema a medida para agencia de seguros.">
    <meta name="author" content="YOUR BEST DEV EIRL">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('head')

    <!-- TITLE -->
    <title> @yield('title') | {{ config('app.name', 'CRM') }}</title>

    <!-- FAVICON -->
    <link rel="icon" href="{{ asset('') }}assets/img/brand/favicon.ico">

    @include('new-template.layouts.components.style')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('style')

    <meta name="theme-color" content="#02010100">
    <link rel="icon" href="{{ asset('assets/icon/cropped-ICONO-32x32.png') }}" sizes="32x32" />
    <link rel="icon" href="{{ asset('public/assets/icon/cropped-ICONO-192x192.png') }}" sizes="192x192" />
    <link rel="apple-touch-icon" href="{{ asset('assets/icon/cropped-ICONO-180x180.png') }}" />
    <meta name="msapplication-TileImage" content="{{ asset('assets/icon/cropped-ICONO-270x270.png') }}" />
</head>

<body class="ltr main-body leftmenu">

<!-- SWITCHER -->
@include('new-template.layouts.components.switcher')

<!-- END SWITCHER -->

<!-- LOADEAR -->
<div id="global-loader">
    <img src="{{ asset('') }}assets/img/loader.svg" class="loader-img" alt="Loader">
</div>
<!-- END LOADEAR -->

<!-- PAGE -->
<div class="page">

    <!-- HEADER -->
    @includeWhen($showHeader, 'new-template.layouts.components.header')

    <!-- END HEADER -->

    <!-- SIDEBAR -->
    @includeWhen($showSidebar, 'new-template.layouts.components.sidebard')

    <!-- END SIDEBAR -->

    <!-- MAIN-CONTENT -->
    <div class="main-content {{ $showSidebar ? 'side-content' : '' }}  pt-0">
        <div class="main-container {{ $containerLayout }}">
            <div class="inner-body">

                @yield('content')

            </div>
        </div>
    </div>
    <!-- END MAIN-CONTENT -->

    <!-- RIGHT-SIDEBAR -->
    @include('new-template.layouts.components.rigth-sidebar')

    <!-- END RIGHT-SIDEBAR -->

    <!-- FOOTER -->
    @include('new-template.layouts.components.footer')

    <!-- END FOOTER -->
    @stack('modals')
</div>
<!-- END PAGE -->

<!-- SCRIPTS -->
@include('new-template.layouts.components.script')

@livewireScripts

<!--CKEDITOR 5 -->
 <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>php

<!-- STICKY JS -->
<script src="{{ asset('') }}assets/js/sticky.js"></script>

<!-- COLOR THEME JS -->
<script src="{{ asset('') }}assets/js/themeColors.js"></script>

<!-- CUSTOM JS -->
<script src="{{ asset('') }}assets/js/custom.js"></script>

<!-- SWITCHER JS -->
<script src="{{ asset('') }}assets/switcher/js/switcher.js"></script>

<script src="{{ asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>

<script>
    function datetimeLocalInput(date) {
        return date.getFullYear() + `-` +
            (`0` + (date.getMonth() + 1)).slice(-2) + `-` +
            (`0` + date.getDate()).slice(-2) + `T` +
            (`0` + date.getHours()).slice(-2) + `:` +
            (`0` + date.getMinutes()).slice(-2);
    }

    function copyToClipboard(text) {
        const textarea = document.createElement('textarea');
        textarea.value = text;
        document.body.appendChild(textarea);
        textarea.select();
        navigator.clipboard.writeText(textarea.value);
        document.body.removeChild(textarea);
    }

    const copyClipboard = new ClipboardJS('.copy-clipboard');
    copyClipboard.on('success', function(e) {
        window.globalToast('{{ __('lang.copied') }}');
    });

</script>

@if (session('global-session-response-alert'))
    <script>
        // when is new quote
        Swal.fire({
            title: '{{ session('global-session-response-alert')['title'] }}',
            text: '{{ session('global-session-response-alert')['text'] }}',
            icon: '{{ session('global-session-response-alert')['icon'] }}'
        });
    </script>
@endif

<script>
    {{-- evento global --}}
    document.addEventListener('livewire:init', () => {
        Livewire.on('global-dispatch-sweet-alert', (event) => {
            Swal.fire({
                title: event.title,
                text: event.text,
                icon: event.icon,
            });
        });

        Livewire.on('global-dispatch-modal', (event) => {
            const globalModal = $('#' + event.modal)
            if (globalModal.length) {
                globalModal.modal(event.action)
            }
        });

        Livewire.on('global-toast-message', (event) => {
            window.globalToast(event.text, event.destination);
        });

        window.globalToast = function(text, destination = '#', color = 'success') {
            if (destination !== '#') {
                copyToClipboard(destination)
            }
            const background = {
                success: 'var(--primary-bg-color)',
                error: '#f16d75',
                warning: '#ff9b21',
                info: '#01b8ff',
            }
            Toastify({
                text: text,
                duration: 3000,
                destination: destination,
                newWindow: true,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: background[color],
                },
                onClick: function(){} // Callback after click
            }).showToast();
        }



    });
</script>

@stack('script')
<!-- END SCRIPTS -->

</body>

</html>
