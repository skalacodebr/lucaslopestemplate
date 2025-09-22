<?php

namespace App\Livewire;

use Livewire\Component;

class SalesForecast extends Component
{
    public function render()
    {
        seo()
            ->title('Sales Forecast com IA - Previsão de Vendas 95% Precisa | Skala Code')
            ->description('Transforme suas vendas com IA. Nossa solução de Sales Forecast entrega previsões com 95% de precisão, otimiza estoques e aumenta lucratividade. Demonstração gratuita.')
            ->keywords(['sales forecast', 'previsão de vendas', 'inteligência artificial', 'IA vendas', 'otimização estoque', 'análise preditiva'])
            ->canonical(url()->current());

        return view('livewire.sales-forecast')
            ->layout('components.layouts.app');
    }
}
