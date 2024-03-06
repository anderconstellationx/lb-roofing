<div>
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">{{ __('lang.project.project') }}</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="fa-solid fa-angle-left"></i>
                    <a href="{{route("projects")}}"> {{__('lang.back')}}</a>
                </li>
            </ol>
        </div>
    </div>
    <div class="row mg-b-20 rounded-20">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @livewire('forms-editar-proyecto', ['id' => $id])
                </div>
            </div>
            <div class="card mg-t-20">
                <div class="card-header pd-20">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <h2>{{ __('lang.gallery') }}</h2>
                        </div>
                        @if(\App\Models\Usuario::accessAllowed())
                            <div class="col-12 col-md-6 text-start text-md-right">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#upload-file-to-gallery"><i
                                        class="fe fe-upload"></i> {{ __('lang.upload_file') }}</button>
                                <button type="button" class="btn btn-primary" wire:click="shareGallery()"><i
                                        class="fe fe-share"></i> {{ __('lang.share') }}</button>

                                @if ($showButtonReportGallery && $gallery)
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#modal-report-gallery"><i
                                            class="fa-regular fa-file"></i> {{ __('lang.report') }}</button>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    @livewire('forms-nueva-galeria', ['id' => $id, 'showGalleryComment' => true,
                    'showButtonReportGallery' => $showButtonReportGallery, 'editImage' => true])
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="page-header">
                    <div class="p-3">
                        <h3 class="main-content-title tx-24 mg-b-5">{{ __('lang.quote.quotations') }}</h3>
                    </div>
                    @if(\App\Models\Usuario::accessAllowed())
                        <div class="d-flex">
                            <div class="justify-content-center p-3">
                                <a class="btn btn-primary"
                                   href="{{ route("view-project-quote", ['id' => $id, 'quote_id' => 0]) }}">
                                    <i class="fa-solid fa-plus ml-1"></i>
                                    {{ __('lang.quote.add_quote') }}</a>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    @livewire('cotizacion-table', ['id' => $id])
                </div>

                <div class="page-header">
                    <div class="p-3">
                        <h3 class="main-content-title tx-24 mg-b-5">{{ __('lang.invoice') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    @livewire('factura-table', ['id' => $id])
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="upload-file-to-gallery" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         data-bs-focus="false"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('lang.upload_file') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @livewire('subir-foto-galeria')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="fas fa-close"></i> {{ __('lang.close') }}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-report-gallery" tabindex="-1" data-bs-focus="false" role="dialog"
         aria-labelledby="showModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('lang.report_gallery') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <livewire:project.gallery.report wire:model="gallery" :id="$id"/>
                </div>
                <div class="modal-footer">
                    <button wire:click="closeModalGalleryReport" type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal"><i class="fas fa-close"></i> {{ __('lang.close') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
