@extends('layouts.admin')

@section('content')

    <div class="container-fluid p-4">

        <h2>Lista de produtos</h2>

        <div class="row">
            <div class="col">

                <div class="card">

                    <div class="card-body">

                        <table class="table table-striped" id="datatable">

                            <thead>
                                <tr>
                                    <th>Imagem</th>
                                    <th>Nome</th>
                                    <th>SKU</th>
                                    <th>Categoria</th>
                                    <th>Preço</th>
                                    <th>Data de expiração</th>
                                    <th>Criado em</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($products as $product)

                                    <tr>
                                        <td><img style="max-height: 50px" src="{{ $product->image }}" alt=""></td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->sku }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->created_at->format('d/m/Y') }}</td>
                                        <td>{{ $product->expires_at ? $product->expires_at->format('d/m/Y') : 'Não expira' }}</td>
                                        <td>
                                            <a href="{{ route('products.edit', ['id' => $product->id]) }}" title="Editar" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>

                                            <a href="" class="btn btn-danger" title="Excluir" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal_{{ $product->id }}"><i class="fa-solid fa-trash"></i></a>

                                            @include('products.parts.modal_confirm_delete', [
                                                'id' => 'confirmDeleteModal_' . $product->id
                                            ])

                                            <a href="{{ route('products.stock_movements.create', ['id' => $product->id]) }}" class="btn btn-info text-white" title="Registrar entrada ou saída"><i class="fa-solid fa-boxes-stacked"></i></a>

                                            <a href="{{ route('products.stock_movements.index', ['id' => $product->id]) }}" class="btn btn-info text-white" title="Histórico de movimentações"><i class="fa-solid fa-timeline"></i></a>
                                        </td>
                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>


            </div>
        </div>

    </div>

@endsection
