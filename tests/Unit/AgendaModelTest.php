<?php

namespace Tests\Unit;

use App\Models\Agenda;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AgendaModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_agenda_with_event_time(): void
    {
        $agenda = Agenda::create([
            'title' => 'Test Agenda',
            'slug' => 'test-agenda',
            'event_date' => '2026-03-01',
            'event_time' => '10:30:00',
            'location' => 'Test Room',
            'status' => 'upcoming',
        ]);

        $this->assertDatabaseHas('agendas', [
            'title' => 'Test Agenda',
            'event_time' => '10:30:00',
        ]);
    }

    public function test_event_time_mutator_formats_correctly(): void
    {
        $agenda = new Agenda;

        $agenda->title = 'Test';
        $agenda->slug = 'test';
        $agenda->event_date = '2026-03-01';
        $agenda->event_time = '14:30';
        $agenda->status = 'upcoming';
        $agenda->save();

        $this->assertDatabaseHas('agendas', [
            'event_time' => '14:30:00',
        ]);
    }

    public function test_event_time_mutator_handles_full_format(): void
    {
        $agenda = new Agenda;

        $agenda->title = 'Test Full Format';
        $agenda->slug = 'test-full-format';
        $agenda->event_date = '2026-03-01';
        $agenda->event_time = '08:15:30';
        $agenda->status = 'upcoming';
        $agenda->save();

        $this->assertDatabaseHas('agendas', [
            'event_time' => '08:15:30',
        ]);
    }

    public function test_event_time_mutator_handles_null(): void
    {
        $agenda = new Agenda;

        $agenda->title = 'Test Null Time';
        $agenda->slug = 'test-null-time';
        $agenda->event_date = '2026-03-01';
        $agenda->event_time = null;
        $agenda->status = 'upcoming';
        $agenda->save();

        $this->assertDatabaseHas('agendas', [
            'event_time' => null,
        ]);
    }

    public function test_event_time_formatted_attribute(): void
    {
        $agenda = Agenda::create([
            'title' => 'Test Formatted',
            'slug' => 'test-formatted',
            'event_date' => '2026-03-01',
            'event_time' => '14:30:00',
            'status' => 'upcoming',
        ]);

        $this->assertEquals('14:30', $agenda->event_time_formatted);
    }

    public function test_event_time_formatted_returns_null_when_empty(): void
    {
        $agenda = Agenda::create([
            'title' => 'Test No Time',
            'slug' => 'test-no-time',
            'event_date' => '2026-03-01',
            'event_time' => null,
            'status' => 'upcoming',
        ]);

        $this->assertNull($agenda->event_time_formatted);
    }
}
