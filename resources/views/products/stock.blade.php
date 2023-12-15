@extends('layouts.admin')

@section('content')

    <div class="container-fluid p-4">

        <h2>Estoque de produtos</h2>

        <div class="row">
            <div class="col">

                <table id="datatable">
                    <thead>
                        <tr>
                            <th>Imagem</th>
                            <th>Produto</th>
                            <th>Estoque</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td><img style="max-height: 50px" src="{{ $product->image }}" alt="" class="img-fluid"></td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->stock }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>

    </div>

@endsection
