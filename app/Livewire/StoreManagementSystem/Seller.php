<?php

namespace App\Livewire\StoreManagementSystem;

use App\Models\User;
use Illuminate\Support\Arr;
use Livewire\Component;
use Livewire\WithPagination;

class Seller extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        return view('livewire.store-management-system.seller', [
            'users' => $this->users($this->search)
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    private function users($search)
    {
        $data = User::where('r.name', "STUDENT")
            ->leftJoin('model_has_roles as mhr', 'users.id', 'mhr.model_id')
            ->leftJoin('roles as r', 'mhr.role_id', 'r.id')
            ->leftJoin('student_admissions as sa', 'users.id', 'sa.user_id')
            ->leftJoin('student_classes as sc', 'sa.current_class_id', 'sc.id')
            ->select('users.id', 'users.first_name', 'users.middle_name', 'users.last_name', 'users.father_name', 'users.mother_name', 'users.contact_number', 'users.contact_number2', 'users.email_alternate', 'users.address_line1', 'users.city', 'users.state', 'users.pin_code', 'sc.name as class_name')
            ->where('sa.admission_status', true)
            ->where(function ($query) use ($search) {
                $columns = ['users.id', 'users.first_name', 'users.middle_name', 'users.last_name', 'users.father_name', 'users.mother_name', 'users.contact_number', 'users.contact_number2', 'users.email_alternate', 'users.address_line1', 'users.city', 'users.state', 'users.pin_code', 'sc.name'];
                foreach (explode(" ", $search) as $item) {
                    $query->where(function ($q) use ($item, $columns) {
                        foreach ($columns as $column) {
                            $q->orWhere($column, 'like', '%' . $item . '%');
                        }
                    });
                }
            })
            ->paginate(5);
        return $data;
    }
}
