@if (!empty($script))
<script type="text/javascript">
    @foreach($script as $s)
        {!! $s !!}
    @endforeach
</script>
@endif
