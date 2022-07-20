@php
$version = '';

if (!config('assets.mix')) {
    $version = '?v=' . config('assets.version');
}
@endphp

@foreach($js as $attribute => $j)
@php
$isAttribute = gettype($attribute) === 'string';
@endphp
<script type="text/javascript" defer <?= $isAttribute ? $attribute : '' ?> src="{{ asset ("$j") . $version  }}"></script>
@endforeach
