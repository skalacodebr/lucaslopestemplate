<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\SchemaOrg\Schema;

class Sobre extends Component
{
    public function render()
    {
        seo()
            ->title($title = 'Sobre a Skala Code - Especialistas em Transformação Digital')
            ->description($description = 'Conheça a Skala Code: empresa especializada em outsourcing de TI, desenvolvimento de software e soluções com IA. Transformamos negócios através da tecnologia.')
            ->canonical($url = route('sobre'))
            ->addSchema(
                Schema::organization()
                    ->name('Skala Code')
                    ->description($description)
                    ->url($url)
                    ->logo(asset('images/logo.png'))
                    ->address(
                        Schema::postalAddress()
                            ->streetAddress('Rua da Inovação, 123')
                            ->addressLocality('São Paulo')
                            ->addressRegion('SP')
                            ->postalCode('01234-567')
                            ->addressCountry('BR')
                    )
                    ->contactPoint(
                        Schema::contactPoint()
                            ->telephone('+55-11-99999-9999')
                            ->contactType('customer service')
                            ->email('contato@skalacode.com.br')
                    )
            );

        return view('livewire.sobre');
    }
}