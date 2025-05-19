<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        // Garante que há ao menos um usuário
        $user = User::first() ?? User::factory()->create();

        // Cria 20 tarefas para esse usuário
        Task::factory()->count(20)->create([
            'user_id' => $user->id,
        ]);
    }
}
