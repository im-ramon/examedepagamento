<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'App | Exame de pagamento')
<img src="https://examedepagamento.com.br/image/logo.png" class="logo" alt="App | Exame de pagamento Logo">
<h5>App | Exame de pagamento</h5>
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
