@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Minhas Tarefas</h1>

        {{-- Exibir mensagens de sucesso --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Formulário de nova tarefa --}}
        <div class="card mb-4">
            <div class="card-header">Nova Tarefa</div>
            <div class="card-body">
                <form method="POST" action="{{ route('tasks.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Título</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Adicionar</button>
                </form>
            </div>
        </div>

        {{-- FILTRO POR STATUS --}}
        <form method="GET" action="{{ route('tasks.index') }}" class="mb-3 d-flex align-items-center gap-2">
            <label class="form-label mb-0">Filtrar por status:</label>
            <select name="status" class="form-select w-auto" onchange="this.form.submit()">
                <option value="">Todas</option>
                <option value="Pendente" {{ request('status') === 'Pendente' ? 'selected' : '' }}>Pendentes</option>
                <option value="Concluída" {{ request('status') === 'Concluída' ? 'selected' : '' }}>Concluídas</option>
            </select>
            @if(request('status'))
                <a href="{{ route('tasks.index') }}" class="btn btn-link">Limpar filtro</a>
            @endif
        </form>

        {{-- Listagem de tarefas --}}
        <div class="card">
            <div class="card-header">Tarefas</div>
            <div class="card-body">
                @if($tasks->count())
                    <ul class="list-group">
                        @foreach($tasks as $task)

                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <small> {{$task->created_at}} </small><br>
                                    <strong>{{ $task->title }}</strong><br>
                                    <small class="text-muted">{{ $task->description }}</small><br>
                                    <span class="badge bg-{{ $task->status === 'Concluída' ? 'success' : 'secondary' }}">
                                        {{ $task->status }}
                                    </span>
                                </div>

                                <div class="btn-group">
                                    {{-- Formulário para marcar como concluída --}}
                                    @if($task->status !== 'Concluída')
                                        <form method="POST" action="{{ route('tasks.update', $task) }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="Concluída">
                                            <button class="btn btn-success btn-sm">Concluir</button>
                                        </form>
                                    @endif

                                    {{-- Link para editar --}}
                                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning btn-sm">Editar</a>

                                    {{-- Formulário para deletar --}}
                                    <form method="POST" action="{{ route('tasks.destroy', $task) }}"
                                        onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Excluir</button>
                                    </form>
                                </div>
                            </li>

                        @endforeach
                    </ul>

                @else
                    <p>Você ainda não tem tarefas cadastradas.</p>
                @endif
            </div>
        </div>
        
        <div class="mt-3"> {{ $tasks->withQueryString()->links() }} </div>

    </div>
@endsection