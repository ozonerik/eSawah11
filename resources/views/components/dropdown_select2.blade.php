<div class="form-group">
    <label for="{{$ids}}" >{{$label}}</label>
    <div wire:ignore>
    <select wire:model="{{$name}}" id="{{$ids}}" class="form-control @if($errors->has( $name )) is-invalid @endif" style="width:100%">
        <option value="">Please Choose...</option> 
        @foreach ($data as $row)
        <option value="{{$row->$values}}" > {{$row->$showval}}</option>
        @endforeach
    </select>
    @if($errors->has( $name ))<div class="invalid-feedback">{{ $errors->first($name) }}</div>@endif
    </div>
</div>

@push('js')
<script>
document.addEventListener('livewire:load', function () {
    $('#{{$ids}}').select2({
        theme: 'bootstrap4',
        placeholder: "Please Choose...",
        allowClear: 'true'
    })
    $('#{{$ids}}').change(function (e) {
        let data = $(this).val();
        @this.set('{{$name}}', data);
    });
});

window.addEventListener('run_select2', event => {
    $('#{{$ids}}').select2({
        theme: 'bootstrap4',
        placeholder: "Please Choose...",
        allowClear: 'true'
    })
    $('#{{$ids}}').change(function (e) {
        let data = $(this).val();
        @this.set('{{$name}}', data);
    });
});
</script>
@endpush