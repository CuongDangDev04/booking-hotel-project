@props(['status'])

@if ($status)
<div class="font-weight-bold text-small text-success">
    {{ $status }}
</div>
@endif
