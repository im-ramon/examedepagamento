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
            <div class="auth_form-body">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="auth_form-inputarea">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-Mail') }}</label>

                        <input id="email" placeholder="Digite seu e-mail" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="auth_form-inputarea">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Senha') }}</label>

                        <input id="password" placeholder="Escolha a nova senha" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="auth_form-inputarea">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Repita a senha') }}</label>

                        <input id="password-confirm" placeholder="Repita a nova senha" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="button_container">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Redefinir senha') }}
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
