@php
    extract($data);
    $type = isset($type) ? $type : 'id';
@endphp

{{-- Not locked by any permission --}}
@if (admin()->can('user manage'))
    <a href="{{ route($route, [$type == 'id' ? short_encrypt($row->$type) : $row->$type]) }}">
        <i class="icon icon-note"></i>
    </a>
@endif
