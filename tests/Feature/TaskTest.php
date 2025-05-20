
<?php

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_pode_criar_tarefa()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/tasks', [
            'title' => 'Nova tarefa',
            'description' => 'Descrição teste'
        ]);

        $response->assertRedirect('/tasks');
        $this->assertDatabaseHas('tasks', ['title' => 'Nova tarefa']);
    }
}
