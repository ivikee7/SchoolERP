<?php

namespace App\Livewire;

use App\Livewire\Alert\Notification;
use App\Models\User;
use App\Models\UserDailyReport as ModelsUserDailyReport;
use App\Models\UserReportType;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class UserDailyReport extends Component
{

    use WithPagination;

    public $search = [];
    public $job_description;
    public $start_time;
    public $end_time;
    public $job_description_characters_count;

    public $user_report_type_id;
    public $user_report_type_name;

    public function render()
    {
        $this->job_description_characters_count = strlen($this->job_description);
        return view('livewire.user-daily-report', ['userDailyReports' => self::userDailyReports($this->search), 'user_report_types' => UserReportType::query()->orderBy('user_report_type_name')->get(), 'user_roles' => self::userRoles()]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    private function userDailyReports($search)
    {
        $columns = ['first_name', 'middle_name', 'last_name'];
        $job_description_array = ((isset($search['name'])) ? explode(' ', $search['name']) : null);
        $user_ids = [''];
        if (isset($search['name']) && !empty($search['name'])) {
            foreach ($job_description_array as $item) {
                $user_ids = User::query()
                    ->from(with(new User)->getTable())
                    ->where(function ($q) use ($item, $columns) {
                        foreach ($columns as $column) {
                            $q->orWhere($column, 'like', '%' . $item . '%');
                        }
                    })
                    ->select('id')
                    ->get();
            }
        }

        $data =  ModelsUserDailyReport::query();
        if (!($user_ids) === null) {
            $data->whereIn('user_daily_report_user_id', $user_ids);
        }

        if (isset($search['id']) && !empty($search['id'])) {
            $data->where('user_daily_report_user_id', 'like', $search['id']);
        }

        if (isset($search['name']) && !empty($search['name'])) {
            $data->whereIn('user_daily_report_user_id', $user_ids);
        }

        if (isset($search['start_date']['from']) && !empty($search['start_date']['from']) && isset($search['start_date']['to']) && !empty($search['start_date']['to'])) {
            $data->whereBetween('user_daily_report_start_time', [$search['start_date']['from'], $search['start_date']['to']]);
        }

        if (isset($search['report_type_id']) && !empty($search['report_type_id'])) {
            $data->where('user_daily_report_user_report_type_id', $search['report_type_id']);
        }

        if (isset($search['user_role_name']) && !empty($search['user_role_name'])) {
            // dd(User::role($search['user_role_name'])->select('id')->get());
            $data->whereIn('user_daily_report_user_id', User::role($search['user_role_name'])->select('id')->get());
        }

        if (auth()->user()->can('user_daily_report_admin')) {
        } elseif (auth()->user()->can('user_daily_report_manage')) {
        } elseif (auth()->user()->can('user_daily_report_access')) {
            $data->where('user_daily_report_user_id', auth()->user()->id);
        }

        return $data->where('user_daily_report_job_description', 'LIKE', '%' . ((isset($search['job_description'])) ? $search['job_description'] : null) . '%')
            ->orderBy('user_daily_report_created_at', 'desc')
            ->paginate(5);
    }

    public function userReportStore()
    {
        if (!auth()->user()->can('user_daily_report_access')) {
            return Notification::alert($this, 'warning', 'Failed!', "You don't have permission!");
        }

        $this->validate([
            'job_description' => 'required|min:1',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time'
        ]);

        ModelsUserDailyReport::create([
            'user_daily_report_user_id' => auth()->user()->id,
            'user_daily_report_user_report_type_id' => $this->user_report_type_id,
            'user_daily_report_job_description' => strtoupper($this->job_description),
            'user_daily_report_start_time' => $this->start_time,
            'user_daily_report_end_time' => $this->end_time,
            'user_daily_report_total_time' => (date_diff(\Carbon\Carbon::parse($this->start_time), \Carbon\Carbon::parse($this->end_time))->format("%yY-%mM-%dD %h:%i:%s")),
            'user_daily_report_created_by' => auth()->user()->id,
            'user_daily_report_updated_by' => auth()->user()->id,
        ]);

        $this->job_description = null;
        $this->start_time = null;
        $this->end_time = null;

        return Notification::alert($this, 'success', 'Success!', "Report successfully added!");
    }

    public function reportTypeStore()
    {
        if (!auth()->user()->can('user_daily_report_admin')) {
            return Notification::alert($this, 'warning', 'Failed!', "You don't have permission!");
        }

        $this->validate([
            'user_report_type_name' => 'required|min:1|max:50',
        ]);

        UserReportType::create([
            'user_report_type_name' => strtoupper($this->user_report_type_name),
            'user_report_type_status' => true,
        ]);

        $this->user_report_type_name = null;

        return Notification::alert($this, 'success', 'Success!', "Report successfully added!");
    }

    public function user($user_id)
    {
        if ($user_id == null) {
            return null;
        }

        $user =  User::findOrFail($user_id);
        return $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name;
    }

    public function userReportTypeName($report_type_id)
    {
        if ($report_type_id == null) {
            return null;
        }

        $report_type =  UserReportType::findOrFail($report_type_id);
        return $report_type->user_report_type_name;
    }

    public function userRoles()
    {
        return Role::whereNot('name', 'Super Admin')->orderBy('name')->get();
    }

    public function userRoleName($user_id)
    {
        return User::findOrFail($user_id)->getRoleNames()->first();
    }

    public function searchReset()
    {
        $this->search = [];
    }

    public function deleteUserDailyReport($id)
    {
        if (!ModelsUserDailyReport::query()->where('user_daily_report_id', $id)->where('user_daily_report_user_id', auth()->user()->id)->exists()) {
            return Notification::alert($this, 'warning', 'Warning!', "You don't have permission to delete this report!");
        }
        ModelsUserDailyReport::where('user_daily_report_id', $id)->delete();
        $this->resetPage();
        return Notification::alert($this, 'success', 'Success!', "Report successfully deleted!");
    }
}
