<?php

namespace App\Http\Controllers\Backend;

use App\Models\Page;
use App\Models\Role;
use App\Models\User;
use App\Models\Criteria;
use App\Models\Grade;
use App\Models\SubCriteria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $data['usersCount'] = User::count();
        $data['rolesCount'] = Role::count();
        $data['criteriaCount'] = Criteria::count();
        $data['subcriteriaCount'] = SubCriteria::count();
        $data['users'] = User::orderBy('last_login_at', 'desc')->take(10)->get();
        $data['grades'] =  Grade::with('user')->whereHas('user', function ($q) {
            $q->where('role_id', 2);
        })->orderby('total_grade_value', 'desc')->get();

        return view('backend.dashboard', $data);
    }
}
