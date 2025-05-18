@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Tarefa</h1>

    <form method="POST" action="{{ route('tasks.update', $task) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="title" class="form-control" value="{{ $task->title }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea name="description" class="form-control">{{ $task->description }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="Pendente" {{ $task->status === 'Pendente' ? 'selected' : '' }}>Pendente</option>
                <option value="Concluída" {{ $task->status === 'Concluída' ? 'selected' : '' }}>Concluída</option>
            </select>
        </div>

        <button class="btn btn-primary">Salvar</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
