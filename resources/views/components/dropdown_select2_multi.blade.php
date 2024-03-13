<div class="form-group">
    <label for="{{$ids}}" >{{$label}}</label>
    <div class="select2bs4-blue" wire:ignore>
        <select wire:model="{{$name}}" multiple="multiple" id="{{$ids}}" style="width:100%" data-dropdown-css-class="select2bs4-blue" class="form-control @if($errors->has( $name )) is-invalid @endif" >
            <option value="">Please Choose...</option> 
            @foreach ($data as $row)
            <option value="{{$row->$values}}" > {{$row->$showval}}</option>
            @endforeach
        </select>
    </div>
    @if($errors->has( $name ))<div class="invalid-feedback">{{ $errors->first($name) }}</div>@endif
</div>
<script>
document.addEventListener('livewire:load', function () {
    $('#{{$ids}}').select2({
        theme: 'bootstrap4',
        placeholder: "Please Choose...",
        allowClear: 'true'
    })
    $('#{{$ids}}').on('change', function() {
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
    $('#{{$ids}}').on('change', function() {
        let data = $(this).val();
        @this.set('{{$name}}', data);
    });
});
</script>