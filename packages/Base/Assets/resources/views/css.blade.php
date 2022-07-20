@php
$version = '';

if (!config('assets.mix')) {
    $version = '?v=' . config('assets.version');
}
@endphp

@foreach($css as $c)
    <link rel="stylesheet" type="text/css" href="{{ asset("$c") . $version }}">
@endforeach
