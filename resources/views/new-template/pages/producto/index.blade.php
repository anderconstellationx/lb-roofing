@extends('new-template.layouts.base')
@section('title', __('lang.product.products'))
@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">{{ __('lang.product.product_list') }}</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route("dashboard")}}">{{ __('lang.home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('lang.product.products') }}</li>
            </ol>
        </div>
        <div class="d-flex">
            <div class="justify-content-center">
                <button type="button" class="btn btn-primary my-2 me-2" data-bs-toggle="modal"
                        data-bs-target="#modal-new-product"><i class="fa-solid fa-plus"></i> {{ __('lang.add') }}
                </button>
                <button type="button" class="btn btn-primary my-2 me-2" data-bs-toggle="modal"
                        data-bs-target="#status" hidden><i class="fa-solid fa-plus"></i> {{ __('lang.add_state') }}
                </button>
                <button type="button" class="btn btn-primary my-2 me-2" data-bs-toggle="modal"
                        data-bs-target="#modal-import-products-excel"><i class="fas fa-file-import"></i> {{ __('lang.import_excel') }}
                </button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <livewire:producto-table/>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('modals')
    <div class="modal fade" id="status" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ __('lang.product.product_status') }}</h5>
                    <button type="button" class="btn-close dark-mode" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <livewire:forms-estado-producto-nuevo/>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para crear productos -->
    <div class="modal fade" id="modal-new-product" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ __('lang.product.create_product') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <livewire:forms-nuevo-producto/>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal to import products -->
    <div class="modal fade" id="modal-import-products-excel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('lang.import_excel') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <form id="form-file-excel" method="post" action="">
                        @csrf
                        <div class="row row-sm">
                            <div>
                                <div class="form-group">
                                    <label for="file-excel" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.file') }}</label>
                                    <input type="file" id="file-excel" name="file-excel" accept=".xls, .xlsx" class="form-control">
                                </div>
                                <div class="form-group">
                                    <a href="{{ asset('assets/template-excel/import-products.xlsx') }}" target="_blank">
                                        <button type="button" class="btn"><i class="fa fa-download"></i> {{ __('lang.download_example') }}</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="mt-3">
                            <div class="mt-3">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-close"></i> {{ __('lang.cancel') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endpush
@push('script')
    {{-- Upload file --}}
    <script type="text/javascript" src="{{ asset('') }}assets/plugins/fancyuploder/jquery.ui.widget.js"></script>
    <script type="text/javascript" src="{{ asset('') }}assets/plugins/fancyuploder/jquery.fileupload.js"></script>
    <script type="text/javascript" src="{{ asset('') }}assets/plugins/fancyuploder/jquery.iframe-transport.js"></script>
    <script type="text/javascript" src="{{ asset('') }}assets/plugins/fancyuploder/jquery.fancy-fileupload.js"></script>

    <script>
        const uploadFileGallery = $('#file-excel')
        uploadFileGallery.FancyFileUpload({
            url: '{{ route('products-upload-file') }}',
            edit: false,
            params: {
                _token: $('#form-file-excel').find('input[name="_token"]').first().val(),
            },
            maxfilesize: 10485760,
            added: function (e, data) {
                // It is okay to simulate clicking the start upload button.
                //this.find('.ff_fileupload_actions button.ff_fileupload_start_upload').click();
            },
            uploadcompleted: function (e, data) {
                $('.ff_fileupload_actions').remove()
            },
            langmap: {
                'Upload completed': '{{ __('lang.upload_completed') }}',
                'Invalid file extension.': '{{ __('lang.invalid_file_extension') }}',
                'The upload failed.  {0} ({1})': '{{ __('lang.upload_file_gallery_failed') }}',
                'File is too large.  Maximum file size is {0}.': '{{ __('lang.file_is_too_large', ['size' => \App\Models\GaleriaProyecto::getDisplayFilesize(10485760)]) }}'
            },
        });
    </script>
@endpush
