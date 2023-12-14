@extends('layouts.admin')

@section('content')

    <div class="container-fluid p-4">

        <h2>Lista de categorias</h2>

        <div class="row">
            <div class="col">

                <div class="card">

                    <div class="card-body">

                        <table class="table table-striped" id="datatable">

                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Criado em</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($categories as $category)

                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="{{ route('categories.edit', ['id' => $category->id]) }}" title="Editar" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>

                                            <a href="" class="btn btn-danger" title="Excluir" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal_{{ $category->id }}"><i class="fa-solid fa-trash"></i></a>

                                            @include('categories.parts.modal_confirm_delete', [
                                                'id' => 'confirmDeleteModal_' . $category->id
                                            ])
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
