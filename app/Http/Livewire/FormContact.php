<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Livewire\Component;

class FormContact extends Component
{
    public $name;
    public $email;
    public $phone;
    public $mobileOptIn;
    public $emailOptIn;

    public $open = false;
    public $success = false;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'phone' => 'required|min:4',
        'mobileOptIn' => 'nullable',
        'emailOptIn' => 'nullable'
    ];

    protected $messages = [
        'name.required' => 'O nome é obrigatório',
        'email.required' => 'O email é obrigatório',
        'email.email' => 'O email está com formato incorreto',
        'phone.required' => 'O telefone é obrigatório',
    ];

    public function submit()
    {
        $this->validate();

        Contact::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'mobileOptIn' => $this->mobileOptIn ?: 'no',
            'emailOptIn' => $this->emailOptIn ?: 'no'
        ]);

        $this->success = true;
    }

    public function render()
    {
        return view('livewire.form-contact');
    }
}
