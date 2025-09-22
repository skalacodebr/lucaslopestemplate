<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\SchemaOrg\Schema;

class Contato extends Component
{
    public $nome = '';
    public $email = '';
    public $empresa = '';
    public $telefone = '';
    public $servico = '';
    public $mensagem = '';
    public $enviado = false;

    protected $rules = [
        'nome' => 'required|min:2',
        'email' => 'required|email',
        'empresa' => 'required|min:2',
        'telefone' => 'required|min:10',
        'servico' => 'required',
        'mensagem' => 'required|min:10',
    ];

    protected $messages = [
        'nome.required' => 'O nome é obrigatório.',
        'nome.min' => 'O nome deve ter pelo menos 2 caracteres.',
        'email.required' => 'O email é obrigatório.',
        'email.email' => 'Digite um email válido.',
        'empresa.required' => 'O nome da empresa é obrigatório.',
        'empresa.min' => 'O nome da empresa deve ter pelo menos 2 caracteres.',
        'telefone.required' => 'O telefone é obrigatório.',
        'telefone.min' => 'Digite um telefone válido.',
        'servico.required' => 'Selecione um serviço.',
        'mensagem.required' => 'A mensagem é obrigatória.',
        'mensagem.min' => 'A mensagem deve ter pelo menos 10 caracteres.',
    ];

    public function enviarContato()
    {
        $this->validate();

        // Aqui você integraria com um serviço de email ou CRM
        // Por exemplo: Mail::to('contato@skalacode.com.br')->send(new ContatoMail($this->all()));

        // Simular envio
        $this->enviado = true;

        // Reset form
        $this->reset(['nome', 'email', 'empresa', 'telefone', 'servico', 'mensagem']);
    }

    public function render()
    {
        seo()
            ->title($title = 'Contato - Skala Code | Fale com Nossos Especialistas')
            ->description($description = 'Entre em contato com a Skala Code para discutir seu projeto. Nossos especialistas estão prontos para ajudar sua empresa a crescer com tecnologia.')
            ->canonical($url = route('contato'))
            ->addSchema(
                Schema::contactPage()
                    ->name($title)
                    ->description($description)
                    ->url($url)
                    ->author(Schema::organization()->name('Skala Code'))
            );

        return view('livewire.contato');
    }
}