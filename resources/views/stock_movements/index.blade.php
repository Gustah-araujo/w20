@extends('layouts.admin')

@section('content')

    <div class="container-fluid p-4">

        <h2>Histórico de movimentações - {{ $product->name }}</h2>

        <div class="row">
            <div class="col">

                <div class="card">

                    <div class="card-body">

                        <div class="row">

                            <div class="col-3">
                                <img src="{{ $product->image }}" alt="" class="img-fluid">
                            </div>

                            <div class="col-9">

                                <table class="table table-striped" id="stock-movement-table">

                                    <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th>Movimentação</th>
                                            <th>Quantidade</th>
                                            <th>Estoque anterior</th>
                                            <th>Novo Estoque</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if (count( $product->stock_movements ) > 0)
                                            @foreach ($product->stock_movements as $stock_movement)
                                                <tr>
                                                    <td>{{ $stock_movement->created_at->format('d/m/Y H:s') }}</td>
                                                    <td><span class="badge rounded-pill bg-{{ $stock_movement->type_style }}">{{ $stock_movement->type }}</span></td>
                                                    <td>{{ $stock_movement->amount }}</td>
                                                    <td>{{ $stock_movement->previous_stock }}</td>
                                                    <td>{{ $stock_movement->new_stock }}</td>
                                                    <td>
                                                        <a href="" class="btn btn-danger" title="Excluir" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal_{{ $stock_movement->id }}"><i class="fa-solid fa-trash"></i></a>

                                                        @include('stock_movements.parts.modal_confirm_delete', [
                                                            'id' => 'confirmDeleteModal_' . $stock_movement->id
                                                        ])
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5">Nenhum registro encontrado</td>
                                            </tr>
                                        @endif
                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>


            </div>
        </div>

    </div>

@endsection
