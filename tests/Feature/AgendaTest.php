<?php

namespace Tests\Feature;

use App\Models\Agenda;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AgendaTest extends TestCase
{
    use RefreshDatabase;

    public function test_model_creates_with_time_correctly(): void
    {
        $agenda = new Agenda;
        $agenda->title = 'Test Agenda';
        $agenda->slug = 'test-agenda';
        $agenda->event_date = '2026-03-15';
        $agenda->event_time = '10:30';
        $agenda->status = 'upcoming';
        $agenda->save();

        $this->assertDatabaseHas('agendas', [
            'title' => 'Test Agenda',
            'event_time' => '10:30:00',
        ]);
    }

    public function test_model_updates_time_correctly(): void
    {
        $agenda = Agenda::create([
            'title' => 'Original',
            'slug' => 'original',
            'event_date' => '2026-03-15',
            'event_time' => '09:00:00',
            'status' => 'upcoming',
        ]);

        $agenda->event_time = '14:30';
        $agenda->save();

        $this->assertDatabaseHas('agendas', [
            'id' => $agenda->id,
            'event_time' => '14:30:00',
        ]);
    }

    public function test_model_mutator_handles_various_time_formats(): void
    {
        $testCases = [
            ['input' => '08:00', 'expected' => '08:00:00'],
            ['input' => '14:30', 'expected' => '14:30:00'],
            ['input' => '23:59', 'expected' => '23:59:00'],
        ];

        foreach ($testCases as $index => $case) {
            $agenda = new Agenda;
            $agenda->title = 'Test '.$index;
            $agenda->slug = 'test-'.$index;
            $agenda->event_date = '2026-03-15';
            $agenda->event_time = $case['input'];
            $agenda->status = 'upcoming';
            $agenda->save();

            $this->assertDatabaseHas('agendas', [
                'title' => 'Test '.$index,
                'event_time' => $case['expected'],
            ]);
        }
    }

    public function test_model_handles_null_time(): void
    {
        $agenda = new Agenda;
        $agenda->title = 'No Time';
        $agenda->slug = 'no-time';
        $agenda->event_date = '2026-03-15';
        $agenda->event_time = null;
        $agenda->status = 'upcoming';
        $agenda->save();

        $this->assertDatabaseHas('agendas', [
            'title' => 'No Time',
            'event_time' => null,
        ]);
    }

    public function test_model_delete_works(): void
    {
        $agenda = Agenda::create([
            'title' => 'To Delete',
            'slug' => 'to-delete',
            'event_date' => '2026-03-15',
            'status' => 'upcoming',
        ]);

        $id = $agenda->id;
        $agenda->delete();

        $this->assertDatabaseMissing('agendas', [
            'id' => $id,
        ]);
    }
}
