<?php

namespace App\Filament\Resources\TeacherResource\Pages;

use App\Filament\Resources\TeacherResource;
use App\Models\Teacher;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateTeacher extends CreateRecord
{
    protected static string $resource = TeacherResource::class;

    public function mount(): void
    {
        $teacherLimit = config('app.teacher_limit', 100);
        $currentCount = Teacher::count();

        if ($currentCount >= $teacherLimit) {
            Notification::make()
                ->title('Batas Guru Tercapai')
                ->body("Batas maksimum guru ({$teacherLimit}) telah tercapai. Hubungi Super Admin untuk menambah kuota.")
                ->warning()
                ->send();

            $this->redirect(TeacherResource::getUrl('index'));
        }

        parent::mount();
    }
}
