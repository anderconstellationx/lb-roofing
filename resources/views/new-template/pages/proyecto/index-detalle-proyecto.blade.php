@extends('new-template.layouts.base')
@section('title', __('lang.project.view_project'))

@section('content')
    @livewire('project.detalle', ['id' => $id])
@endsection
@push('script')
    <script>
        $(document).ready(function () {
            $(".nav-item").removeClass("active");
            $("a[href$='projects']").closest("li").addClass("active");
        });
    </script>
@endpush
