<div class="col-md-{{ $width }} order-{{ $smallorder }} order-md-{{ $order }} connectedSortable">
    <div class="card card-{{ $type }}">
        <div class="card-header">
        <h3 class="card-title">{{ $title }}</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool ml-2" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
        </div>
        <div class="card-body">
            <div class="row mx-3 pl-1 mb-2">
                <div class="col-md-2 p-0 order-1 pr-md-3">
                    <div class="input-group input-group-sm mx-auto float-md-left mb-2 mb-md-0">
                        <select class="form-control" wire:model.live="perPage">
                            <option value="5">5</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="{{ $data->total() }}">All</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-10 p-0 order-2 pl-md-3">
                    <div class="mx-auto float-md-right mb-2 mb-md-0">
                        <button wire:click="onRead" class="btn btn-sm btn-primary btn-block" data-toggle="tooltip" title="Kembali">
                            <i class="fa fa-arrow-left mr-2"></i>Back
                        </button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped m-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            @foreach($thead as $val)
                            <th>{{ $val }}</th>
                            @endforeach
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $key=>$row)
                        <tr class="table-primary">
                            <td>{{$data->firstItem() + $key}}</td>
                            @foreach($tbody as $val)
                                <td>
                                @if($val=="images"||$val=="photos"||$val=="img"||$val=="photo"||$val=="image")
                                        @if(!empty($row->$val))
                                        <img alt="images" src="{{ $row->$val }}" class="img-thumbnail rounded float-left" style="max-height:150px"/> 
                                        @else
                                        <img alt="images" src="{{ asset('img/image.png') }}" class="img-thumbnail rounded float-left" style="max-height:150px"/> 
                                        @endif
                                    @else 
                                        {{ $row->$val }} 
                                    @endif 
                                </td>
                            @endforeach
                            <td>
                                @if( in_array('restore',$tbtn) &&  in_array('del',$tbtn) )
                                <button wire:click="onResDel({{ $row->id }})" class="btn btn-sm btn-success" style="width:35px" data-toggle="tooltip" title="Restore" ><i class="fas fa-trash-restore-alt"></i></button>         
                                <button wire:click="onDelForce({{ $row->id }})" class="btn btn-sm btn-danger ml-0 ml-md-1 mt-1 mt-md-0" style="width:35px" data-toggle="tooltip" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                                @elseif(in_array('restore',$tbtn))
                                <button wire:click="onResDel({{ $row->id }})" class="btn btn-sm btn-success" style="width:35px" data-toggle="tooltip" title="Restore" ><i class="fas fa-trash-restore-alt"></i></button>
                                @elseif(in_array('del',$tbtn))
                                <button wire:click="onDelForce({{ $row->id }})" class="btn btn-sm btn-danger" style="width:35px" data-toggle="tooltip" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer clearfix">
            <div class="float-left">
                <small>Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }} entries</small>
            </div>
            {{ $data->links() }} 
        </div>
    </div>
</div>