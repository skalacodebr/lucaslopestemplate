<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\SchemaOrg\Schema;

class Cases extends Component
{
    public function render()
    {
        seo()
            ->title($title = 'Cases de Sucesso - Skala Code | Projetos que Transformaram Negócios')
            ->description($description = 'Conheça os cases de sucesso da Skala Code: projetos reais que geraram resultados excepcionais para nossos clientes em outsourcing de TI e desenvolvimento de software.')
            ->canonical($url = route('cases'))
            ->addSchema(
                Schema::webPage()
                    ->name($title)
                    ->description($description)
                    ->url($url)
                    ->author(Schema::organization()->name('Skala Code'))
            );

        $cases = [
            [
                'title' => 'E-commerce B2B - Aumento de 300% nas Vendas',
                'client' => 'TechDistribuidora',
                'sector' => 'Distribuição',
                'challenge' => 'Processo manual de vendas, sem integração com ERP',
                'solution' => 'Plataforma completa de e-commerce B2B com IA para recomendações',
                'results' => [
                    'Aumento de 300% nas vendas online',
                    'Redução de 50% no tempo de pedidos',
                    'ROI de 400% em 8 meses',
                    '95% de satisfação dos clientes'
                ],
                'technologies' => ['Laravel', 'Vue.js', 'IA/ML', 'API REST'],
                'timeline' => '4 meses',
                'image' => 'ecommerce-case.jpg'
            ],
            [
                'title' => 'Sistema de Gestão Hospitalar - 40% Mais Eficiência',
                'client' => 'Hospital São Lucas',
                'sector' => 'Saúde',
                'challenge' => 'Gestão de pacientes descentralizada, perda de dados',
                'solution' => 'Sistema integrado de gestão hospitalar com prontuário eletrônico',
                'results' => [
                    '40% aumento na eficiência operacional',
                    '100% digitalização dos prontuários',
                    'Redução de 60% em erros médicos',
                    'Conformidade com LGPD'
                ],
                'technologies' => ['Laravel', 'MySQL', 'PWA', 'APIs FHIR'],
                'timeline' => '6 meses',
                'image' => 'hospital-case.jpg'
            ],
            [
                'title' => 'FinTech - Plataforma de Investimentos para 50k Usuários',
                'client' => 'InvestSmart',
                'sector' => 'Fintech',
                'challenge' => 'Escalar plataforma para milhares de usuários simultâneos',
                'solution' => 'Arquitetura de microserviços com alta disponibilidade',
                'results' => [
                    '50.000+ usuários ativos',
                    '99.9% de uptime',
                    'R$ 100M+ movimentados',
                    'Expansão para 3 países'
                ],
                'technologies' => ['Laravel', 'Redis', 'Queue Jobs', 'Docker'],
                'timeline' => '8 meses',
                'image' => 'fintech-case.jpg'
            ]
        ];

        return view('livewire.cases', compact('cases'));
    }
}