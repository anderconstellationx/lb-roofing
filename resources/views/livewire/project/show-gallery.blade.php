@extends('new-template.layouts.base')
@section('title', __('lang.gallery'))

@section('content')

    <!-- Page Header -->
    <div class="main-content-body main-content-body-contacts">
        <div class="main-contact-info-header pt-3">
            <div class="media">
                <div class="main-img-user">
                    <img alt="avatar" src="{{ asset('assets/img/logo/LB-Roofing-LLC.png') }}">
                </div>
                <div class="media-body">
                    <h2 class="main-content-title tx-24 mg-b-5">{{ $title }}</h2>
                    <address>{{ $address }}</address>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Header -->

    <!-- Row -->
    <div class="row sidemenu-height">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body" data-x="{{ $showGalleryComment }}">
                    @livewire('forms-nueva-galeria', ['id' => $id, 'showGalleryComment' => $showGalleryComment, 'gallery_items' => $gallery_items])
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->

@endsection
