@push('head')
    <meta name="robots" content="noindex, nofollow, noimageindex">
@endpush
@push('style')
    <link rel="stylesheet" href="{{ asset('') }}assets/plugins/lightgallery/css/lightgallery.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/plugins/lightgallery/css/lg-autoplay.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/plugins/lightgallery/css/lg-video.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/plugins/video.js/dist/video-js.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/plugins/lightgallery/css/lg-fullscreen.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/plugins/lightgallery/css/lg-comments.css">{{-- solo para el icono --}}
    <link rel="stylesheet" href="{{ asset('') }}assets/plugins/lightgallery/css/lg-rotate.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/plugins/lightgallery/css/lg-zoom.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/plugins/lightgallery/css/lg-thumbnail.css">

    {{-- edit image --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/tui.image-editor-3.15.3/css/tui-color-picker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/tui.image-editor-3.15.3/css/tui-image-editor.min.css') }}">
    {{-- edit image --}}


    <style>
        #gallery .ff_fileupload_wrap {
            overflow-x: auto;
        }

        #gallery .img-thumbnail {
            width: 100%;
            height: 100%;
            max-height: 315px;
        }

        .gallery-wrap {
        }

        #gallery .gallery-wrap img.thumbnail {
            width:100%;
            height:100%;
            max-height: 200px;
            min-height: 200px;
            object-fit:cover;
            display:block;
            transition: opacity 0.3s ease;
        }

        #gallery .gallery-wrap img.thumbnail:hover {
            opacity: 0.7;
        }

        .gallery-wrap:hover {
            opacity: 0.7;
            background-color: gray;
        }

        .tui-image-editor-container .tui-image-editor-header-logo {
            display: none;
        }

        .border-transparent {
            border: 1px solid transparent !important;
        }

    </style>
@endpush
<div>
    <div id="gallery" class="row mb-0">
        @forelse ($gallery as $key => $itemsGallery)
            <div class="col-12 mg-b-5" wire:key="gallery-group-{{ $key }}">
                @if($showGalleryComment)
                <div class="form-group">
                    <label class="custom-control custom-checkbox custom-control-md">
                        <input type="checkbox" class="custom-control-input" wire:click="checkGalleryAll({{ $key }})" wire:model="gallerySelectAll" value="{{ $key }}">
                        <span class="custom-control-label custom-control-label-md tx-16">
                            {{  \App\Livewire\FormsNuevaGaleria::formatDate($key) }}
                        </span>
                    </label>
                </div>
                @else
                    <label class="form-check-label user-select-none" for="check-date-{{ $key }}">
                        <h2 class="main-content-label mb-3">{{  \App\Livewire\FormsNuevaGaleria::formatDate($key) }}</h2>
                    </label>
                @endif
            </div>
            @foreach($itemsGallery as $keyItem => $item)
                @if(in_array($item['type'], \App\Models\GaleriaProyecto::MIME_TYPE_IMAGE_ALLOWED))
                    <div class="col-xs-6 col-sm-4 col-md-4 col-xl-2 mb-3" wire:key="gallery-group-item-{{ $keyItem }}">
                        <div
                            id="gallery-wrap-{{ $item['id'] }}"
                        >
                            @if($showGalleryComment)
                            <div class="form-group">
                                <label class="custom-control custom-checkbox custom-control-md">
                                    <input type="checkbox"  class="custom-control-input" wire:change="changeGallerySelectImage({{ $key }})" wire:model="gallerySelectImage" value="{{ $item['id'] }}">
                                    <span class="custom-control-label custom-control-label-md tx-16"></span>
                                </label>
                            </div>
                            @endif


                            <div
                                class="gallery-wrap"
                                data-filename="{{ $item['filename'] }}"
                                data-responsive="{{ $item['full_path'] }}"
                                data-src="{{ $item['full_path'] }}"
                                data-gallery-index="{{ $item['id'] }}"
                            >
                                <a href="javascript:void(0);" class="wd-100p">
                                    <img
                                        loading="lazy"
                                        class="thumbnail"
                                        src="{{ $item['full_path'] }}"
                                        alt="">
                                </a>
                            </div>

                        </div>
                    </div>
                @elseif(in_array($item['type'], \App\Models\GaleriaProyecto::MIME_TYPE_VIDEO_ALLOWED))
                    <div class="col-xs-6 col-sm-4 col-md-4 col-xl-2 mb-3" wire:key="gallery-group-item-{{ $keyItem }}">
                        <div
                            id="gallery-wrap-{{ $item['id'] }}"
                        >
                            @if($showGalleryComment)
                                <div class="form-group">
                                    <label class="custom-control custom-checkbox custom-control-md">
                                        <input type="checkbox"  class="custom-control-input" wire:change="changeGallerySelectImage({{ $key }})" wire:model="gallerySelectImage" value="{{ $item['id'] }}">
                                        <span class="custom-control-label custom-control-label-md tx-16"></span>
                                    </label>
                                </div>
                            @endif


                            <div
                                class="gallery-wrap"
                                data-lg-size="1280-720"
                                data-video='{"source": [{"src":"{{ $item['full_path'] }}", "type":"{{ $item['type'] }}"}], "attributes": {"preload": false, "playsinline": true, "controls": true}}'
                                data-gallery-index="{{ $item['id'] }}"
                            >
                                <a href="javascript:void(0);" class="wd-100p">
                                    <img
                                        loading="lazy"
                                        class="img-fluid img-thumbnail img-responsive"
                                        src="{{ asset('')}}assets/img/media/video-simple-cover.png"
                                        alt="">
                                    <i class="d-none fas fa-6x fa-play-circle"></i>
                                </a>
                            </div>

                        </div>
                    </div>
                @else
                    @continue
                @endif
            @endforeach
        @empty
            <p>{{ __('lang.empty') }}</p>
        @endforelse
    </div>

    @if($editImage)
        <div class="modal fade" id="modal-edit-gallery-image" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-focus="false" data-bs-keyboard="false">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title h4" id="modal-edit-gallery-imageLabel">{{ __('lang.edit_image') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-close"></i></button>
                    </div>
                    <div class="modal-body p-0">
                        <div id="tui-image-editor-container"></div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>

@push('script')
    <script src="{{ asset('') }}assets/plugins/lightgallery/lightgallery.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/lightgallery/plugins/autoplay/lg-autoplay.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/lightgallery/plugins/video/lg-video.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/lightgallery/plugins/fullscreen/lg-fullscreen.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/lightgallery/plugins/rotate/lg-rotate.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/lightgallery/plugins/zoom/lg-zoom.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/lightgallery/plugins/thumbnail/lg-thumbnail.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/video.js/dist/video.js"></script>

    {{-- Upload file --}}
    <script type="text/javascript" src="{{ asset('') }}assets/plugins/fancyuploder/jquery.ui.widget.js"></script>
    <script type="text/javascript" src="{{ asset('') }}assets/plugins/fancyuploder/jquery.fileupload.js"></script>
    <script type="text/javascript" src="{{ asset('') }}assets/plugins/fancyuploder/jquery.iframe-transport.js"></script>
    <script type="text/javascript" src="{{ asset('') }}assets/plugins/fancyuploder/jquery.fancy-fileupload.js"></script>

    {{-- edit image --}}
    <script type="text/javascript" src="{{ asset('assets/plugins/tui.image-editor-3.15.3/js/fabric.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/tui.image-editor-3.15.3/js/tui-code-snippet.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/tui.image-editor-3.15.3/js/tui-color-picker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/tui.image-editor-3.15.3/js/FileSaver.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/tui.image-editor-3.15.3/js/tui-image-editor.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/tui.image-editor-3.15.3/theme/black-theme.js') }}"></script>
    {{-- edit image --}}
    <script>
        $(function () {
            /* gallery */
            const gallery = document.getElementById('gallery');
            const headerMenu = $('div.page > div:first-child')
            let headerClass = ''
            let pluginInstance = null
            let ajaxLoadComment = null
            let ajaxSaveComment = null
            let imageEditor = null

            gallery.addEventListener('lgInit', (event) => {
                pluginInstance = event.detail.instance;
                // Note append and find are not jQuery methods
                // These are utility methods provided by lightGallery
                const toolbar = pluginInstance.outer.find(".lg-toolbar");
                toolbar.append(
                    `<button  id="lg-comment-gallery" type="button" class="lg-comment-toggle lg-icon"></button>`
                );

                @if($editImage)

                toolbar.append(
                    `<button  id="lg-image-edit" type="button" class="lg-icon" data-bs-toggle="modal" data-bs-target="#modal-edit-gallery-image"><i class="fas fa-pencil"></i></button>`
                );

                @endif

                pluginInstance.outer.append('<div id="lg-comment-box" class="lg-comment-box lg-fb-comment-box"></div>')

                $(document).on("click", "#close-comment-gallery", function (e) {
                    e.stopImmediatePropagation();
                    const galleryOuterContainer = $('[id^="lg-outer-"]');
                    galleryOuterContainer.toggleClass('lg-comment-active');
                })

                $(document).on("click", "#lg-comment-gallery", function (e) {
                    e.stopImmediatePropagation();
                    const galleryOuterContainer = $('[id^="lg-outer-"]');
                    galleryOuterContainer.toggleClass('lg-comment-active');

                    const indexElement = pluginInstance.index
                    const itemElement = pluginInstance.items[indexElement]
                    const imageGalleryId = $(itemElement).attr('data-gallery-index') ?? null
                    const galleryContainer = $('[id^="lg-outer-"]');
                    const lgSubHtml = $('#lg-comment-box');

                    if (galleryContainer.hasClass('lg-comment-active') && imageGalleryId) {
                        ajaxLoadComment = loadMessage(imageGalleryId, lgSubHtml)
                    }
                });

                @if($editImage)

                $(document).on("click", "#lg-image-edit", function (e) {
                    e.stopImmediatePropagation();
                    const indexElement = pluginInstance.index
                    const itemElement = pluginInstance.items[indexElement]
                    const pathImage = $(itemElement).attr('data-src') ?? null
                    const filaNameImage = $(itemElement).attr('data-filename') ?? null

                    if (imageEditor) {
                        imageEditor.destroy()
                    }

                    imageEditor = initImageEditor('#tui-image-editor-container', pathImage, filaNameImage)
                    const tuiEditorContainer = $('.tui-image-editor-header-buttons')
                    tuiEditorContainer.html('')
                    tuiEditorContainer.append('<button id="save-edit-image" class="btn btn-primary border-transparent"> <i class="fas fa-save"></i> {{ __('lang.save') }}</button>')
                })

                $(document).on("click", "#save-edit-image", function (e) {
                    e.stopImmediatePropagation();
                    if (imageEditor) {

                        saveEditImage(imageEditor.getImageName(), imageEditor.toDataURL())
                        const indexElement = pluginInstance.index
                        const itemElement = pluginInstance.items[indexElement]

                        const elementGalleryDisplayed = $('.lg-object[data-index="' + indexElement + '"]')

                        var img = new Image();
                        img.src =  elementGalleryDisplayed.attr('src') + '?' + new Date().getTime();

                        elementGalleryDisplayed.attr('src', img.src)

                        console.log('indexElement', indexElement)
                        console.log('itemElement', itemElement)

                        pluginInstance.closeGallery();
                        Livewire.dispatch('update-gallery-files', {refresh: true});

                    }
                });

                @endif

            });

            gallery.addEventListener('lgBeforeOpen', (event) => {
                headerClass = headerMenu.attr('class')
                headerMenu.removeClass(headerClass)
            });

            gallery.addEventListener('lgAfterClose', (event) => {
                headerMenu.addClass(headerClass)
                headerClass = ''
            });

            gallery.addEventListener('lgBeforeSlide', (event) => {
                const galleryContainer = $('[id^="lg-outer-"]');
                if (galleryContainer.hasClass('lg-comment-active')) {
                    galleryContainer.removeClass('lg-comment-active')
                }
            });

            gallery.addEventListener('lgBeforeNextSlide', (event) => {
            });

            gallery.addEventListener('lgAfterAppendSlide ', (event) => {
            });

            gallery.addEventListener('lgAfterAppendSubHtml', (event) => {
            });

            let lightGallery = initLightGallery(gallery)
            /* gallery */

            /* upload file to gallery */
            const uploadFileGallery = $('#files-to-gallery')
            const modalGallery = $('#upload-file-to-gallery')
            const initUploadFile = function () {
                uploadFileGallery.FancyFileUpload({
                    url: '{{ route('view-project-upload-file-gallery') }}',
                    edit: false,
                    params: {
                        _token: $('#form-upload-file-gallery').find('input[name="_token"]').first().val(),
                        id: '{{ $id }}'
                    },
                    maxfilesize: {{ App\Models\GaleriaProyecto::MAX_FILE_SIZE }},
                    added: function (e, data) {
                        // It is okay to simulate clicking the start upload button.
                        this.find('.ff_fileupload_actions button.ff_fileupload_start_upload').click();
                    },
                    uploadcompleted: function (e, data) {
                        $('.ff_fileupload_actions').remove()
                    },
                    langmap: {
                        'Upload completed': '{{ __('lang.upload_completed') }}',
                        'Invalid file extension.': '{{ __('lang.invalid_file_extension') }}',
                        'The upload failed.  {0} ({1})': '{{ __('lang.upload_file_gallery_failed') }}',
                        'File is too large.  Maximum file size is {0}.': '{{ __('lang.file_is_too_large', ['size' => \App\Models\GaleriaProyecto::getDisplayFilesize()]) }}'
                    },
                    accept: {!! json_encode(array_keys(\App\Models\GaleriaProyecto::getMimeTypeAllowed())) !!},
                });
            }

            modalGallery.on('show.bs.modal', function (event) {
                initUploadFile()
            })

            modalGallery.on('hidden.bs.modal', function (event) {
                $(gallery).addClass('pe-none')
                Livewire.dispatch('update-gallery-files', {refresh: true});
            })

            /* upload file to gallery */
            window.addEventListener('refresh-gallery', event => {
                let currentCurrentElement = $('.gallery-wrap').length
                let intervalId = setInterval(function () {
                    let newCountElement = $('.gallery-wrap').length
                    if (newCountElement !== currentCurrentElement) {
                        clearInterval(intervalId);
                        lightGallery.destroy()
                        lightGallery = initLightGallery(gallery)
                    }
                }, 1000);
            });

            @if($showGalleryComment)
            /* add comment to gallery */
            $(document).on("click", "#send-comment-gallery", function () {
                const indexElement = pluginInstance.index
                const itemElement = pluginInstance.items[indexElement]
                const imageGalleryId = $(itemElement).attr('data-gallery-index') ?? null
                const comment = $('#gallery-comment').val()
                const token = $('#wrap-send-comment').find('input[name="_token"]').first().val()
                const lgSubHtml = $('#lg-comment-box');

                if (imageGalleryId && comment.trim()) {
                    ajaxSaveComment = saveComment(imageGalleryId, comment, token, lgSubHtml)
                }
            });
            @endif
        })
    </script>
    <script>
        const htmlLoader = '<div class="text-center"><div class="lds-dual-ring"></div></div>'

        function initLightGallery(el) {
            return lightGallery(el, {
                plugins: [lgVideo, lgFullscreen, lgRotate, lgZoom, lgThumbnail],
                download: true,
                controls: true,
                counter: true,
                videojs: true,
                videojsOptions: {
                    muted: true,
                    autoplay: true,
                },
                appendSubHtmlTo: ".lg-outer",
                addClass: 'lg-custom-thumbnails',
                thumbnail: true,
                mobileSettings: {
                    controls: false,
                    showCloseIcon: false,
                    download: false,
                    rotate: false
                },
                selector: '.gallery-wrap',
                preload: 1,
                isMobile: function () {
                    if ('maxTouchPoints' in navigator) {
                        return navigator.maxTouchPoints > 0
                    }

                    const mQ = matchMedia?.('(pointer:coarse)');
                    if (mQ?.media === '(pointer:coarse)') {
                        return !!mQ.matches
                    }

                    if ('orientation' in window) {
                        return true
                    }

                    return /\b(BlackBerry|webOS|iPhone|IEMobile)\b/i.test(navigator.userAgent) ||
                        /\b(Android|Windows Phone|iPad|iPod)\b/i.test(navigator.userAgent);
                }
            });
        }

        function loadMessage(id, appendElement) {
            return $.ajax({
                url: '{{ route('view-project-gallery-retrieve-comment') }}',
                type: 'GET',
                data: {
                    id: id
                },
                dataType: 'json',
                async: true,
                beforeSend: function () {
                    appendElement.html(
                        htmlLoader
                    )
                },
                success: function (response) {
                    appendElement.html(response.html)
                },
                error: function (xhr, status, error) {
                    console.log('Error: ' + error);
                },
                complete: function () {

                }
            });
        }

        function saveComment(id, comment, token, appendHtml) {
            return $.ajax({
                url: '{{ route('view-project-gallery-save-comment') }}',
                type: 'POST',
                data: {
                    id: id,
                    comment: comment,
                    _token: token,
                },
                dataType: 'json',
                async: true,
                beforeSend: function () {
                    appendHtml.html(
                        htmlLoader
                    )
                },
                success: function (response) {
                    appendHtml.html(
                        response.html
                    )
                },
                error: function (xhr, status, error) {
                    console.log('Error: ' + error);
                },
                complete: function () {

                }
            });
        }

        @if($editImage)

        function initImageEditor(elementId, filename, name) {
            let imageEditor = new tui.ImageEditor(elementId, {
                includeUI: {
                    loadImage: {
                        path: filename,
                        name: name,

                    },
                    theme: blackTheme, // or whiteTheme
                    initMenu: 'draw',
                    menuBarPosition: 'left',
                },
                cssMaxWidth: 800,
                cssMaxHeight: 600,
                usageStatistics: false,
            });

            window.onresize = function () {
                imageEditor.ui.resizeEditor();
            };

            return imageEditor;
        }

        async function saveEditImage(image, imageBase64) {
            const modalEditGalleryImage = $('#modal-edit-gallery-image')

            return $.ajax({
                url: '{{ route('save-edit-image-gallery') }}',
                type: 'POST',
                data: {
                    image: image,
                    imageBase64: imageBase64,
                    _token: document.querySelector('meta[name="csrf-token"]').content,
                },
                dataType: 'json',
                async: true,
                beforeSend: function () {

                },
                success: function (response) {

                    if (response.success) {
                        modalEditGalleryImage.modal('hide')
                    }

                    globalToast(response.message, '#', response.color)

                },
                error: function (xhr, status, error) {

                },
                complete: function () {

                }
            });
        }

        @endif

    </script>
@endpush
