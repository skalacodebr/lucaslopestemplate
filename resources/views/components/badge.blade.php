@props([
    'variant' => 'default', // default, primary, secondary, success, warning, error, info
    'size' => 'md', // sm, md, lg
    'rounded' => true,
])

@php
$variants = [
    'default' => 'bg-neutral-100 text-neutral-800 border-neutral-200',
    'primary' => 'bg-primary-100 text-primary-800 border-primary-200',
    'secondary' => 'bg-secondary-100 text-secondary-800 border-secondary-200',
    'success' => 'bg-secondary-100 text-secondary-800 border-secondary-200',
    'warning' => 'bg-accent-100 text-accent-800 border-accent-200',
    'error' => 'bg-red-100 text-red-800 border-red-200',
    'info' => 'bg-blue-100 text-blue-800 border-blue-200',
];

$sizes = [
    'sm' => 'px-2 py-1 text-xs',
    'md' => 'px-3 py-1.5 text-sm',
    'lg' => 'px-4 py-2 text-base',
];

$baseClasses = 'inline-flex items-center font-medium border';
$variantClasses = $variants[$variant] ?? $variants['default'];
$sizeClasses = $sizes[$size] ?? $sizes['md'];
$roundedClasses = $rounded ? 'rounded-full' : 'rounded-md';

$classes = "{$baseClasses} {$variantClasses} {$sizeClasses} {$roundedClasses}";
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
  {{ $slot }}
</span>