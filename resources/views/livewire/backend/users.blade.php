@push('js')
<x-script_select2 />
@endpush
<div>
    <x-content_header name="Users" >
        <li class="breadcrumb-item active">Settings</li>
        <li class="breadcrumb-item active">Users</li>
    </x-content_header>
    <div class="row mx-1">
        @if($mode=='read')
        <x-card_table type="primary" width="12" order="1" smallorder="1" title="Daftar Users" :data="$user" :thead="['Nama','Email','Hak Akses']" :tbody="['name','email','hakakses']" :tbtn="['edit','del']" search="Search...">
            <x-slot:menu>
                <button wire:click="onAdd" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Tambah"><i class="fas fa-plus"></i></button>
                <button wire:click="onEditSelect" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Edit" @if(empty($checked)) disabled @endif><i class="fas fa-edit"></i></button>
                <button wire:click="onDelSelect" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus" @if(empty($checked)) disabled @endif><i class="fas fa-trash"></i></button>
                <button wire:click="onTrashed" class="btn btn-sm btn-success" data-toggle="tooltip" title="Trash" @if(empty($Restoreuser->total())) disabled @endif><i class="fa fa-archive mr-2"></i>Trash</button>
            </x-slot>
        </x-card_table>
        @endif
        @if($mode=='trashed')
        <x-card_tabletrash type="danger" width="12" order="1" smallorder="1" title="Restore User" :data="$Restoreuser" :thead="['Nama','Email','Hak Akses']" :tbody="['name','email','hakakses']" :tbtn="['restore','del']" search="Search..."/>
        @endif
        @if($mode=='add')
        <x-card_form name="Add User" width="12" order="1" smallorder="1" closeto="onRead">
            <h4>Add User</h4>
            <x-slot:footer>
            <form wire:submit.prevent="adduser">
                <x-input_form disabled="false" ids="name" label="Name" types="text" name="name" placeholder="Enter Name" />
                <x-input_form disabled="false" ids="email" label="Email address" types="email" name="email" placeholder="Enter email" />
                <x-input_form disabled="false" ids="newpassword" label="New password" types="password" name="password" placeholder="New Password" />
                <x-input_form disabled="false" ids="confirmpassword" label="Retype new password" types="password" name="password_confirmation" placeholder="Retype new password" />
                <x-dropdown_select2 typeselect="single" ids="opsiroles" label="Hak Akses" name="opsiroles" :data="$roles" values="name" showval="name"/>
                <button type="button" wire:click="onRead"class="btn btn-success float-left">Back</button>
                <button type="submit" class="btn btn-primary float-right">Save</button>
            </form>
            </x-slot>
        </x-card_form>
        @endif
        @if($mode=='edit')
        <x-card_form name="Edit User" width="12" order="1" smallorder="1" closeto="onRead">
            <h4>Edit User</h4>
            <x-slot:footer>
            <form wire:submit.prevent="edituser">
                <x-input_form disabled="false" ids="name" label="Name" types="text" name="name" placeholder="Enter Name" />
                <x-input_form disabled="false" ids="email" label="Email address" types="email" name="email" placeholder="Enter email" />
                <x-input_form disabled="false" ids="newpassword" label="New password" types="password" name="password" placeholder="New Password" />
                <x-input_form disabled="false" ids="confirmpassword" label="Retype new password" types="password" name="password_confirmation" placeholder="Retype new password" />
                <x-dropdown_select2 typeselect="single" ids="opsiroles" label="Hak Akses" name="opsiroles" :data="$roles" values="name" showval="name"/>
                <button type="button" wire:click="onRead"class="btn btn-success float-left">Back</button>
                <button type="submit" class="btn btn-primary float-right">Save</button>
            </form>
            </x-slot>
        </x-card_form>
        @endif
        @if($mode=='editselect')
        <x-card_form name="Edit User Selected" width="12" order="1" smallorder="1" closeto="onRead">
            <h4>Edit User Selected</h4>
            <x-slot:footer>
            <form wire:submit.prevent="edituserselected">
                <x-input_form disabled="false" ids="newpassword" label="New password" types="password" name="password" placeholder="New Password" />
                <x-input_form disabled="false" ids="confirmpassword" label="Retype new password" types="password" name="password_confirmation" placeholder="Retype new password" />
                <x-dropdown_select2 typeselect="single" ids="opsiroles" label="Hak Akses" name="opsiroles" :data="$roles" values="name" showval="name"/>
                <button type="button" wire:click="onRead"class="btn btn-success float-left">Back</button>
                <button type="submit" class="btn btn-primary float-right">Save</button>
            </form>
            </x-slot>
        </x-card_form>
        @endif
    </div>
</div>
