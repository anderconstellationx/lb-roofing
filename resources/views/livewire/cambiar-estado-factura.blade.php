<select wire:model.live="estado" class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true"
        id="invoiceStatus">
    <option label="{{__('lang.status')}}"> Select Status</option>
    @foreach($estados as $estado)
        <option value="{{$estado->id}}">{{$estado->nombre}}</option>
    @endforeach
</select>
@push('script')
    <script>
        $(document).ready(function () {
            $('#invoiceStatus').on('change', function (e) {
                var data = $('#invoiceStatus').select2("val");
                console.log(data);
                Livewire.dispatch('actualizar-estado', {estado: data});
            });
        });
    </script>
@endpush
