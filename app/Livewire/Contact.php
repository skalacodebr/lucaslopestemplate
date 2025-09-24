<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\SchemaOrg\Schema;
use Illuminate\Support\Facades\Mail;

class Contact extends Component
{
    public $name = '';
    public $email = '';
    public $phone = '';
    public $company = '';
    public $subject = '';
    public $message = '';
    public $service = '';

    public $showSuccessMessage = false;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'phone' => 'required|min:10',
        'company' => 'required|min:2',
        'subject' => 'required|min:5',
        'message' => 'required|min:10',
        'service' => 'nullable'
    ];

    protected $messages = [
        'name.required' => 'O nome é obrigatório.',
        'name.min' => 'O nome deve ter pelo menos 3 caracteres.',
        'email.required' => 'O e-mail é obrigatório.',
        'email.email' => 'Digite um e-mail válido.',
        'phone.required' => 'O telefone é obrigatório.',
        'phone.min' => 'O telefone deve ter pelo menos 10 caracteres.',
        'company.required' => 'A empresa é obrigatória.',
        'company.min' => 'O nome da empresa deve ter pelo menos 2 caracteres.',
        'subject.required' => 'O assunto é obrigatório.',
        'subject.min' => 'O assunto deve ter pelo menos 5 caracteres.',
        'message.required' => 'A mensagem é obrigatória.',
        'message.min' => 'A mensagem deve ter pelo menos 10 caracteres.',
    ];

    public function submit()
    {
        $this->validate();

        // Aqui você pode implementar o envio do e-mail
        // Por enquanto, vamos apenas mostrar mensagem de sucesso
        try {
            // Simulação de envio - implementar com Mail::send() depois
            $this->showSuccessMessage = true;
            $this->reset(['name', 'email', 'phone', 'company', 'subject', 'message', 'service']);

            session()->flash('success', 'Mensagem enviada com sucesso! Entraremos em contato em breve.');

        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao enviar mensagem. Tente novamente ou entre em contato via WhatsApp.');
        }
    }

    public function render()
    {
        seo()
            ->title($title = 'Contato - Global SST')
            ->description($description = 'Entre em contato com a Global SST. Solicite orçamentos, tire dúvidas sobre nossos serviços de SST. Atendimento especializado.')
            ->canonical($url = route('contact'))
            ->addSchema(
                Schema::contactPage()
                    ->name($title)
                    ->description($description)
                    ->url($url)
            );

        return view('livewire.contact');
    }
}