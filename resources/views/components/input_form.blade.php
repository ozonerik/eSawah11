<div class="form-group">
    <label for="{{ $ids }}" class="form-label @if(!empty($wajib)) text-danger  @endif">{{ $label }}</label>
    <input wire:model.live="{{ $name }}" name="{{ $name }}" @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @if($errors->has( $name ))
        <span class="invalid-feedback" role="alert">
            {{ $errors->first($name) }}
        </span>
    @endif
</div>