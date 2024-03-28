<div class="col-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-bullhorn"></i> Informasi</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div id="carouselInfo" class="carousel slide carousel-fade" data-ride="carousel">   
                <div class="carousel-inner">
                    @foreach($data as $key=>$q)
                    <div class="carousel-item @if(($q->incrementing +$key) == 1 ) active @endif">
                        @if(($q->incrementing +$key) == 1 )
                        <div class="ribbon-wrapper ribbon-lg">
                            <div class="ribbon text-lg bg-primary">
                            NEW
                            </div>
                        </div>
                        @endif
                        @if(!empty($q->img))
                        <div class="carousel-bg rounded-top" style="background-image: url('{{$q->img}}')">
                        <!-- <div class="carousel-bg rounded-top" style="background-image: url('{{ Storage::url($q->img) }}')"> -->
                        @else
                        <div class="carousel-bg rounded-top bg-blank">
                        @endif
                            <div class="carousel-caption d-block d-inline-block rounded-bottom">
                            <h5>{{ $q->title}}</h5>
                            <p>{{ $q->message}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <a class="carousel-control-prev" href="#carouselInfo" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselInfo" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>

