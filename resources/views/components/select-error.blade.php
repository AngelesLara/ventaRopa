<!-- resources/views/components/select-error.blade.php -->
@props(['for'])

@error($for)
    <span {{ $attributes->merge(['class' => 'mt-2 text-sm text-red-600']) }}>{{ $message }}</span>
@enderror