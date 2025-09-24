<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\SchemaOrg\Schema;

class Services extends Component
{
    public function render()
    {
        seo()
            ->title($title = 'Serviços - Global SST | PCMSO, PGR, LTCAT, eSocial')
            ->description($description = 'Serviços completos em SST: PCMSO, PGR, LTCAT, PPP, eSocial, Treinamentos e muito mais. Especialistas em Saúde e Segurança do Trabalho.')
            ->canonical($url = route('services'))
            ->addSchema(
                Schema::service()
                    ->name('Consultoria em Saúde e Segurança do Trabalho')
                    ->description($description)
                    ->provider(
                        Schema::organization()
                            ->name('Global SST')
                            ->url(route('home'))
                    )
                    ->serviceType('Consultoria SST')
            );

        $services = [
            [
                'id' => 'pcmso',
                'title' => 'PCMSO',
                'subtitle' => 'Programa de Controle Médico de Saúde Ocupacional',
                'description' => 'Programa completo de medicina ocupacional com exames periódicos, admissionais e demissionais.',
                'details' => [
                    'Exames admissionais, periódicos e demissionais',
                    'Relatórios médicos especializados',
                    'Acompanhamento de funcionários expostos a riscos',
                    'Integração com eSocial',
                    'Prontuário eletrônico seguro'
                ],
                'icon' => 'medical',
                'color' => 'blue',
                'price_range' => 'A partir de R$ 50,00 por funcionário'
            ],
            [
                'id' => 'pgr',
                'title' => 'PGR',
                'subtitle' => 'Programa de Gerenciamento de Riscos',
                'description' => 'Identificação, avaliação e controle de todos os riscos ocupacionais do ambiente de trabalho.',
                'details' => [
                    'Levantamento completo de riscos',
                    'Análise qualitativa e quantitativa',
                    'Plano de ação com cronograma',
                    'Treinamento da equipe interna',
                    'Revisão anual obrigatória'
                ],
                'icon' => 'shield',
                'color' => 'green',
                'price_range' => 'A partir de R$ 1.500,00'
            ],
            [
                'id' => 'ltcat',
                'title' => 'LTCAT',
                'subtitle' => 'Laudo Técnico das Condições Ambientais do Trabalho',
                'description' => 'Caracterização das condições ambientais para aposentadoria especial e PPP.',
                'details' => [
                    'Análise de agentes nocivos',
                    'Medições instrumentais',
                    'Caracterização para aposentadoria especial',
                    'Base técnica para PPP',
                    'Laudo assinado por engenheiro'
                ],
                'icon' => 'document',
                'color' => 'purple',
                'price_range' => 'A partir de R$ 800,00'
            ],
            [
                'id' => 'ppp',
                'title' => 'PPP',
                'subtitle' => 'Perfil Profissiográfico Previdenciário',
                'description' => 'Documento obrigatório para comprovação de exposição a agentes nocivos.',
                'details' => [
                    'Histórico laboral completo',
                    'Registro de exposições',
                    'Base para aposentadoria especial',
                    'Integração com eSocial',
                    'Emissão rápida e segura'
                ],
                'icon' => 'profile',
                'color' => 'indigo',
                'price_range' => 'R$ 45,00 por PPP'
            ],
            [
                'id' => 'esocial',
                'title' => 'eSocial',
                'subtitle' => 'Integração e Compliance',
                'description' => 'Adequação completa ao sistema eSocial com envio automatizado de informações.',
                'details' => [
                    'Configuração do sistema',
                    'Envio de eventos obrigatórios',
                    'Monitoramento de pendências',
                    'Correção de inconsistências',
                    'Suporte técnico contínuo'
                ],
                'icon' => 'network',
                'color' => 'orange',
                'price_range' => 'A partir de R$ 300,00/mês'
            ],
            [
                'id' => 'treinamentos',
                'title' => 'Treinamentos',
                'subtitle' => 'Capacitação em SST',
                'description' => 'Treinamentos presenciais e EAD para capacitação de colaboradores.',
                'details' => [
                    'NRs obrigatórias (NR-10, NR-35, etc.)',
                    'SIPAT e campanhas educativas',
                    'Treinamentos personalizados',
                    'Certificados digitais',
                    'Plataforma EAD própria'
                ],
                'icon' => 'education',
                'color' => 'teal',
                'price_range' => 'A partir de R$ 80,00 por pessoa'
            ]
        ];

        return view('livewire.services', compact('services'));
    }
}