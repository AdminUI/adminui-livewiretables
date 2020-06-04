@if (isset($row->status))
    @if ($row->status == 1)
        <a href="" class="confirm-suspend" data-id="{{ $row->id }}" data-table="{{ $data['table'] }}">
            <i class="icon icon-lock-open"></i>
        </a>
    @else
        <a href="" class="confirm-unsuspend" data-id="{{ $row->id }}" data-table="{{ $data['table'] }}">
            <i class="icon icon-lock"></i>
        </a>
    @endif
@endif
