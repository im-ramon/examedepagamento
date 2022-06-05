@extends('layouts.app')

@section('content')
    <div class="auth_form-view">
        <div class="logo">
            <a href="/" title="Voltar à página inicial">
                <img src="/image/logo.png" alt="Logo Exame de Pagamento" title="App Exame de Pagamento" />
                <span>App | <strong>Exame de Pagamento</strong></span>
            </a>
        </div>
        <div class="auth_form-container">
            <div class="auth_form-header">{{ __('Redefinir senha') }}</div>
            <div class="auth_form-body login">
                <form method="POST" action="{{ route('password.email') }}">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @csrf
                    <div class="auth_form-inputarea">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Digite seu e-mail') }}</label>

                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">
                            {{ __('Enviar link de redefinição de senha') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <span class="footer_auth">
            Voltar à <a href="/"> página inicial</a>.
        </span>
    </div>
@endsection
