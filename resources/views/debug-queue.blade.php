@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Debug Live Queue</h1>

    <div class="mb-8">
        <h2 class="text-xl font-semibold mb-4">User Info:</h2>
        <p>Logged in as: {{ auth()->user()->name }}</p>
        <p>User ID: {{ auth()->user()->id }}</p>
    </div>

    <div class="mb-8">
        <h2 class="text-xl font-semibold mb-4">Component Test:</h2>
        @livewire('live-queue')
    </div>
</div>
@endsection