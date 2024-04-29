<?php

namespace App\Livewire;

use App\Livewire\Alert\Notification;
use App\Models\User;
use App\Models\UserDailyReport as ModelsUserDailyReport;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class UserDailyReport extends Component
{

    use WithPagination;

    public $search = [];
    public $job_description;
    public $start_time;
    public $end_time;
    public $job_description_characters_count;

    protected $rules = [
        'job_description' => 'required|min:1',
        'start_time' => 'required',
        'end_time' => 'required|after:start_time'
    ];

    public function render()
    {
        $this->job_description_characters_count = strlen($this->job_description);
        return view('livewire.user-daily-report', ['userDailyReports' => self::userDailyReports($this->search)]);
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
        if (isset($search['name']) && !$search['name'] = null) {
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

        if (isset($search['start_date']['from']) && !empty($search['start_date']['from']) && isset($search['start_date']['to']) && !empty($search['start_date']['to'])) {
            $data->whereBetween('user_daily_report_start_time', [$search['start_date']['from'], $search['start_date']['to']]);
        }

        if (!auth()->user()->can('user_daily_report_admin')) {
        } elseif (!auth()->user()->can('user_daily_report_manage')) {
        } elseif (!auth()->user()->can('user_daily_report_access')) {
            $data->where('user_daily_report_user_id', auth()->user()->id);
        }

        return $data->where('user_daily_report_job_description', 'LIKE', '%' . ((isset($search['job_description'])) ? $search['job_description'] : null) . '%')
            ->orderBy('user_daily_report_created_at', 'desc')
            ->paginate(5);
    }

    public function save()
    {

        // dd(date_diff(\Carbon\Carbon::parse($this->start_time), \Carbon\Carbon::parse($this->end_time))->format("P %yY %mM %dD T %hH %iM %sS"));

        // dd((\Carbon\Carbon::parse($this->end_time)->diff(\Carbon\Carbon::parse($this->start_time))->format('%H:%I:%S')));

        if (!auth()->user()->can('user_daily_report_access')) {
            return Notification::alert($this, 'warning', 'Failed!', "You don't have permission!");
        }

        $this->validate();

        ModelsUserDailyReport::create([
            'user_daily_report_user_id' => auth()->user()->id,
            'user_daily_report_job_description' => $this->job_description,
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

    public function user($user_id)
    {
        if ($user_id == null) {
            return null;
        }

        $user =  User::findOrFail($user_id);
        return $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name;
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
