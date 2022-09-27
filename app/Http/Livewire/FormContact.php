<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Livewire\Component;

class FormContact extends Component
{
    public $name;
    public $email;
    public $phone;
    public $quero_maquininha;
    public $quero_vender_online;
    public $form;

    public $open = false;
    public $success = false;

    public function mount($form = Contact::FORM_PECA_SUA)
    {
        $this->form = $form;
    }

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'phone' => 'required|min:4',
        'quero_maquininha' => 'nullable',
        'quero_vender_online' => 'nullable'
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
            'quero_maquininha' => $this->quero_maquininha ?: 'no',
            'quero_vender_online' => $this->quero_vender_online ?: 'no',
            'form' => $this->form
        ]);

        $this->success = true;
    }

    public function render()
    {
        return view('livewire.form-contact');
    }
}
