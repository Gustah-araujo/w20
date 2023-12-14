@extends('layouts.auth')

@section('content')

    <div class="row w-100 justify-content-center">
        <div class="col-sm-6 col-10">

            <div class="card bg-white">
                <div class="card-header py-4">
                    <h3 class="mb-0">Registrar</h3>
                </div>

                <div class="card-body">
                    <form method="post" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="name" name="name">
                            @error('name')
                                <p class="mb-0 text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                            @error('email')
                                <p class="mb-0 text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="password" name="password">
                            @error('password')
                                <p class="mb-0 text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirme sua senha</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                            @error('password_confirmation')
                                <p class="mb-0 text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="float-end">
                            <button class="btn btn-success" type="submit">Registrar</button>
                        </div>

                    </form>
                </div>

                <div class="card-footer py-4">
                    <p class="mb-0 text-center">Já possui uma conta? Faça <a href="{{ route('login') }}">login</a></p>
                </div>
            </div>


        </div>
    </div>

@endsection
