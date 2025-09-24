<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\SchemaOrg\Schema;

class About extends Component
{
    public function render()
    {
        seo()
            ->title($title = 'Sobre Nós - Global SST')
            ->description($description = 'Conheça a Global SST, empresa especializada em consultoria de SST há mais de 10 anos. Nossa missão é tornar sua empresa mais segura e produtiva.')
            ->canonical($url = route('about'))
            ->addSchema(
                Schema::organization()
                    ->name('Global SST')
                    ->description($description)
                    ->url($url)
                    ->foundingDate('2013')
                    ->numberOfEmployees('15-25')
                    ->contactPoint(
                        Schema::contactPoint()
                            ->telephone('+55-11-99999-9999')
                            ->contactType('Customer Service')
                    )
            );

        return view('livewire.about');
    }
}