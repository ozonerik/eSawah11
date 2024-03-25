<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Str;
use Livewire\Attributes\On;


class Profile extends Component
{
    use WithFileUploads;
    use LivewireAlert;
    public $user,$name,$email,$current_password,$password,$password_confirmation,$photo,$oldpath,$newpath;
    public $filename="Choose File";

    private function resetpasswd(){
        $this->current_password='';
        $this->password='';
        $this->password_confirmation='';
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function mount()
    {
        $this->resetpasswd();
        $user = User::find(Auth::user()->id);          
        if($user) {
            $this->name    = $user->name;
            $this->email  = $user->email;
        }
    }

    public function onDelForce(){
        $user = User::find(Auth::user()->id);
        $this->confirm("Apakah anda yakin ingin hapus permanen ?<p class='text-danger font-weight-bold'>".$user->name."</p>", 
        [
            'onConfirmed' => 'deleteprofile'
        ]);
    }

    #[On('deleteprofile')]
    public function deleteprofile(){
        User::findOrFail(Auth::user()->id)->delete();
        $this->alert('success', 'User berhasil dihapus');
        Auth::guard('web')->logout();
        return redirect('/');
    }

    public function updateprofile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::user()->id
        ]);
        User::updateOrCreate(['id' => Auth::user()->id], [
            'name' => $this->name,
            'email' => $this->email,
        ]);
        $this->alert('success', 'Profil berhasil diupdate');
        return redirect()->route('profile');
    }

    public function updatedPhoto($value){
        if($value){
            $this->filename=$value->getClientOriginalName();
        }else{
            $this->filename="Choose File";
        }
    }

    public function updatephoto()
    {
        $this->validate([
            'photo' => 'image|max:1024'
        ]);
        $myfile = User::findOrFail(Auth::user()->id);
        $this->oldpath = $myfile->photo;
        if(!empty($this->oldpath)){
            $this->newpath="data:image/png;base64,".base64_encode(file_get_contents($this->photo->path()));
            User::updateOrCreate(['id' => Auth::user()->id], [
                'photo' => $this->newpath
            ]);
        }else{
            $this->newpath="data:image/png;base64,".base64_encode(file_get_contents($this->photo->path()));
            User::updateOrCreate(['id' => Auth::user()->id], [
                'photo' => $this->newpath
            ]);
        }
        $this->alert('success', 'Photo berhasil diganti');
        return redirect()->route('profile');
    }

    public function updatepasswd()
    {
        $this->validate([
            'current_password' => ['required', new MatchOldPassword],
            'password' => ['required','confirmed',Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
            'password_confirmation' => ['required'],
        ]);

        User::updateOrCreate(['id' => Auth::user()->id], [
            'password' => Hash::make($this->password)
        ]);
        $this->alert('success', 'Password berhasil diubah');
        return redirect()->route('profile');
    }

    public function render()
    {
        return view('livewire.backend.profile')->layout('layouts.app');
    }
}
