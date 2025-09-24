<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\CatRequest;
use App\Models\PppRequest;
use App\Models\Billing;
use Spatie\SchemaOrg\Schema;

class Dashboard extends Component
{
    public function mount()
    {
        if (!Auth::check() || Auth::user()->role !== 'client') {
            return redirect()->route('client.login');
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('home');
    }

    public function render()
    {
        $user = Auth::user();

        $catRequests = CatRequest::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $pppRequests = PppRequest::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $billings = Billing::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $stats = [
            'cat_total' => CatRequest::where('user_id', $user->id)->count(),
            'ppp_total' => PppRequest::where('user_id', $user->id)->count(),
            'billings_pending' => Billing::where('user_id', $user->id)->where('status', 'pending')->count(),
            'billings_overdue' => Billing::where('user_id', $user->id)->where('status', 'pending')->where('due_date', '<', now())->count(),
        ];

        seo()
            ->title($title = 'Dashboard - Área do Cliente - Global SST')
            ->description($description = 'Acompanhe suas solicitações de CAT, PPP e cobranças na área do cliente da Global SST.')
            ->canonical($url = route('client.dashboard'))
            ->addSchema(
                Schema::webPage()
                    ->name($title)
                    ->description($description)
                    ->url($url)
            );

        return view('livewire.client.dashboard', compact('catRequests', 'pppRequests', 'billings', 'stats'));
    }
}