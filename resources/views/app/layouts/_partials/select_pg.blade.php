@foreach ($pg_info as $indice => $pg)
    <option @if ($pg['pg_abrev'] == '- Não recebe -')
        selected
@endif

value="{{ $pg['id'] }}">{{ $pg['pg_abrev'] }}</option>
@endforeach
