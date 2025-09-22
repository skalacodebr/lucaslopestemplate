@props([
    'background' => 'white', // white, gray, dark, primary, gradient
    'padding' => 'normal', // tight, normal, loose
    'containerSize' => 'default', // default, wide, narrow
])

@php
$backgrounds = [
    'white' => 'bg-white',
    'gray' => 'bg-neutral-50',
    'dark' => 'bg-neutral-900 text-white',
    'primary' => 'bg-primary-600 text-white',
    'gradient' => 'bg-gradient-to-br from-primary-600 to-primary-800 text-white',
];

$paddings = [
    'tight' => 'py-12',
    'normal' => 'py-20',
    'loose' => 'py-32',
];

$backgroundClasses = $backgrounds[$background] ?? $backgrounds['white'];
$paddingClasses = $paddings[$padding] ?? $paddings['normal'];

$classes = "{$backgroundClasses} {$paddingClasses}";
@endphp

<section {{ $attributes->merge(['class' => $classes]) }}>
  @if($containerSize === 'narrow')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
  @elseif($containerSize === 'wide')
    <div class="max-w-9xl mx-auto px-4 sm:px-6 lg:px-8">
  @else
    <x-container>
  @endif

    {{ $slot }}

  @if($containerSize === 'narrow' || $containerSize === 'wide')
    </div>
  @else
    </x-container>
  @endif
</section>