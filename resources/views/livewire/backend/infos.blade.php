<div>
    <x-content_header name="Info" >
        <li class="breadcrumb-item active">Settings</li>
        <li class="breadcrumb-item active">Info</li>
    </x-content_header>
    <div class="row mx-1">
        @if($mode=='read')
        <x-card_table type="primary" width="12" order="1" smallorder="1" title="Slide Banner Info" :data="$Info" :thead="['Title','Message','Image']" :tbody="['title','message','img']" :tbtn="['edit','del']" search="Search...">
        <x-slot:menu>
            <button wire:click="onAdd" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Tambah"><i class="fas fa-plus"></i></button>
            <button wire:click="onDelSelect" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus" @if(empty($checked)) disabled @endif><i class="fas fa-trash"></i></button>
            <button wire:click="onTrashed" class="btn btn-sm btn-success" data-toggle="tooltip" title="Trash" @if(empty($Restoreinfo->total())) disabled @endif><i class="fa fa-archive mr-2"></i>Trash</button>
        </x-slot>    
        </x-card_table>
        @elseif($mode=='trashed')
        <x-card_tabletrash type="danger" width="12" order="1" smallorder="1" title="Restore Info" :data="$Restoreinfo" :thead="['Title','Message','Image']" :tbody="['title','message','img']" :tbtn="['restore','del']" search="Search..."/>
        @elseif($mode=='add')
        <x-card_form name="Add Info" width="12" order="1" smallorder="1" closeto="onRead">
            <h4>Add Info</h4>
            <x-slot:footer>
            <form wire:submit.prevent="addinfo">
                <x-input_form disabled="false" ids="title" label="Title" types="text" name="title" placeholder="Type Title" />
                <x-input_form disabled="false" ids="message" label="Message" types="text" name="message" placeholder="Type Messages" />
                <div class="form-group">
                    <div class="font-weight-bold mb-2">Image</div>
                    <img alt="images" src="{{ asset('img/image.png') }}" class="img-thumbnail rounded" style="max-height:150px"/> 
                </div>
                <x-file_form2 ids="img" label="Image" name="img" :placeholder="$filename" capture=""/>
                <button type="button" wire:click="onRead" class="btn btn-success float-left">Back</button>
                <button type="submit" class="btn btn-primary float-right" wire:target="img" wire:loading.attr="disabled">Save</button>
            </form>
            </x-slot>
        </x-card_form>
        @elseif($mode=='edit')
        <x-card_form name="Edit Info" width="12" order="1" smallorder="1" closeto="onRead">
            <h4>Edit Info</h4>
            <x-slot:footer>
            <form wire:submit.prevent="editinfo">
                <x-input_form disabled="false" ids="title" label="Title" types="text" name="title" placeholder="Type Title" />
                <x-input_form disabled="false" ids="message" label="Message" types="text" name="message" placeholder="Type Messages" />
                <div class="form-group">
                    <div class="font-weight-bold mb-2">Image</div>
                    @if(!empty($tmpimg))
                    <img alt="images" src="{{ $tmpimg }}" class="img-thumbnail rounded" style="max-height:150px"/> 
                    @else
                    <img alt="images" src="{{ asset('img/image.png') }}" class="img-thumbnail rounded" style="max-height:150px"/> 
                    @endif
                </div>
                <x-file_form2 ids="img" label="" name="img" :placeholder="$filename" capture=""/>
                <button type="button" wire:click="onRead" class="btn btn-success float-left">Back</button>
                <button type="submit" class="btn btn-primary float-right" wire:target="img" wire:loading.attr="disabled">Save</button>
            </form>
            </x-slot>
        </x-card_form>
        @endif
    </div>
</div>