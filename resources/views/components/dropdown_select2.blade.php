<div class="form-group">
    <label for="{{$ids}}" >{{$label}}</label>

    @if($typeselect=='single')
    <div wire:ignore>
        <select wire:model.live="{{$name}}"  onchange="@this.set('{{ $name }}', this.value)" type-select="select2" name="{{$name}}" id="{{$ids}}" class="form-control @if($errors->has( $name )) is-invalid @endif" style="width:100%">
            <option value="">Please Choose...</option> 
            @foreach ($data as $row)
            <option value="{{$row->$values}}" > {{$row->$showval}}</option>
            @endforeach
        </select>
    </div>
    @endif

    @if($typeselect=='multi')
    <div class="select2bs4-blue" wire:ignore>
        <select wire:model.live="{{$name}}"  onchange="@this.set('{{ $name }}', this.value)" type-select="select2" name="{{$name}}" multiple="multiple" id="{{$ids}}" style="width:100%" data-dropdown-css-class="select2bs4-blue" class="form-control @if($errors->has( $name )) is-invalid @endif" >
            <option value="">Please Choose...</option> 
            @foreach ($data as $row)
            <option value="{{$row->$values}}" > {{$row->$showval}}</option>
            @endforeach
        </select>
    </div>
    @endif

    @if($errors->has( $name ))<div class="invalid-feedback">{{ $errors->first($name) }}</div>@endif
</div>