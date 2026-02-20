<?php

namespace App\Livewire\Admin;

use App\Models\Auther;
use Livewire\Component;
use Livewire\WithFileUploads;

class AutherCreate extends Component
{
    use WithFileUploads;

    public $name = '';

    public $bio = '';

    public $profile_photo_url;

    public $area_work = '';

    public $email = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'bio' => 'required|string',
        'profile_photo_url' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'area_work' => 'required|string|max:255',
        'email' => 'required|email|unique:authers,email',
    ];

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'bio' => $this->bio,
            'area_work' => $this->area_work,
            'email' => $this->email,
        ];

        if ($this->profile_photo_url) {
            $photoPath = $this->profile_photo_url->store('authers_photo', 'public');
            $data['profile_photo_url'] = $photoPath;
        }

        Auther::create($data);

        $this->reset();
        $this->dispatch('authorCreated');

        session()->flash('success', 'تم إضافة الكاتب بنجاح.');
    }

    public function render()
    {
        return view('livewire.admin.auther-create');
    }
}
