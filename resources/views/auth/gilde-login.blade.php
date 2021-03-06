@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <h1>Inschrijfformulier voor de Kringgildedag</h1>
        <div class="col-md-8">
            <div class="card">
                @if (session('succes'))
                    <div class="alert alert-success alert-dismissible">
                        {{session('succes')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card-header">{{ __('Inloggen voor gilden')}}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('gilde.login.submit')}}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
@php
 //dump($errors);
@endphp
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Wachtwoord') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Inloggen') }}
                                </button>
                            </div>
                            <div class="col-md-8 offset-md-4">
                                <a href="{{route('NieuwWachtwoordGildeGET')}}">
                                    Nieuw wachtwoord
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
