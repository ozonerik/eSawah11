<div>
    <x-content_header name="Profile" >
        <li class="breadcrumb-item active">Profile</a></li>
    </x-content_header>
    <div class="row mx-1 pb-3">
        <x-card_profile name="Profile Picture" width="3" order="1" smallorder="1">
            <form wire:submit.prevent="updatephoto" enctype="multipart/form-data">
                <x-file_form2 ids="photo" label="" name="photo" :placeholder="$filename" capture=""/>
                <div class="form-group text-md-right text-center">
                <button class="btn btn-primary" type="submit" wire:target="photo" wire:loading.attr="disabled">
                    <span wire:target="photo" wire:loading.class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span wire:target="photo" wire:loading.class="sr-only">Save</span>
                </button>
                </div>
            </form>
        </x-card_profile>
        <x-card_section2 name="Profile Information" type="primary" width="9" order="2" smallorder="2">
        <form wire:submit.prevent="updateprofile">
            <x-input_form disabled="false" ids="name" label="Name" types="text" name="name" placeholder="Enter Name" />
            <x-input_form disabled="false" ids="email" label="Email address" types="email" name="email" placeholder="Enter email" />
            <div class="form-group text-md-right text-center">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
        </x-card-section2>
    </div>
    <div class="row mx-1 pb-3">
        <div class="col-12 col-md-3"></div>
            <x-card_section2 name="Update Password" type="primary" width="9" order="4" smallorder="4">
            <form wire:submit.prevent="updatepasswd">
                <x-input_form disabled="false" ids="currentpassword" label="Current password" types="password" name="current_password" placeholder="Current Password" />
                <x-input_form disabled="false" ids="newpassword" label="New password" types="password" name="password" placeholder="New Password" />
                <x-input_form disabled="false" ids="confirmpassword" label="Retype new password" types="password" name="password_confirmation" placeholder="Retype new password" />
                <div class="form-group text-md-right text-center">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </x-card-section2>
    </div>
    <div class="row mx-1 pb-3">
        <div class="col-12 col-md-3"></div>
            <x-card_section2 name="Hapus Akun" type="danger" width="9" order="4" smallorder="4">
            <form wire:submit.prevent="onDelForce">
                <div class="row" >
                    <div class="col-md-6 col-12 form-group text-md-left text-center text-danger">Hapus permanen akun saya</div>
                    <div class="col-md-6 col-12 form-group text-md-right text-center">
                        <button type="submit" class="btn btn-danger">HAPUS</button>
                    </div>
                </div>
            </form>
        </x-card-section2>
    </div>
</div>