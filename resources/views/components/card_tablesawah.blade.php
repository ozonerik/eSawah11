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
                <div class="col-md-1 p-0 order-2 order-md-1 pr-md-3">
                    <div class="input-group input-group-sm mx-auto float-md-left mb-2 mb-md-0">
                        <select class="form-control"  wire:model.live="perPage">
                            <option value="5">5</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="{{ $data->total() }}">All</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-8 p-0 order-3 order-md-2 px-md-2">
                    <div class="text-center">
                        {{ $menu }}
                    </div>
                </div>
                <div class="col-md-3 p-0 order-1 order-md-3 pl-md-3">
                    <div class="input-group input-group-sm mx-auto float-md-right mb-2 mb-md-0">
                        <input type="text" name="table_search" class="form-control"  wire:model.live="search" placeholder="{{ $search }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped m-0">
                    <thead>
                        <tr>
                            <th class="text-center"><input type="checkbox"  wire:model.live="selectPage"></th>
                            <th>No</th>
                            @foreach($thead as $val)
                            <th>{{ $val }}</th>
                            @endforeach
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $key=>$row)
                        <tr class="@if($this->is_checked($row->id)) table-primary @endif">
                            <td class="text-center"><input type="checkbox" value="{{ $row->id }}"  wire:model.live="checked"></td>
                            <td>{{$data->firstItem() + $key}}
                                
                            </td>
                            @foreach($tbody as $val)
                                <td>
                                    <!--gambar-->
                                    @if($val=="images"||$val=="photos"||$val=="img"||$val=="photo"||$val=="image")
                                        @if(!empty($row->$val))
                                        <img alt="images" src="{{ $row->$val }}" class="img-thumbnail rounded float-left" style="max-width:150px"/> 
                                        @else
                                        <img alt="images" src="{{ asset('img/image.png') }}" class="img-thumbnail rounded float-left" style="max-width:150px"/> 
                                        @endif
                                    <!--luas-->
                                    @elseif($val=="luas")
                                        {{ get_formatindo($row->$val) }} ( {{ get_convtobata($row->$val) }} )
                                    <!--harga-->
                                    @elseif(substr($val,0,5) == "harga")
                                        {{ get_convtorp($row->$val) }}
                                    @else
                                        {{ $row->$val }} 
                                    @endif 
                                </td>
                            @endforeach
                            <td>
                                @if( in_array('edit',$tbtn) &&  in_array('del',$tbtn) )
                                <button wire:click="onEdit({{ $row->id }})" class="btn btn-sm btn-success w-100" data-toggle="tooltip" title="Edit" ><i class="fas fa-edit"></i></button>         
                                <button wire:click="onDelete({{ $row->id }})" class="btn btn-sm btn-danger mt-1 w-100" data-toggle="tooltip" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                                @elseif(in_array('edit',$tbtn))
                                <button wire:click="onEdit({{ $row->id }})" class="btn btn-sm btn-success w-100" data-toggle="tooltip" title="Edit" ><i class="fas fa-edit"></i></button>
                                @elseif(in_array('del',$tbtn))
                                <button wire:click="onDelete({{ $row->id }})" class="btn btn-sm btn-danger w-100" data-toggle="tooltip" title="Hapus"><i class="fas fa-trash-alt"></i></button>
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