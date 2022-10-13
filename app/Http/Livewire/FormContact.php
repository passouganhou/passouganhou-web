<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use App\Services\CrmService;
use Livewire\Component;

class FormContact extends Component
{
    public $name;
    public $email;
    public $phone;
    public $type;
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
        'type' => 'required',

    ];
    protected $messages = [
        'name.required' => 'O nome é obrigatório',
        'email.required' => 'O email é obrigatório',
        'email.email' => 'O email está com formato incorreto',
        'phone.required' => 'O telefone é obrigatório',
        'type.required' => 'Escolha uma das opções de contato'
    ];

    public function submit()
    {
        $this->validate();

        Contact::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'type' => $this->type,
            'form' => $this->form
        ]);


        $service = new CrmService([
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->phone,
        ]);

        $service->serviceId($this->type === 'Quero minha maquininha' ? '6B606634-B049-4AAD-9E7E-D5E5198D9D72' : 'B652DE37-FD3C-4C22-877E-FF92DFFDFF07')
            ->send();

        $this->success = true;
    }

    public function render()
    {
        return view('livewire.form-contact');
    }
}
