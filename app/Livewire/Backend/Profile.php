<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Str;

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

/*     private function deletefile($pathfile){
        if(Storage::disk('public')->exists($pathfile)){
            Storage::disk('public')->delete($pathfile);
        }
    } */

    public function mount()
    {
        $this->resetpasswd();
        $user = User::find(Auth::user()->id);          
        if($user) {
            $this->name    = $user->name;
            $this->email  = $user->email;
        }
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
        //flash message
        $this->alert('success', 'Profil berhasil diupdate');
        //session()->flash('success', 'Profile Berhasil Diupdate.');
        //redirect
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
        //dd($this->oldpath);
        // $dir='photos'; 
        if(!empty($this->oldpath)){
            $this->newpath="data:image/png;base64,".base64_encode(file_get_contents($this->photo->path()));
/*             $this->newpath=$this->photo->store($dir,'public'); //setingan di confi/filesystem
            $this->deletefile($this->oldpath); */
            User::updateOrCreate(['id' => Auth::user()->id], [
                'photo' => $this->newpath
            ]);
        }else{
            $this->newpath="data:image/png;base64,".base64_encode(file_get_contents($this->photo->path()));
           //dd($this->newpath);
            User::updateOrCreate(['id' => Auth::user()->id], [
                'photo' => $this->newpath
            ]);
        }
        //$this->photo->store('photos');
        //flash message
        $this->alert('success', 'Photo berhasil diganti');
        //session()->flash('success', 'Photo Berhasil Diubah.');
        //redirect
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
        //flash message
        $this->alert('success', 'Password berhasil diubah');
       //session()->flash('success', 'Password Berhasil Diganti.');
        //redirect
        return redirect()->route('profile');
    }

    public function render()
    {
        return view('livewire.backend.profile')->extends('layouts.app');
    }
}
