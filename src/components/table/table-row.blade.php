<tr>
    @foreach ($columns as $column)
        <td>{{ $row->getValue($column) }}</td>
    @endforeach

    @if (isset($actions))
        <td class="text-right" style="width:100px">
            @foreach ($actions as $action)
                @component('components.tables.'.$action[0], ['row' => $row, 'data' => $action[1]])
                @endcomponent
            @endforeach
        </td>
    @endif
</tr>
