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

        {{-- Formulário Nova Tarefa --}}
        <div class="card shadow mb-4 rounded-4">
            <div class="card-header bg-primary text-white rounded-top-4">Nova Tarefa</div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('tasks.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Título</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-plus-circle"></i> Adicionar
                    </button>
                </form>
            </div>
        </div>

        {{-- Filtro por status --}}
        <form method="GET" action="{{ route('tasks.index') }}" class="mb-4 d-flex align-items-center gap-2">
            <label class="form-label mb-0">Filtrar por status:</label>
            <select name="status" class="form-select w-auto" onchange="this.form.submit()">
                <option value="">Todas</option>
                <option value="Pendente" {{ request('status') === 'Pendente' ? 'selected' : '' }}>Pendentes</option>
                <option value="Concluída" {{ request('status') === 'Concluída' ? 'selected' : '' }}>Concluídas</option>
            </select>
            @if(request('status'))
                <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary btn-sm">Limpar</a>
            @endif
        </form>

        {{-- Lista de Tarefas --}}
        <div class="card shadow rounded-4">
            <div class="card-header bg-dark text-white rounded-top-4">Tarefas Cadastradas</div>
            <div class="card-body">
                @if($tasks->count())
                    <ul class="list-group">
                        @foreach($tasks as $task)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted">{{ $task->created_at->format('d/m/Y H:i') }}</small><br>
                                    <strong>{{ $task->title }}</strong><br>
                                    <small>{{ $task->description }}</small><br>
                                    <span
                                        class="badge 
                                                                                                                    {{ $task->status === 'Concluída' ? 'bg-success' : 'bg-warning text-dark' }}">
                                        {{ $task->status }}
                                    </span>
                                </div>
                                <div class="btn-group gap-1">

                                    {{-- Formulário para marcar como concluída --}}
                                    @if($task->status !== 'Concluída')
                                        <form method="POST" action="{{ route('tasks.update', $task) }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="Concluída">
                                            <button
                                                class="btn btn-success text-white rounded-pill d-flex align-items-center gap-1 px-3 py-1">
                                                <i class="bi bi-check2-circle"></i> Concluir
                                            </button>
                                        </form>
                                    @endif

                                    {{-- Link para editar --}}
                                    <a href="{{ route('tasks.edit', $task) }}"
                                        class="btn btn-warning text-black rounded-pill d-flex align-items-center gap-1 px-3 py-1">
                                        <i class="bi bi-pencil-square"></i> Editar
                                    </a>

                                    {{-- Formulário para deletar --}}
                                    <form method="POST" action="{{ route('tasks.destroy', $task) }}"
                                        onsubmit="return confirm('Tem certeza que deseja excluir?')"> @csrf @method('DELETE')
                                        <button
                                            class="btn btn-danger text-white rounded-pill d-flex align-items-center gap-1 px-3 py-1">
                                            <i class="bi bi-trash"></i> Excluir </button>
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

        {{-- Paginação --}}
        <div class="mt-4">
            {{ $tasks->appends(request()->query())->links() }}
        </div>

    </div>
@endsection