<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class ListUsers extends Component
{
    public $field = [];

    public $user;

    public $showEditModal = false;

    public $userIdBeingRemoved = null;

    public function addNew()
    {
        $this->field = [];
        $this->showEditModal = true;
        $this->dispatchBrowserEvent('show-form');
    }
    public function createUser()
    {
        $validatedData = Validator::make($this->field, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ])->validate();
        $validatedData['password'] = bcrypt($validatedData['password']);
        User::create($validatedData);
        // session()->flash('message', 'User added successfuly');
        $this->dispatchBrowserEvent('hide-form', ['message' => 'User added successfuly']);
    }
    public function edit(User $user)
    {
        $this->showEditModal = true;
        $this->user = $user;
        $this->field = $user->toArray();
        $this->dispatchBrowserEvent('show-form');
    }
    public function updateUser()
    {
        $validatedData = Validator::make($this->field, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'password' => 'sometimes|confirmed'
        ])->validate();
        if (!empty($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }
        $this->user->update($validatedData);
        // session()->flash('message', 'User added successfuly');
        $this->dispatchBrowserEvent('hide-form', ['message' => 'User updated successfuly']);
    }
    public function confirmDelete($id)
    {
        $this->userIdBeingRemoved = $id;
        $this->dispatchBrowserEvent('show-delete-modal');
    }
    public function deleteUser()
    {
        $user = User::findOrFail($this->userIdBeingRemoved);
        $user->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'User delete successfuly']);
    }
    public function render()
    {
        $users = User::latest()->paginate();
        return view('livewire.admin.users.list-users', ['users' => $users]);
    }
}
