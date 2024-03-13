<div class="col-md-{{ $width }} order-{{ $smallorder }} order-md-{{ $order }} connectedSortable">
    <div class="card card-{{ $type }}" >
        <div class="card-header">
            <h3 class="card-title">{{ $name }}</h3>
        </div>
        <div class="card-body">
            {{ $slot }}
        </div>
        @if(!empty($footer))
        <div class="card-footer clearfix">
            {{ $footer}}
        </div>
        @endif
    </div>
</div>