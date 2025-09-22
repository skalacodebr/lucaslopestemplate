<?php

use App\Livewire\Home;
use App\Livewire\Post\Show as PostShow;
use App\Livewire\LiveQueue;
use App\Livewire\ScheduledConsultation;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/article/{post:slug}', PostShow::class)->name('post.show');

// Simple login for testing
Route::get('/test-login', function () {
    $user = \App\Models\User::first();
    auth()->login($user);
    return redirect('/telemedicine/dashboard');
})->name('test.login');

// Patient login for testing
Route::get('/patient-login', function () {
    $user = \App\Models\User::where('email', 'joao@paciente.com')->first();
    if ($user) {
        auth()->login($user);
        return redirect('/consultation/live-queue');
    }
    return 'Patient user not found';
})->name('patient.login');

// Debug route for live queue
Route::get('/debug-queue', function () {
    return view('debug-queue');
})->middleware('auth');

// Telemedicine routes
Route::middleware(['auth'])->group(function () {
    Route::get('/telemedicine/dashboard', function () {
        $stats = [
            'total_consultations' => 12,
            'active_patients' => \App\Models\User::whereHas('roles', function($q) {
                $q->where('slug', 'patient');
            })->count(),
            'total_revenue' => 15250.75,
            'satisfaction_rate' => 94.8,
        ];

        $professionals = \App\Models\ProfessionalProfile::with(['user.profile'])
            ->where('is_verified', true)
            ->where('is_available', true)
            ->where('status', 'active')
            ->orderBy('rating', 'desc')
            ->limit(6)
            ->get();

        return view('telemedicine.dashboard', compact('stats', 'professionals'));
    })->name('telemedicine.dashboard');

    // Consultation routes
    Route::get('/consultation/live-queue', LiveQueue::class)->name('consultation.live-queue');
    Route::get('/consultation/schedule', ScheduledConsultation::class)->name('consultation.schedule');
    Route::get('/consultation/{consultation}/call', \App\Livewire\VideoCall::class)->name('consultation.call');
});
