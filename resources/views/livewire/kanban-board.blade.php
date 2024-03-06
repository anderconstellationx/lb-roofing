<div>
    @push('style')
        <style>
            #kanban .list-group {
                min-height: 300px;
            }
        </style>
    @endpush
    <div id="kanban" class="row">
        @foreach($projects as $keyStatus => $statusProjectItem)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl mg-md-b-15 mg-b-20">
                <div class="card h-100">
                    <h5 class="card-header border-0  {{ !$statusProjectItem['color'] ? 'bg-secondary' : 'text-white' }}"
                        style="{{ $statusProjectItem['color'] ? "background-color: {$statusProjectItem['color']}" : '' }}"
                        onclick='{{ App\Models\Usuario::isAdmin() ? "openEstadoProyecto($keyStatus)" : "javascript:void(0);" }}'
                    >
                        {{ $statusProjectItem['name'] }}
                    </h5>
                    <div class="card-body p-0 border-1 h-100">
                        <div class="list-group h-100" id="{{ 'item-' . $keyStatus }}" data-status="{{ $keyStatus }}">
                            @foreach($statusProjectItem['projects'] as $projectItem)
                                <div data-id="{{ $projectItem['id'] }}" class="list-group-item nested-1 p-2">
                                    <div class="btn-group w-100 ">
                                        <button class="btn btn-primary btn-block text-start handle " type="button">
                                            <i class="fas fa-arrows-alt me-1"></i> {{ $projectItem['name'] }}
                                        </button>
                                        <button type="button"
                                                class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="visually-hidden">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item"
                                                   href="{{ route("view-project", ['id' => $projectItem['id']]) }}"><i
                                                        class="fas fa-eye"></i> {{ __('lang.view') }}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

