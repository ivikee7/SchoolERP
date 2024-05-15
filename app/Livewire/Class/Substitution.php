<?php

namespace App\Livewire\Class;

use App\Models\StudentClass;
use App\Models\StudentSection;
use App\Models\User;
use Illuminate\Support\Arr;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Substitution extends Component
{
    public $input = [];
    public $periods = 7;
    public $teacher_used = [];

    public function render()
    {
        return view('livewire.class.substitution', ['teachers' => self::getTeachers(), 'classes' => self::getClasses(), 'sections' => self::getSections()]);
    }

    public function openEditModel()
    {
        $this->dispatch('extra_large_model_open');
    }

    public function getTeachers()
    {
        $teachers = Role::query()
            ->where('name', 'like', '%' . 'teacher' . '%')
            ->orWhere('name', 'like', '%' . 'director' . '%')
            ->orWhere('name', 'like', '%' . 'principal' . '%')
            ->pluck('name');

        $teachers =  User::query()->leftJoin('model_has_roles as mhr', 'users.id', 'mhr.model_id')
            ->leftJoin('roles as r', 'mhr.role_id', 'r.id')
            ->where('status', true)
            ->whereIn('r.name', $teachers)
            ->get();

        return $teachers;
    }

    public function getClasses()
    {
        return StudentClass::query()->whereNot('name', 'like', '%' . '\__' . '%')->get();
    }

    public function getSections()
    {
        return StudentSection::query()->whereNot('name', 'like', '%' . '\__' . '%')->get();
    }

    public function save()
    {
        // dd($this->input);
        self::teacherUsed();
    }

    public function teacherUsed()
    {
        $teachers = [];
        foreach ($this->input as $class) {
            foreach ($class as $section) {
                foreach ($section as $teacher) {
                    $teachers[] = $teacher['teacher_primary'];
                    $teachers[] = $teacher['teacher_secondary'];
                }
            }
        }
        return $teachers;
    }
}
