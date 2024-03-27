<?php

namespace App\Livewire;

use App\Models\Appointment as ModelsAppointment;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Appointment extends Component
{
    use WithPagination;

    public $search = '';
    public $count_all;
    public $count_schedule;
    public $count_closed;
    public $status = null;
    public $appointments;

    public $appointment_name = '';
    public $appointment_clint_name = '';
    // public $appointment_status = '';
    public $appointment_remark = '';
    public $appointment_start = '';
    public $appointment_end = '';
    // public $appointment_created_by = '';
    // public $appointment_updated_by = '';


    public function render()
    {
        $this->count_all = self::appointmentCount(null);
        $this->count_schedule = self::appointmentCount(1);
        $this->count_closed = self::appointmentCount(0);
        $this->appointments = self::appointments($this->search, $this->status);

        return view('livewire.appointment');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    private function appointmentCount($status)
    {
        return ModelsAppointment::where('appointment_status', $status)->count();
    }

    public function appointmentCreate()
    {
        ModelsAppointment::create([
            'appointment_name' => $this->appointment_name,
            'appointment_clint_name' => $this->appointment_clint_name,
            'appointment_status' => true,
            'appointment_remark' => $this->appointment_remark,
            'appointment_start' => $this->appointment_start,
            'appointment_end' => $this->appointment_end,
            'appointment_created_by' => auth()->user()->id,
            'appointment_updated_by' => auth()->user()->id,
        ]);

        return redirect()->route('appointment');
    }

    public function appointments($search, $type)
    {
        $appointments_query = ModelsAppointment::where(function (Builder $query) use ($search) {
            $columns = ['appointments.appointment_name', 'appointments.appointment_clint_name', 'appointments.appointment_status'];
            foreach (explode(" ", $search) as $item) {
                $query->where(function ($q) use ($item, $columns) {
                    foreach ($columns as $column) {
                        $q->orWhere($column, 'like', '%' . $item . '%');
                    }
                });
            }
        });

        dd($appointments_query->paginate(5));

        return $appointments_query;
    }
}
