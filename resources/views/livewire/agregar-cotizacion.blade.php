@section('title', __('lang.quote.quote'))
@push('style')
    <style>
        @media only screen and (max-width: 1024px) {
            #quote-view .table {
                width: 2000px;
            }
        }
    </style>
@endpush
@php
    $disabled = \App\Models\Usuario::isClient() ? 'disabled' : '';
@endphp
<div>
    <div class="p-6 space-y-6" id="quote-view">
        <div class="grid gap-6 mb-6 md:grid-cols-2">

            <div class="row mb-3">
                <div class="col-md-{{!$isTemplate ? '6' : '12'}}">
                    <label for="name"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.name') }}</label>
                    <input type="text" maxlength="255" id="name" class="form-control"
                           wire:model='name' {!! $disabled !!}>
                    <div>@error('name') <span class="text-danger">{{ $message }}</span> @enderror</div>
                </div>
                @if(!$isTemplate)
                    <div class="col-md-6">
                        <label for="name"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.status') }}</label>
                        <select
                            wire:model="status"
                            class="form-select"
                            {!! $disabled !!}
                            required>
                            <option value="">{{ __('lang.select_status')  }}</option>
                            @foreach($statusQuote as $status)
                                <option value="{{ $status['id'] }}">{{ $status['nombre'] }}</option>
                            @endforeach
                        </select>
                        <div>@error('status') <span class="text-danger">{{ $message }}</span> @enderror</div>
                    </div>
                @endif
            </div>

            @if(!$isTemplate)
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="fecha-emision"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.quote.quote_date') }}</label>
                        <input type="date" id="fecha-emision" class="form-control"
                               wire:model='fechaEmision' {!! $disabled !!}>
                        <div>@error('fechaEmision') <span class="text-danger">{{ $message }}</span> @enderror</div>


                    </div>
                    <div class="col-md-6">
                        <label for="fecha-vencimiento"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.due_date') }}</label>
                        <input type="date" id="fecha-vencimiento" class="form-control"
                               wire:model='fechaVencimiento' {!! $disabled !!}>
                        <div>@error('fechaVencimiento') <span class="text-danger">{{ $message }}</span> @enderror</div>
                    </div>
                </div>
            @endif

            @if(($quoteId || $quoteTemplateId) && \App\Models\Usuario::accessAllowed())
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="sub-total"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.sub_total') }}</label>

                        <div class="input-group">
                            <span class="input-group-text border-end-0">{{ MoneyHelper::getCurrencySymbol() }}</span>
                            <input type="text" min="0" id="sub-total" class="form-control" readonly
                                   value="{{ MoneyHelper::format($subtotalQuote, false) }}">
                        </div>

                    </div>
                    <div class="col-md-4">
                        <label for="descuento"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.discount') }}</label>
                        <div class="input-group">
                            <span class="input-group-text border-end-0">{{ MoneyHelper::getCurrencySymbol() }}</span>
                            <input type="number" id="descuento" class="form-control" min="0"
                                   wire:model='discountQuote'
                                   wire:keyup='calculateTotalQuote'
                                   wire:mouseup='calculateTotalQuote'
                                {!! $disabled !!}
                            >
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="total"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.total') }}</label>

                        <div class="input-group">
                            <span class="input-group-text border-end-0">{{ MoneyHelper::getCurrencySymbol() }}</span>
                            <input type="text" id="total" min="0" readonly class="form-control"
                                   value="{{ MoneyHelper::format($totalQuote, false) }}">
                        </div>
                    </div>
                </div>
            @endif

            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="observaciones"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.observations') }}</label>
                    <textarea id="observaciones" maxlength="500" class="form-control" rows="5"
                              wire:model='observaciones' {!! $disabled !!}></textarea>
                </div>
            </div>
        </div>


        @if($quoteId || $quoteTemplateId)
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="page-header">
                            <div>
                                <h2 class="main-content-title tx-24 mg-b-5">{{ __('lang.items') }}</h2>
                            </div>
                            <div class="d-flex">
                                <div class="justify-content-center">
                                    @if(\App\Models\Usuario::accessAllowed())
                                        <button wire:click="addItem" class="btn btn-primary">
                                        <i class="fa-solid fa-plus"></i>
                                        {{ __('Add') }}
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if($items)
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table text-nowrap text-md-nowrap table-bordered mg-b-0">
                                    <thead>
                                    <tr>
                                        <th>{{ __('lang.provider') }}</th>
                                        <th>{{ __('lang.product.product') }}</th>
                                        <th>{{ __('lang.quantity') }}</th>
                                        <th>{{ __('lang.price') }}</th>
                                        <th>{{ __('lang.discount') }}</th>
                                        <th>{{ __('lang.total') }}</th>
                                        <th>{{ __('lang.tax') }}</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($items as $keyItem => $item)
                                        <tr>

                                            <td>
                                                <select
                                                    wire:model="items.{{ $keyItem }}.provider_id"
                                                    wire:change="findProductsByProviderChange({{ $keyItem }})"
                                                    class="form-select"
                                                    {!! $disabled !!}>
                                                    <option value="">{{ __('lang.select')  }}</option>
                                                    @foreach($providers as $provider)
                                                        <option
                                                            value="{{ $provider['id'] }}">{{ $provider['nombre'] }}</option>
                                                    @endforeach
                                                </select>
                                            </td>

                                            <td>
                                                <select
                                                    wire:model="items.{{ $keyItem }}.product_id"
                                                    wire:change="itemSelectPriceChange({{ $keyItem }})"
                                                    class="form-select"
                                                    {!! $disabled !!}>
                                                    <option value="">{{ __('lang.select')  }}</option>
                                                    @foreach($items[$keyItem]['products'] as $product)
                                                        <option
                                                            value="{{$product['id']}}">{{ $product['nombre'] }}</option>
                                                    @endforeach
                                                </select>
                                            </td>

                                            <td>
                                                <input type="number" min="1" step="1" class="form-control"
                                                       wire:model="items.{{ $keyItem }}.quantity"
                                                       wire:keyup="calculatePrice({{ $keyItem }})"
                                                       wire:mouseup="calculatePrice({{ $keyItem }})"
                                                    {!! $disabled !!}
                                                >
                                            </td>

                                            <td>
                                                <div class="input-group">
                                                    <span
                                                        class="input-group-text border-end-0">{{ MoneyHelper::getCurrencySymbol() }}</span>
                                                    <input type="number" min="" step="0.1" class="form-control"
                                                           wire:model="items.{{ $keyItem }}.price"
                                                           wire:keyup="calculatePrice({{ $keyItem }})"
                                                           wire:mouseup="calculatePrice({{ $keyItem }})"
                                                        {!! $disabled !!}
                                                    >
                                                </div>
                                            </td>

                                            <td>
                                                <div class="input-group">
                                                    <span
                                                        class="input-group-text border-end-0">{{ MoneyHelper::getCurrencySymbol() }}</span>
                                                    <input type="number" min="0" step="0.1" class="form-control"
                                                           wire:model="items.{{ $keyItem }}.discount"
                                                           wire:keyup="calculatePrice({{ $keyItem }})"
                                                           wire:mouseup="calculatePrice({{ $keyItem }})"
                                                        {!! $disabled !!}
                                                    >
                                                </div>
                                            </td>

                                            <td>
                                                <div class="input-group">
                                                    <span
                                                        class="input-group-text border-end-0">{{ MoneyHelper::getCurrencySymbol() }}</span>
                                                    <input type="text" min="0" readonly class="form-control"
                                                           value="{{ MoneyHelper::format($item['sub_total'], false) }}"
                                                        {!! $disabled !!}>
                                                </div>
                                            </td>

                                            <td>
                                                <label class="custom-switch">
                                                    <input type="checkbox" name="custom-switch-checkbox"
                                                           class="custom-switch-input" value="1"
                                                           wire:model="items.{{ $keyItem }}.tax_boolean"
                                                           wire:change="addTax({{ $keyItem }})"
                                                        {!! $disabled !!}
                                                    >
                                                    <span class="custom-switch-indicator"></span>
                                                </label>
                                            </td>

                                            <td>
                                                <button type="button" class="btn btn-primary"
                                                        wire:click="removeItem({{ $keyItem }})" {!! $disabled !!}><i
                                                        class="fa-solid fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th colspan="4"></th>
                                        <th scope="row">{{ __('lang.sub_total') }}</th>
                                        <td>{{ MoneyHelper::format($subTotal) }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="4"></th>
                                        <th scope="row">{{ __('lang.tax') }}</th>
                                        <td>{{ MoneyHelper::format($tax) }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="4"></th>
                                        <th scope="row">{{ __('lang.total') }}</th>
                                        <td>{{ MoneyHelper::format($total) }}</td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endif
        <!-- Modal footer -->
        <div class="mt-3">
            @if(\App\Models\Usuario::accessAllowed())
                @if($quoteTemplateId)
                    <button type="submit" class="btn btn-primary"
                            wire:click="{{ $quoteTemplateId ? 'updateQuote' : 'addQuote' }}">
                        <i class="fa-solid fa-{{ $quoteTemplateId ? 'refresh' : 'save' }}">
                        </i> {{ $quoteTemplateId ? __('update') : __('save') }}
                    </button>
                @else
                    <button type="submit" class="btn btn-primary"
                            wire:click="{{ $quoteId ? 'updateQuote' : 'addQuote' }}"><i
                            class="fa-solid fa-{{ $quoteId ? 'refresh' : 'save' }}"></i> {{ $quoteId ? __('update') : __('save') }}
                    </button>
                @endif
            @endif
        </div>
    </div>
</div>
