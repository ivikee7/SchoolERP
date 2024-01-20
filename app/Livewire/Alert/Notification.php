<?php

namespace App\Livewire\Alert;

use Livewire\Component;

class Notification extends Component
{
    public static function alert($alert, $icon, $title, $text)
    {
        $alert->dispatch('swal', [
            'icon' => $icon,
            'title' => $title,
            'text' => $text,
        ]);
    }

    public static function save($alert)
    {
        $alert->dispatch('swal', [
            'title' => 'Success!',
            'text' => 'Saved!',
            'icon' => 'success',
        ]);
    }

    public static function delete($alert)
    {
        $alert->dispatch('swal', [
            'title' => 'Success!',
            'text' => 'Deleted!',
            'icon' => 'success',
        ]);
    }

    public static function error($alert)
    {
        $alert->dispatch('swal', [
            'title' => 'Error!',
            'text' => 'Error!',
            'icon' => 'error',
        ]);
    }

    public static function info($alert)
    {
        $alert->dispatch('swal', [
            'title' => 'Info!',
            'text' => 'Info!',
            'icon' => 'info',
        ]);
    }

    public static function warning($alert)
    {
        $alert->dispatch('swal', [
            'title' => 'Warning!',
            'text' => 'Warning!',
            'icon' => 'warning',
        ]);
    }

    public static function question($alert)
    {
        $alert->dispatch('swal', [
            'title' => 'Question!',
            'text' => 'Question!',
            'icon' => 'question',
        ]);
    }

    public static function clear($alert)
    {
        $alert->dispatch('swal', [
            'title' => 'Success!',
            'text' => 'Clear!',
            'icon' => 'clear',
        ]);
    }
}
