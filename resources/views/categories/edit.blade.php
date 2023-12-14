@extends('layouts.admin')

@section('content')

    <div class="container-fluid p-4">

        <h2>Editar categoria</h2>

        <div class="row">
            <div class="col">
                <div class="card">

                    <div class="card-body">

                        <form action="{{ route('categories.update', ['id' => $category->id]) }}" method="post">
                            @csrf
                            @method('PATCH')

                            <div class="mb-3">
                                <label for="name" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}">
                                @error('name')
                                    <p class="mb-0 text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="float-end">
                                <button class="btn btn-success" type="submit">Salvar</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection
