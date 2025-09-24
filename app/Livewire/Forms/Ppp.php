<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use Spatie\SchemaOrg\Schema;
use App\Models\PppRequest;
use App\Models\User;

class Ppp extends Component
{
    // Dados da Empresa
    public $company_name = '';
    public $cnpj = '';
    public $company_phone = '';
    public $company_email = '';

    // Dados do Funcionário
    public $employee_name = '';
    public $cpf = '';
    public $birth_date = '';
    public $admission_date = '';
    public $dismissal_date = '';
    public $job_position = '';

    // Dados da Solicitação
    public $request_reason = '';
    public $period_start = '';
    public $period_end = '';
    public $observations = '';

    // Urgência
    public $is_urgent = false;
    public $urgency_reason = '';

    public $showSuccessMessage = false;

    protected $rules = [
        'company_name' => 'required|min:2',
        'cnpj' => 'required|min:14',
        'company_phone' => 'required|min:10',
        'company_email' => 'required|email',
        'employee_name' => 'required|min:3',
        'cpf' => 'required|min:11',
        'birth_date' => 'required|date',
        'admission_date' => 'required|date',
        'job_position' => 'required|min:2',
        'request_reason' => 'required',
        'period_start' => 'required|date',
        'period_end' => 'required|date|after:period_start',
        'urgency_reason' => 'required_if:is_urgent,true'
    ];

    protected $messages = [
        'company_name.required' => 'Nome da empresa é obrigatório',
        'cnpj.required' => 'CNPJ é obrigatório',
        'company_phone.required' => 'Telefone da empresa é obrigatório',
        'company_email.required' => 'E-mail da empresa é obrigatório',
        'company_email.email' => 'Digite um e-mail válido',
        'employee_name.required' => 'Nome do funcionário é obrigatório',
        'cpf.required' => 'CPF é obrigatório',
        'birth_date.required' => 'Data de nascimento é obrigatória',
        'admission_date.required' => 'Data de admissão é obrigatória',
        'job_position.required' => 'Cargo é obrigatório',
        'request_reason.required' => 'Motivo da solicitação é obrigatório',
        'period_start.required' => 'Data inicial do período é obrigatória',
        'period_end.required' => 'Data final do período é obrigatória',
        'period_end.after' => 'Data final deve ser posterior à data inicial',
        'urgency_reason.required_if' => 'Justificativa da urgência é obrigatória'
    ];

    public function submit()
    {
        $this->validate();

        try {
            $user = $this->findOrCreateUser();

            $price = $this->is_urgent ? 300.00 : 200.00;

            PppRequest::create([
                'user_id' => $user->id,
                'company_name' => $this->company_name,
                'cnpj' => $this->cnpj,
                'company_phone' => $this->company_phone,
                'company_email' => $this->company_email,
                'employee_name' => $this->employee_name,
                'cpf' => $this->cpf,
                'birth_date' => $this->birth_date,
                'admission_date' => $this->admission_date,
                'dismissal_date' => $this->dismissal_date,
                'job_position' => $this->job_position,
                'request_reason' => $this->request_reason,
                'period_start' => $this->period_start,
                'period_end' => $this->period_end,
                'observations' => $this->observations,
                'is_urgent' => $this->is_urgent,
                'urgency_reason' => $this->urgency_reason,
                'status' => 'pending',
                'price' => $price
            ]);

            $this->showSuccessMessage = true;

            $this->reset();

            session()->flash('success', 'Solicitação de PPP enviada com sucesso! Nossa equipe entrará em contato em breve.');

        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao enviar solicitação. Tente novamente ou entre em contato via WhatsApp.');
        }
    }

    public function render()
    {
        seo()
            ->title($title = 'Solicitação de PPP - Global SST')
            ->description($description = 'Formulário para solicitação do Perfil Profissiográfico Previdenciário (PPP). Atendimento especializado pela Global SST.')
            ->canonical($url = route('forms.ppp'))
            ->addSchema(
                Schema::webPage()
                    ->name($title)
                    ->description($description)
                    ->url($url)
            );

        return view('livewire.forms.ppp');
    }

    private function findOrCreateUser()
    {
        $user = User::where('email', $this->company_email)->first();

        if (!$user) {
            $user = User::create([
                'name' => $this->company_name,
                'email' => $this->company_email,
                'password' => bcrypt('password123'),
                'role' => 'client',
                'phone' => $this->company_phone,
                'company_name' => $this->company_name,
                'cnpj' => $this->cnpj
            ]);
        }

        return $user;
    }
}