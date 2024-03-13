<div class="col-md-{{ $width }} order-{{ $smallorder }} order-md-{{ $order }} connectedSortable">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $name }}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
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