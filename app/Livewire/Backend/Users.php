<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Carbon\Carbon;
use Livewire\Attributes\On;

class Users extends Component
{
    use WithPagination;
    use LivewireAlert;
    
    protected $paginationTheme = 'bootstrap';
    public $perPage=5;
    public $selectPage = false;
    public $checked = [];
    public $search='';
    public $mode='read';
    public $roles,$ids,$users,$name,$email,$password,$password_confirmation;
    public $user_role,$opsiroles;
    
    public function getUserProperty(){
        $searchQuery = trim($this->search);
        $requestData = ['users.name', 'users.email', 'roles.name'];
        return User::select(['users.*','roles.name as hakakses'])
        ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
        ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->where(function($q) use($requestData, $searchQuery) {
            foreach ($requestData as $field)
               $q->orWhere($field, 'like', "%{$searchQuery}%");
        })->paginate($this->perPage,['*'], 'userPage');


/*         return User::where(function($q) use($requestData, $searchQuery) {
            foreach ($requestData as $field)
               $q->orWhere($field, 'like', "%{$searchQuery}%");
        })->paginate($this->perPage,['*'], 'userPage'); */
        //return User::where('name','like','%'.$this->search.'%')->paginate($this->perPage,['*'], 'userPage');
    }

    public function getRestoreuserProperty()
    {
        return User::onlyTrashed()->orderBy('deleted_at', 'DESC')->paginate($this->perPage,['*'], 'infotrashPage');
    }
    public function onTrashed(){
        $this->mode='trashed';
    }
    public function onResDel($id){
        User::where('id',$id)->withTrashed()->restore();
        $this->resetForm();
        $this->alert('success', 'User berhasil direstore');
    }
    public function onDelForce($id){
        $this->ids=$id;
        $user = User::whereIn('id',[$id]);
        $this->confirm("Apakah anda yakin ingin hapus permanen ?<p class='text-danger font-weight-bold'>".$user->pluck('name')->implode(',<br>')."</p>", 
        [
            'onConfirmed' => 'onDelForceProses'
        ]);
    }

    #[On('onDelForceProses')]
    public function onDelForceProses(){
        User::where('id',$this->ids)->withTrashed()->forceDelete();
        $this->resetForm();
        $this->alert('success', 'User berhasil dihapus permanen');
    }

    public function updatedSelectPage($value){
        if($value){
            $this->checked = $this->User->pluck('id')->toArray();
        }else{
            $this->checked = [];
        }
    }

    public function updatedChecked($value){
        $this->selectPage=false;
    }

    public function is_checked($id){
        return in_array($id,$this->checked);
    }

    #[On('deluserselect')]
    public function deluserselect()
    {
        User::whereIn('id',$this->checked)->delete();
        $this->resetForm();
        $this->alert('success', 'User berhasil dihapus');
        return redirect()->route('users');
    }

    #[On('deluser')]
    public function deluser()
    {
        User::findOrFail($this->ids)->delete();
        $this->resetForm();
        $this->alert('success', 'User berhasil dihapus');
        return redirect()->route('users');
    }

    private function resetForm()
    {
        $this->ids='';
        $this->name='';
        $this->email='';
        $this->password='';
        $this->password_confirmation='';
        $this->opsiroles =null;
        $this->resetErrorBag();
        $this->resetValidation();

    }

    public function edituserselected()
    {
        $cek_password=( is_null($this->password) || $this->password=="" ) ;       
        if($cek_password){
            $this->validate([
                'opsiroles' => 'required',
            ],
            [
                'opsiroles.required' => 'The :attribute field is required.',
            ],
            ['opsiroles' => 'hak akses']);
            $users=User::whereIn('id', $this->checked)->get();
            foreach($users as $user)
            {
                $user->syncRoles([$this->opsiroles]);
            }
        }else{
            $this->validate([
                'password' => ['required','confirmed',Password::min(4)],
                'password_confirmation' => 'required',
                'opsiroles' => 'required',
            ],
            [
                'opsiroles.required' => 'The :attribute field is required.',
            ],
            ['opsiroles' => 'hak akses']);
            $users=User::whereIn('id', $this->checked)->get();
            foreach($users as $user)
            {
                $user->update(['password'=>Hash::make($this->password)]);
                $user->syncRoles([$this->opsiroles]);
            }
        }
        $this->resetForm();
        $this->alert('success', 'User berhasil diupdate');
        return redirect()->route('users');
    }

    public function edituser()
    {
        $cek_password=( is_null($this->password) || $this->password=="" ) ;       
        if($cek_password){
            $this->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $this->ids,
                'opsiroles' => 'required',
            ],
            [
                'opsiroles.required' => 'The :attribute field is required.',
            ],
            ['opsiroles' => 'hak akses']);
            $users=User::updateOrCreate(['id' => $this->ids], [
                'name' => $this->name,
                'email' => $this->email,
            ]);
        }else{
            $this->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $this->ids,
                'password' => ['required','confirmed',Password::min(4)],
                'password_confirmation' => 'required',
                'opsiroles' => 'required',
            ],
            [
                'opsiroles.required' => 'The :attribute field is required.',
            ],
            ['opsiroles' => 'hak akses']); 
            $users=User::updateOrCreate(['id' => $this->ids], [
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);
        }
        $users->syncRoles([$this->opsiroles]);
        $this->resetForm();
        $this->alert('success', 'User berhasil diupdate');
        return redirect()->route('users');
    }


    public function adduser(){
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required','confirmed',Password::min(4)],
            'password_confirmation' => 'required',
            'opsiroles' => 'required',
        ],
        [
            'opsiroles.required' => 'The :attribute field is required.',
        ],
        ['opsiroles' => 'hak akses']);
        $users=User::updateOrCreate(['id' => $this->ids], [
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'email_verified_at' => Carbon::now(),
        ]);
        
        $users->assignRole($this->opsiroles);
        $this->resetForm();
        $this->alert('success', 'User berhasil ditambahkan');
        return redirect()->route('users');
    }

    public function onAdd(){
        $this->mode='add';
        $this->dispatch('run_select2');
        $this->roles=Role::get();
        $this->resetForm();
    }
    
    public function onRead(){
        $this->mode='read';
        $this->resetForm();
    }

    public function onDelete($id){
        $this->ids=$id;
        $users = User::whereIn('id',[$id]);
        $this->confirm("Apakah anda yakin ingin hapus ?<p class='text-danger font-weight-bold'>".$users->pluck('name')->implode(',<br>')."</p>", 
        [
            'onConfirmed' => 'deluser'
        ]);
    }

    public function onEdit($id){
        $this->dispatch('run_select2');
        $this->roles=Role::get();
        $this->user_roles = User::findOrFail($id)->getRoleNames()->implode(',');
        $this->opsiroles = $this->user_roles;
        $this->mode='edit';
        $this->ids=$id;
        $user = User::findOrFail($id);
        $this->name = $user->name;
        $this->email = $user->email;       
    }

    public function onEditSelect(){
        $this->dispatch('run_select2');
        $this->mode='editselect';
        $this->roles=Role::get();
    }

    public function onDelSelect(){
        $this->mode='read';
        $users = User::whereIn('id',$this->checked);
        $this->confirm("Apakah anda yakin ingin hapus ?<p class='text-danger font-weight-bold'>".$users->pluck('name')->implode(', ')."</p>", 
        [
            'onConfirmed' => 'deluserselect'
        ]);
    }

    public function render()
    {
        $this->dispatch('run_select2');
        $data = [
            'user'=>$this->User,
            'Restoreuser'=>$this->Restoreuser,
        ];
        return view('livewire.backend.users',$data)->layout('layouts.app');
    }
}
