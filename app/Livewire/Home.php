<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Spatie\SchemaOrg\Schema;

class Home extends Component
{
    public function render()
    {
        seo()
            ->title($title = 'Global SST - Consultoria em Saúde e Segurança do Trabalho')
            ->description($description = 'Soluções personalizadas em saúde e segurança do trabalho para seu negócio. Especialistas em engenharia de segurança e medicina do trabalho há mais de 10 anos.')
            ->canonical($url = route('home'))
            ->addSchema(
                Schema::organization()
                    ->name('Global SST')
                    ->description($description)
                    ->url($url)
                    ->contactPoint(
                        Schema::contactPoint()
                            ->telephone('+55-11-99999-9999')
                            ->contactType('Customer Service')
                    )
            );

        // Buscar últimas 3 notícias para seção de novidades
        $latestNews = Post::published()
            ->latest('published_at')
            ->limit(3)
            ->get();

        return view('livewire.home', compact('latestNews'));
    }
}
