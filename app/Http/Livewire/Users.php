<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Models\User as MUsers;

class Users extends Component
{

    public $users, $name, $email, $password, $userId, $updateUser = false, $addUser = false, $ListUsers = false;

    /**
     * delete action listener
     */
    protected $listeners = [
        'deleteUserListner' => 'deleteUser'
    ];

    /**
     * List of add/edit form rules 
     */
    protected $rules = [
        'name' => 'required',
        'email' => 'required',
        'password' => 'required'

    ];

    /**
     * Reseting all inputted fields
     * @return void
     */
    public function resetFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
    }

    /**
     * render the post data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        $this->ListUsers = true;
        // $this->addUser = false;
        // $this->updateUser = false;

        $this->users = MUsers::get();
        return view('livewire.users');
    }

    public function addUser()
    {
        $this->resetFields();
        $this->addUser = true;
        $this->updateUser = false;
        $this->ListUsers = false;
    }

    public function storeUser()
    {
        $this->validate();
        try {
            MUsers::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password)
            ]);
            session()->flash('success', 'User Created Successfully!!');
            $this->resetFields();
            $this->addUser = false;
            $this->updateUser = false;
            $this->ListUsers = false;
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
    }

    public function editUser($id)
    {
        try {
            $user = MUsers::findOrFail($id);
            if (!$user) {
                session()->flash('error', 'User not found');
            } else {
                $this->name = $user->name;
                $this->email = $user->email;
                $this->userId = $user->id;
                $this->updateUser = true;
                $this->addUser = false;
                $this->ListUsers = true;
            }
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
    }

    public function updateUser()
    {
        $this->validate();
        try {

            $Data = [
                'name' => $this->name,
                'email' => $this->email,
            ];

            if ($this->password != '') {
                $Data['password'] = Hash::make($this->password);
            }

            MUsers::whereId($this->userId)->update($Data);

            session()->flash('success', 'User Updated Successfully!!');
            $this->resetFields();
            $this->updateUser = false;
            $this->addUser = false;
            $this->ListUsers = true;
        } catch (\Exception $ex) {
            session()->flash('success', 'Something goes wrong!!');
        }
    }

    public function deleteUser($id)
    {
        try {
            MUsers::find($id)->delete();
            session()->flash('success', "User Deleted Successfully!!");
            $this->ListUsers = true;
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
}
