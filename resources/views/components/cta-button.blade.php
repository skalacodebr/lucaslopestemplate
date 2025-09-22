@props([
    'variant' => 'primary', // primary, secondary, outline, ghost
    'size' => 'md', // sm, md, lg, xl
    'href' => null,
    'icon' => null,
    'iconPosition' => 'left', // left, right
    'loading' => false,
    'disabled' => false,
])

@php
$variants = [
    'primary' => 'bg-primary-600 hover:bg-primary-700 text-white shadow-medium hover:shadow-hard',
    'secondary' => 'bg-secondary-600 hover:bg-secondary-700 text-white shadow-medium hover:shadow-hard',
    'outline' => 'border-2 border-primary-600 text-primary-600 hover:bg-primary-600 hover:text-white',
    'ghost' => 'text-primary-600 hover:bg-primary-50',
];

$sizes = [
    'sm' => 'px-4 py-2 text-sm',
    'md' => 'px-6 py-3 text-base',
    'lg' => 'px-8 py-4 text-lg',
    'xl' => 'px-10 py-5 text-xl',
];

$baseClasses = 'inline-flex items-center justify-center font-semibold rounded-lg transition-all duration-200 transform hover:scale-105 active:scale-95 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 btn-magnetic btn-ripple';
$variantClasses = $variants[$variant] ?? $variants['primary'];
$sizeClasses = $sizes[$size] ?? $sizes['md'];

$disabledClasses = $disabled ? 'opacity-50 cursor-not-allowed pointer-events-none' : '';

$classes = "{$baseClasses} {$variantClasses} {$sizeClasses} {$disabledClasses}";
@endphp

@if($href && !$disabled)
  <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
@else
  <button {{ $attributes->merge(['class' => $classes, 'disabled' => $disabled]) }}>
@endif

  @if($loading)
    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
    </svg>
  @elseif($icon && $iconPosition === 'left')
    <span class="mr-2">{{ $icon }}</span>
  @endif

  {{ $slot }}

  @if($icon && $iconPosition === 'right' && !$loading)
    <span class="ml-2">{{ $icon }}</span>
  @endif

@if($href && !$disabled)
  </a>
@else
  </button>
@endif