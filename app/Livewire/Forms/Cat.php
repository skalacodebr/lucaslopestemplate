<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\SchemaOrg\Schema;
use App\Models\CatRequest;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class Cat extends Component
{
    use WithFileUploads;

    // Dados da Empresa
    public $company_name = '';
    public $cnpj = '';
    public $company_phone = '';
    public $company_email = '';
    public $company_address = '';

    // Dados do Acidentado
    public $employee_name = '';
    public $cpf = '';
    public $birth_date = '';
    public $job_position = '';
    public $admission_date = '';
    public $employee_phone = '';

    // Dados do Acidente
    public $accident_date = '';
    public $accident_time = '';
    public $accident_location = '';
    public $accident_description = '';
    public $injury_type = '';
    public $injured_body_part = '';
    public $witnesses = '';

    // Atendimento Médico
    public $medical_care = false;
    public $hospital_name = '';
    public $doctor_name = '';
    public $medical_report = '';

    // Anexos
    public $attachments = [];

    public $showSuccessMessage = false;

    protected $rules = [
        'company_name' => 'required|min:2',
        'cnpj' => 'required|min:14',
        'company_phone' => 'required|min:10',
        'company_email' => 'required|email',
        'company_address' => 'required|min:10',
        'employee_name' => 'required|min:3',
        'cpf' => 'required|min:11',
        'birth_date' => 'required|date',
        'job_position' => 'required|min:2',
        'admission_date' => 'required|date',
        'employee_phone' => 'required|min:10',
        'accident_date' => 'required|date',
        'accident_time' => 'required',
        'accident_location' => 'required|min:5',
        'accident_description' => 'required|min:20',
        'injury_type' => 'required',
        'injured_body_part' => 'required',
        'medical_care' => 'boolean',
        'hospital_name' => 'required_if:medical_care,true',
        'doctor_name' => 'required_if:medical_care,true',
        'attachments.*' => 'file|max:10240' // 10MB max por arquivo
    ];

    protected $messages = [
        'company_name.required' => 'Nome da empresa é obrigatório',
        'cnpj.required' => 'CNPJ é obrigatório',
        'company_phone.required' => 'Telefone da empresa é obrigatório',
        'company_email.required' => 'E-mail da empresa é obrigatório',
        'company_email.email' => 'Digite um e-mail válido',
        'company_address.required' => 'Endereço da empresa é obrigatório',
        'employee_name.required' => 'Nome do funcionário é obrigatório',
        'cpf.required' => 'CPF é obrigatório',
        'birth_date.required' => 'Data de nascimento é obrigatória',
        'job_position.required' => 'Cargo é obrigatório',
        'admission_date.required' => 'Data de admissão é obrigatória',
        'employee_phone.required' => 'Telefone do funcionário é obrigatório',
        'accident_date.required' => 'Data do acidente é obrigatória',
        'accident_time.required' => 'Horário do acidente é obrigatório',
        'accident_location.required' => 'Local do acidente é obrigatório',
        'accident_description.required' => 'Descrição do acidente é obrigatória',
        'accident_description.min' => 'Descrição deve ter pelo menos 20 caracteres',
        'injury_type.required' => 'Tipo de lesão é obrigatório',
        'injured_body_part.required' => 'Parte do corpo atingida é obrigatória',
        'hospital_name.required_if' => 'Nome do hospital é obrigatório quando houve atendimento médico',
        'doctor_name.required_if' => 'Nome do médico é obrigatório quando houve atendimento médico',
        'attachments.*.max' => 'Cada arquivo deve ter no máximo 10MB'
    ];

    public function submit()
    {
        $this->validate();

        try {
            $user = $this->findOrCreateUser();

            $attachmentPaths = $this->handleAttachments();

            CatRequest::create([
                'user_id' => $user->id,
                'company_name' => $this->company_name,
                'cnpj' => $this->cnpj,
                'company_phone' => $this->company_phone,
                'company_email' => $this->company_email,
                'company_address' => $this->company_address,
                'employee_name' => $this->employee_name,
                'cpf' => $this->cpf,
                'birth_date' => $this->birth_date,
                'job_position' => $this->job_position,
                'admission_date' => $this->admission_date,
                'employee_phone' => $this->employee_phone,
                'accident_date' => $this->accident_date,
                'accident_time' => $this->accident_time,
                'accident_location' => $this->accident_location,
                'accident_description' => $this->accident_description,
                'injury_type' => $this->injury_type,
                'injured_body_part' => $this->injured_body_part,
                'witnesses' => $this->witnesses,
                'medical_care' => $this->medical_care,
                'hospital_name' => $this->hospital_name,
                'doctor_name' => $this->doctor_name,
                'medical_report' => $this->medical_report,
                'attachments' => $attachmentPaths,
                'status' => 'pending'
            ]);

            $this->showSuccessMessage = true;

            $this->reset();

            session()->flash('success', 'CAT enviada com sucesso! Nossa equipe entrará em contato em breve.');

        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao enviar CAT. Tente novamente ou entre em contato via WhatsApp.');
        }
    }

    public function render()
    {
        seo()
            ->title($title = 'Abertura de CAT - Global SST')
            ->description($description = 'Formulário para abertura de Comunicação de Acidente do Trabalho (CAT). Atendimento especializado pela Global SST.')
            ->canonical($url = route('forms.cat'))
            ->addSchema(
                Schema::webPage()
                    ->name($title)
                    ->description($description)
                    ->url($url)
            );

        return view('livewire.forms.cat');
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
                'cnpj' => $this->cnpj,
                'address' => $this->company_address
            ]);
        }

        return $user;
    }

    private function handleAttachments()
    {
        $attachmentPaths = [];

        if ($this->attachments) {
            foreach ($this->attachments as $attachment) {
                $path = $attachment->store('cat-attachments', 'public');
                $attachmentPaths[] = $path;
            }
        }

        return json_encode($attachmentPaths);
    }
}