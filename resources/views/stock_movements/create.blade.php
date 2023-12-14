@extends('layouts.admin')

@section('content')

    <div class="container-fluid p-4">

        <h2>Registrar entrada/saída</h2>

        <div class="row">
            <div class="col">
                <div class="card">

                    <div class="card-body">

                        <div class="row">

                            <div class="col-4">
                                <p class="mb-0 text-center">{{ $product->name }}</p>
                                <img class="img-fluid" src="{{ $product->image }}" alt="">
                            </div>

                            <div class="col-8">
                                <form action="{{ route('products.stock_movements.store', ['id' => $product->id]) }}" method="post">
                                    @csrf

                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="amount" class="form-label">Quantidade</label>
                                                <input type="number" min="1" class="form-control number" id="amount" name="amount" value="{{ old('amount') }}">
                                                @error('amount')
                                                    <p class="mb-0 text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <input type="radio" class="btn-check" name="type" id="type-in" value="in" autocomplete="off" {{ old('type') == 'in' || !old('type') ? 'checked' : '' }}>
                                            <label class="btn btn-outline-success" for="type-in">Entrada</label>

                                            <input type="radio" class="btn-check" name="type" id="type-out" value="out" autocomplete="off" {{ old('type') == 'out' ? 'checked' : '' }}>
                                            <label class="btn btn-outline-danger" for="type-out">Saída</label>

                                            <button class="btn btn-success float-end" type="submit">Salvar</button>
                                        </div>
                                    </div>

                                    <div class="float-end">
                                    </div>
                                </form>
                            </div>

                        </div>


                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection
