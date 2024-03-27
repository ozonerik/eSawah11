<div class="col-md-{{ $width }} connectedSortable">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
            <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
            </div>
        </div>
        <div class="card-body p-0">
            <ul class="products-list product-list-in-card pl-2 pr-2">
                {{ $slot }}
            </ul>
        </div>
        @if(!empty($footer))
        <div class="card-footer text-center">
            {{ $footer}}
        </div>
        @endif
    </div>
</div>