<?php

namespace App\Filament\Resources\TeacherResource\Pages;

use App\Filament\Resources\TeacherResource;
use App\Models\Teacher;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTeachers extends ListRecords
{
    protected static string $resource = TeacherResource::class;

    protected function getHeaderActions(): array
    {
        $teacherLimit = config('app.teacher_limit', 100);
        $currentCount = Teacher::count();
        $isLimitReached = $currentCount >= $teacherLimit;

        $createAction = Actions\CreateAction::make();

        if ($isLimitReached) {
            $createAction
                ->disabled()
                ->tooltip("Batas maksimum guru ({$teacherLimit}) telah tercapai. Hubungi Super Admin untuk menambah kuota.");
        }

        return [$createAction];
    }
}
