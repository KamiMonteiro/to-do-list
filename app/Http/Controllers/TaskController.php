<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
   public function index(Request $request)
{
    $query = auth()->user()->tasks()->latest();

    if ($request->has('status') && in_array($request->status, ['Pendente', 'Concluída'])) {
        $query->where('status', $request->status);
    }
    
    $tasks = $query->paginate(5); // 5 tarefas por página
    
    return view('tasks.index', compact('tasks'));
    
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    auth()->user()->tasks()->create($validated);

    return redirect()->route('tasks.index')->with('success', 'Tarefa criada com sucesso!');
}


    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $task->update($request->only('title', 'description', 'status'));
        return redirect()->route('tasks.index')->with('success', 'Tarefa atualizada.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Tarefa excluída.');
    }

}
