@props([
    'title' => null,
    'subtitle' => null,
    'icon' => null,
    'variant' => 'default', // default, bordered, elevated, flat
    'size' => 'md', // sm, md, lg
    'clickable' => false,
    'href' => null,
])

@php
$variants = [
    'default' => 'bg-white border border-neutral-200 shadow-soft',
    'bordered' => 'bg-white border-2 border-neutral-200',
    'elevated' => 'bg-white shadow-medium border border-neutral-100',
    'flat' => 'bg-neutral-50 border border-neutral-100',
];

$sizes = [
    'sm' => 'p-4',
    'md' => 'p-6',
    'lg' => 'p-8',
];

$baseClasses = 'rounded-xl transition-all duration-200';
$variantClasses = $variants[$variant] ?? $variants['default'];
$sizeClasses = $sizes[$size] ?? $sizes['md'];

$clickableClasses = $clickable || $href ? 'hover:shadow-medium transform hover:-translate-y-1 cursor-pointer' : '';

$classes = "{$baseClasses} {$variantClasses} {$sizeClasses} {$clickableClasses}";
@endphp

@if($href)
  <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
@else
  <div {{ $attributes->merge(['class' => $classes]) }}>
@endif

  @if($icon || $title || $subtitle)
    <div class="flex items-start space-x-4 mb-4">
      @if($icon)
        <div class="flex-shrink-0">
          {{ $icon }}
        </div>
      @endif

      @if($title || $subtitle)
        <div class="flex-1 min-w-0">
          @if($title)
            <h3 class="text-lg font-semibold text-neutral-900 mb-1">
              {{ $title }}
            </h3>
          @endif

          @if($subtitle)
            <p class="text-sm text-neutral-600">
              {{ $subtitle }}
            </p>
          @endif
        </div>
      @endif
    </div>
  @endif

  @if($slot->isNotEmpty())
    <div class="text-neutral-700">
      {{ $slot }}
    </div>
  @endif

@if($href)
  </a>
@else
  </div>
@endif