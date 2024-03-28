<div class="col-md-{{ $width }} connectedSortable">
    <div class="card card-{{ $type }}">
        <div class="card-header">
        <h3 class="card-title"><i class="fas fa-chart-bar"></i>  {{ $title }}</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
        </div>
        <div class="card-body">
        <div class="chart" wire:ignore>
            <canvas id="{{ $idbarchart }}" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
        </div>
    </div>
</div>