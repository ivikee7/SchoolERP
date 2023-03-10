<?php

namespace App\Datatables;

use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Facades\DataTables;

class UserExporter
{
    public static function index($users)
    {
        return DataTables::of($users)
            ->editColumn('id', '{{$id}}')
            ->addColumn('full_name', function ($user) {
                return str_replace('  ', ' ', $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name);
            })
            ->addColumn('transport', '{{$route_name}} {{$transport_type_name}}')
            ->addColumn('contact_number', '{{$contact_number}}, {{$contact_number2}}')
            ->addColumn('address', '{{$address_line1}}, {{$city}}, {{$state}}, {{$country}}, {{$pin_code}}')
            ->editColumn('gender', function ($users) {
                if ($users->gender == 'M') return 'Male';
                if ($users->gender == 'F') return 'Female';
                if ($users->gender == 'O') return 'Other';
            })
            ->editColumn('created_by', '{{$created_by_name}} {{$created_at}}')
            ->editColumn('updated_by', '{{$updated_by_name}} {{$updated_at}}')
            ->editColumn('status', function ($user) {
                if ($user->status == 0) return 'Inactive';
                if ($user->status == 1) return 'Active';
            })
            ->addColumn('action', function ($users) {
                return '<a href=' . URL::current() . '/' . $users->id . ' class="btn btn-xs btn-primary"><i class="fas fa-eye"></i> View</a>';
            })
            ->setRowClass(function ($user) {
                if ($user->status == 0) {
                    return 'bg-warning';
                }
            });
    }
}