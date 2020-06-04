<th class="{{ $column['class'] ?? 'text-left' }}">
    @if (isset($column['sortable']))
        <a wire:click.prevent="sortBy('{{ $column['field'] }}')" href="" role="button">
            {{ $column['label'] }}
            @if ($sortField !== $column['field'])
                <i class="text-muted fa fa-sort"></i>
            @elseif ($sortAsc)
                <i class="fa fa-sort-up"></i>
            @else
                <i class="fa fa-sort-down"></i>
            @endif
        </a>
    @else
        {{ $column['label'] }}
    @endif
</th>
