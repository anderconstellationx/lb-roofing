<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>{{ __('lang.report') }}</title>
</head>
<style>
    .page-break {
        page-break-after: always;
    }

    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }

    body {
        height: 100vh;
        position: relative;
    }

    .vertical-center {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .image-info {
        font-size: 12px;
    }

    .img-gallery {
        height: auto;
    }

    .table-images-2 .img-gallery {
        max-height: 450px;
    }

    .table-images-3 .img-gallery {
        max-height: 280px;
    }

    .table-images-4 .img-gallery {
        max-height: 200px;
    }

</style>
<body>

<div class="vertical-center">
    <p>{{ $user->getCompleteName() }}</p>
    <p>{{ env('APP_NAME') }}</p>
    <img src="https://static.companycam.com/logos/595601/e2654b23-6afb-4ff4-96f9-02ad38283277.png" alt="" width="100"
         height="100">
    <p> {{ date('m-d-Y') }} | {{$countImages}} {{ __('lang.photos') }}</p>
    <h1>{{$title}}</h1>
</div>
<div class="page-break"></div>

<table style="width: 100%; max-width: 100%" class="table-images-{{ $numberPages }}">
    @foreach($galleryItemsGrouped as $group)
        @foreach($group as $galleryItem)
            <tr>
                <td style="width: 50%">
                    <a href="{{ url('gallery/' . $galleryItem->path) }}" target="_blank">
                        @if (in_array($galleryItem->type, \App\Models\GaleriaProyecto::MIME_TYPE_IMAGE_ALLOWED))
                            <img class="img-gallery" src="gallery/{{ $galleryItem->path }}" width="100%"  alt=""/>
                        @else
                            <img class="img-gallery" src="assets/img/media/video-simple-cover.png" width="100%"  alt=""/>
                        @endif
                    </a>
                    <table>
                        <tr>
                            <td>
                        <span class="image-info">
                            {{ $galleryItem->usuario->getCompleteName() }}</span>
                            </td>
                            <td>
                                <span
                                    class="image-info">{{ date('n/j/Y, g:ia', strtotime($galleryItem->fecha_creacion)) }}</span>
                            </td>
                            <td>
                                <span class="image-info">{{ $galleryItem->proyecto->titulo }}</span>
                            </td>
                        </tr>
                    </table>
                </td>


                <td style="width: 50%">
                    <ul>
                        @foreach($galleryItem->interaccions as $comment)
                            <li>
                                <span><strong>{{ $comment->usuario->getCompleteName() }}: </strong></span>{{$comment->comentario}}
                            </li>
                        @endforeach
                    </ul>
                </td>
            </tr>
        @endforeach
    @endforeach
</table>
</body>
</html>
