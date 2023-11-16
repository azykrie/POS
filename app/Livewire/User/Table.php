<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    public $name;
    public $email;
    public $password;
    public $role;
    public $user_id;
    public $search;
    use WithPagination;

    public function create()
    {
        $data = $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'required|min:3',
            'role' => 'required',
        ]);

        $data['password'] = bcrypt($data['password']);

        User::create($data);
        session()->flash('success', 'User has been created successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;

        $this->dispatch('show-edit-user-modal');
    }

    public function update()
    {
        $user = User::findOrFail($this->user_id);

        $data = $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'nullable|min:3', // Dijadikan nullable karena kata sandi tidak selalu diubah
            'role' => 'required',
        ]);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->role = $data['role'];

        // Periksa apakah ada perubahan pada kata sandi
        if ($data['password']) {
            $user->password = bcrypt($data['password']);
        }

        $user->save();

        session()->flash('message', 'User has been updated successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function delete($id)
    {
        User::find($id)->delete();
    }

    public function resetInput()
    {
        $this->reset('name', 'email', 'role', 'password');
    }

    public function render()
    {
        return view('livewire.user.table', [
            'users' => User::latest()->where('name', 'like', "%{$this->search}%")->paginate(5)
        ]);
    }
}
