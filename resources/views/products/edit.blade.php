@extends('layouts.admin')

@section('content')

    <div class="container-fluid p-4">

        <h2>Criar novo produto</h2>

        <div class="row">
            <div class="col">
                <div class="card">

                    <div class="card-body">

                        <form action="{{ route('products.update', ['id' => $product->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="row">
                                <div class="col mb-3">
                                    <label for="name" class="form-label">Nome <sup class="text-danger">*</sup></label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
                                    @error('name')
                                        <p class="mb-0 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mb-3">
                                    <label for="description" class="form-label">Descrição</label>
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="2">{{ $product->description }}</textarea>
                                    @error('description')
                                    <p class="mb-0 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4 col-12 mb-3">
                                    <label for="expires_at" class="form-label">Data de validade</label>
                                    <input type="text" class="form-control date" placeholder="__/__/____" id="expires_at" name="expires_at" value="{{ $product->expires_at->format('dmY') }}">
                                    @error('expires_at')
                                        <p class="mb-0 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-sm-4 col-12 mb-3">
                                    <label for="price" class="form-label">Preço <sup class="text-danger">*</sup></label>
                                    <input type="text" class="form-control currency" placeholder="R$" id="price" name="price" value="{{ $product->price }}">
                                    @error('price')
                                        <p class="mb-0 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-sm-4 col-12 mb-3">

                                    <label for="category_id" class="form-label">Categoria <sup class="text-danger">*</sup></label>
                                    <select class="form-control select-search" name="category_id" id="category_id">
                                        @foreach ($categories as $category)
                                            <option {{ $category->id == $product->category_id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('category_id')
                                        <p class="mb-0 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mb-3">
                                    <label for="iamge" class="form-label">Imagem</label>
                                    <input type="file" accept="image/png, image/jpeg" class="form-control" id="image" name="image">
                                    @error('image')
                                        <p class="mb-0 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
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
