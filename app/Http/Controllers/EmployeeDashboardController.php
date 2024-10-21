<?php

namespace App\Http\Controllers;

use App\Models\AddressType;
use App\Models\AreaCodes;
use App\Models\Atest;
use App\Models\Audience;
use App\Models\BudgetName;
use App\Models\Client;
use App\Models\Country;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\EmployeeBank;
use App\Models\EmployeeContractType;
use App\Models\EmployeeDirectorate;
use App\Models\EmployeeEmergencyContact;
use App\Models\EmployeeEntity;
use App\Models\EmployeeFile;
use App\Models\EmployeeJobLevel;
use App\Models\EmployeeLeave;
use App\Models\EmployeeLeaveStatus;
use App\Models\EmployeeLeaveType;
use App\Models\EmployeeRelationship;
use App\Models\EmployeeSalary;
use App\Models\EmployeeSponsorship;
use App\Models\EmployeeTimeSheet;
use App\Models\EmployeeType;
use App\Models\EventCategory;
use App\Models\FunctionalArea;
use App\Models\Gender;
use App\Models\Language;
use App\Models\Location;
use App\Models\MaritalStatus;
use App\Models\MonthsNames;
use App\Models\Nationality;
use App\Models\ProjectType;
use App\Models\Relationship;
use App\Models\Salutation;
use App\Models\Status;
use App\Models\Tag;
use App\Models\User;
use App\Models\Venue;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Route as FacadesRoute;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\Datatables;


class EmployeeDashboardController extends Controller
{

    public function dashboard()
    {
        // dd('inside trackiDashboard');
        $workspace = session()->get('workspace_id');
        $user_department = auth()->user()->department_assignment_id;
        $user_workspace = auth()->user()->workspace_id;

        // if (session()->has('workspace_id')){
        //     dd('session for workspace: '.session()->get('workspace_id'));
        // }

        // employee count
        // leave count
        // total salary

        $employee_count = Employee::count();

        // dd($employee_count);

        // $proj_count = Event::leftJoin('tasks', 'tasks.event_id', '=', 'events.id')
        //     ->whereNull('archived')
        //     ->when($user_department, function ($query, $user_department) {
        //         return $query->where('tasks.department_assignment_id', $user_department);
        //     })->distinct('events.id')->count();

        // $unbudgeted_proj_count = Event::leftJoin('tasks', 'tasks.event_id', '=', 'events.id')
        //     ->leftJoin('funds_category', 'funds_category.id', '=', 'events.fund_category_id')
        //     ->whereNull('archived')
        //     ->whereNot(function ($query) {
        //         $query->where('funds_category.name', '=', 'Budgeted');
        //     })
        //     ->when($user_department, function ($query, $user_department) {
        //         return $query->where('tasks.department_assignment_id', $user_department);
        //     })->distinct('events.id')->count();

        // $task_count = Task::join('events', 'events.id', '=', 'tasks.event_id')
        //     ->whereNull('events.archived')
        //     ->when($user_department, function ($query, $user_department) {
        //         return $query->where('tasks.department_assignment_id', $user_department);
        //     })
        //     ->when(auth()->user()->functional_area_id, function ($query, $user_fa) {
        //         return $query->where('events.functional_area_id', $user_fa);
        //     })
        //     ->count();

        // $late_tasks_count = Task::join('events', 'events.id', '=', 'tasks.event_id')
        //     ->whereNull('events.archived')
        //     ->whereRaw('datediff(tasks.due_date, CURRENT_DATE) < 0')
        //     ->where('tasks.progress', '<', 1)
        //     ->when($user_department, function ($query, $user_department) {
        //         return $query->where('tasks.department_assignment_id', $user_department);
        //     })
        //     ->when(auth()->user()->functional_area_id, function ($query, $user_fa) {
        //         return $query->where('events.functional_area_id', $user_fa);
        //     })
        //     ->count();

        // $ending_tasks_count = Task::join('events', 'events.id', '=', 'tasks.event_id')
        //     ->whereNull('events.archived')
        //     ->whereRaw('datediff(tasks.due_date, CURRENT_DATE) < 3')
        //     ->whereRaw('datediff(tasks.due_date, CURRENT_DATE) >= 0')
        //     ->where('tasks.progress', '<', 1)
        //     ->when($user_department, function ($query, $user_department) {
        //         return $query->where('tasks.department_assignment_id', $user_department);
        //     })
        //     ->when(auth()->user()->functional_area_id, function ($query, $user_fa) {
        //         return $query->where('events.functional_area_id', $user_fa);
        //     })
        //     ->count();

        // $starting_tasks_count = Task::join('events', 'events.id', '=', 'tasks.event_id')
        //     ->whereNull('events.archived')
        //     ->whereRaw('datediff(tasks.start_date, CURRENT_DATE) < 3')
        //     ->whereRaw('datediff(tasks.start_date, CURRENT_DATE) >= 0')
        //     ->where('tasks.progress', '<', 1)
        //     ->when($user_department, function ($query, $user_department) {
        //         return $query->where('tasks.department_assignment_id', $user_department);
        //     })
        //     ->when(auth()->user()->functional_area_id, function ($query, $user_fa) {
        //         return $query->where('events.functional_area_id', $user_fa);
        //     })
        //     ->count();

        // $total_yearly_budget = OrganizationBudget::where('type', 'year')
        //     ->whereYear('date_from', date('Y'))
        //     ->first();

        // $total_spent_by_department = Task::join('events', 'events.id', '=', 'tasks.event_id')
        //     ->join('department', 'department.id', '=', 'tasks.department_assignment_id')
        //     ->whereNull('events.archived')
        //     ->select('department.name', DB::raw("sum(tasks.actual_budget_allocated) as value"))
        //     ->whereYear('tasks.start_date', date('Y'))
        //     ->groupBy('department.name')
        //     ->when($user_department, function ($query, $user_department) {
        //         return $query->where('tasks.department_assignment_id', $user_department);
        //     })
        //     ->when(auth()->user()->functional_area_id, function ($query, $user_fa) {
        //         return $query->where('events.functional_area_id', $user_fa);
        //     })
        //     ->having('value', '>', '0')
        //     ->get();

        // $total_yearly_spent = Task::select(DB::raw("sum(tasks.actual_budget_allocated) as total_spent"))
        //     ->join('events', 'events.id', '=', 'tasks.event_id')
        //     ->whereNull('events.archived')
        //     ->whereYear('tasks.start_date', date('Y'))
        //     ->first();

        // $completed_projects_by_month = Event::select(DB::raw('count(*) as total, date_format(end_date, "%m") as month'))
        //     ->whereYear('end_date', date('Y'))
        //     ->where('event_status', '=', config('tracki.project_status.completed'))
        //     ->whereNull('archived')
        //     ->groupBy('month')
        //     ->get();

        // DB::enableQueryLog();
        // $total_sales_by_month = Event::select(DB::raw('IFNULL(sum(events.total_sales), 0) count, cal.month'))
        //     ->rightJoin('cal', function ($join) {
        //         $join
        //             ->on('cal.month_num', DB::raw('date_format(end_date, "%m")'))
        //             ->whereYear('end_date', date('Y'))
        //             ->where('event_status', '=', config('tracki.project_status.completed'))
        //             ->whereNull('archived');
        //     })
        //     ->groupBy('cal.month')
        //     ->orderBy('cal.month_num')
        //     ->get();

        // $completed_projects_by_month = Event::select(DB::raw('IFNULL(count(date_format(end_date, "%m")), 0) count, cal.month'))
        //     ->rightJoin('cal', function ($join) {
        //         $join
        //             ->on('cal.month_num', DB::raw('date_format(end_date, "%m")'))
        //             ->whereYear('end_date', date('Y'))
        //             ->where('event_status', '=', config('tracki.project_status.completed'))
        //             ->whereNull('archived');
        //     })
        //     ->groupBy('cal.month')
        //     ->orderBy('cal.month_num')
        //     ->get();


        $employee_nationality_bar = Employee::join('nationalities', 'nationalities.id', '=', 'employees_all.nationality')
            ->select('nationalities.nationality as name', DB::raw("count(nationalities.nationality) as value"))
            ->groupBy('nationalities.nationality')
            ->having('value', '>', '0')
            ->groupBy('nationalities.nationality', 'nationalities.nationality')
            ->get();

        $nationality_name = array();
        $count_of_nationality = array();
        $nationality_bar = array();

        foreach($employee_nationality_bar as $data){
            //append a new variable to an array
            $nationality_name[] = $data->name;
            $count_of_nationality[] = $data->value;
            $nationality_bar[] = [
                'name' => $data->name,
                'value' => $data->value,
                'country_name' => $data->nationality_name,
            ];
        }

        // dd(json_encode($nationality_bar));

        $employees_by_month = Employee::select(DB::raw('IFNULL(count(date_format(contract_start_date, "%m")), 0) count, cal.month'))
            ->rightJoin('cal', function ($join) {
                $join
                    ->on('cal.month_num', DB::raw('date_format(contract_start_date, "%m")'))
                    ->whereYear('contract_start_date', date('Y'));
            })
            ->groupBy('cal.month')
            // ->orderBy('cal.month_num')
            ->get();

        // $projects_by_month = DB::table('events')->select(DB::raw('IFNULL(count(date_format(end_date, "%m")), 0) count, cal.month'))
        //     ->rightJoin('cal', function ($join) {
        //         $join
        //             ->on('cal.month_num', DB::raw('date_format(end_date, "%m")'))
        //             ->whereYear('end_date', date('Y'))
        //             ->whereNull('archived');
        //     })
        //     ->groupBy('cal.month')
        //     ->orderBy('cal.month_num')
        //     ->get();

        // dd(DB::getQueryLog());
        // dd($completed_projects_by_month1);

        // $budgeted_projects_by_month = Event::select(DB::raw('IFNULL(count(date_format(start_date, "%m")), 0) count, cal.month'))
        //     ->rightJoin('cal', function ($join) {
        //         $join
        //             ->on('cal.month_num', DB::raw('date_format(start_date, "%m")'))
        //             ->whereYear('start_date', date('Y'))
        //             // ->where('event_status', '=', config('tracki.project_status.completed'))
        //             ->where('fund_category_id', '=', '1')
        //             ->whereNull('archived');
        //     })
        //     ->groupBy('cal.month')
        //     ->orderBy('cal.month_num')
        //     ->get();

        // $unbudgeted_projects_by_month = Event::select(DB::raw('IFNULL(count(date_format(start_date, "%m")), 0) count, cal.month'))
        //     ->rightJoin('cal', function ($join) {
        //         $join
        //             ->on('cal.month_num', DB::raw('date_format(start_date, "%m")'))
        //             ->whereYear('start_date', date('Y'))
        //             // ->where('event_status', '=', config('tracki.project_status.completed'))
        //             ->where('fund_category_id', '=', '2')
        //             ->whereNull('archived');
        //     })
        //     ->groupBy('cal.month')
        //     ->orderBy('cal.month_num')
        //     ->get();

        //  dd($budgeted_projects_by_month);


        // $fund_projects_by_month = Event::selectRaw('count(*) as total')
        //     ->selectRaw('count(case when fund_category_id=1 then 1 end) as budgeted')
        //     ->selectRaw('count(case when fund_category_id=2 then 1 end) as unbudgeted')
        //     ->selectRaw('date_format(end_date, "%m") as month')
        //     ->groupBy('month')
        //     ->whereYear('end_date', date('Y'))
        //     ->where('event_status', '=', config('tracki.project_status.completed'))
        //     ->whereNull('archived')
        //     ->get();


        // $budgeted_monthly = array();
        // $i = 0;
        // foreach ($budgeted_projects_by_month as $cp) {
        //     $budgeted_monthly[$i] = $cp->count;
        //     $i++;
        // }

        // // dd($budgeted_monthly);

        // $unbudgeted_monthly = array();
        // $i = 0;
        // foreach ($unbudgeted_projects_by_month as $cp) {
        //     $unbudgeted_monthly[$i] = $cp->count;
        //     $i++;
        // }

        // $completed_projects_by_month_array = array();
        // $i = 0;
        // foreach ($completed_projects_by_month as $cp) {
        //     $completed_projects_by_month_array[$i] = $cp->count;
        //     $i++;
        // }

        // $projects_by_month_array = array();
        // $i = 0;
        // foreach ($projects_by_month as $cp) {
        //     $projects_by_month_array[$i] = $cp->count;
        //     $i++;
        // }

        // $total_sales_by_month_array = array();
        // $i = 0;
        // foreach ($total_sales_by_month as $cp) {
        //     $total_sales_by_month_array[$i] = $cp->count;
        //     $i++;
        // }

        // if ($total_yearly_budget) {
        //     $remaining_budget = $total_yearly_budget?->budget_amount - $total_yearly_spent?->total_spent;
        //     // $total_yearly_budget->budget_amount

        //     $budget_percentage_used = ($total_yearly_spent?->total_spent / $total_yearly_budget?->budget_amount) * 100;
        // } else {
        //     $remaining_budget = 0;
        //     $budget_percentage_used = 0;
        // }

        // $todo_status_chart = Event::join('statuses', 'statuses.id', '=', 'events.event_status')
        //     ->select('statuses.title as name', DB::raw("count(statuses.title) as value"))
        //     ->groupBy('statuses.title')
        //     ->when($workspace, function ($query, $workspace) {
        //         return $query->where('events.workspace_id', $workspace);
        //     })
        //     ->having('value', '>', '0')
        //     ->get();

        // $project_status_chart = Event::join('statuses', 'statuses.id', '=', 'events.event_status')
        //     ->select('statuses.title as name', DB::raw("count(statuses.title) as value"))
        //     ->groupBy('statuses.title')
        //     ->when($workspace, function ($query, $workspace) {
        //         return $query->where('events.workspace_id', $workspace);
        //     })
        //     ->having('value', '>', '0')
        //     ->get();

        $employee_department_chart = Employee::join('department', 'department.id', '=', 'employees_all.department_id')
            ->select('department.name as name', DB::raw("count(department.name) as value"))
            ->groupBy('department.name')
            ->having('value', '>', '0')
            ->get();

        $employee_directorate_chart = Employee::join('directorate', 'directorate.id', '=', 'employees_all.directorate_id')
            ->select('directorate.title as name', DB::raw("count(directorate.title) as value"))
            ->groupBy('directorate.title')
            ->having('value', '>', '0')
            ->get();

        $employee_entity_chart = Employee::join('employee_entity', 'employee_entity.id', '=', 'employees_all.entity_id')
            ->select('employee_entity.title as name', DB::raw("count(employee_entity.title) as value"))
            ->groupBy('employee_entity.title')
            ->having('value', '>', '0')
            ->get();

        $employee_functional_area_chart = Employee::join('functional_areas', 'functional_areas.id', '=', 'employees_all.functional_area_id')
            ->select('functional_areas.name as name', DB::raw("count(functional_areas.name) as value"))
            ->groupBy('functional_areas.name')
            ->having('value', '>', '0')
            ->get();
        // dump(vsprintf(str_replace(['?'], ['\'%s\''], $total_sales_by_month->toSql()), $total_sales_by_month->getBindings()));

        // dd($total_sales_by_month_array);
        // dd($total_sales_by_month->getBindings());
        // dd($total_sales_by_month->toSql());

        return view('tracki.employee.dashboard', [
            'employee_count' => $employee_count,
            'employees_by_month' => $employees_by_month,
            'employee_department_chart' => $employee_department_chart,
            'employee_directorate_chart' => $employee_directorate_chart,
            'employee_entity_chart' => $employee_entity_chart,
            'employee_nationality_bar' => $employee_nationality_bar,
            'employee_functional_area_chart' => $employee_functional_area_chart,
            'user_workspace' => $user_workspace,
            'nationality_name' => $nationality_name,
            'count_of_nationality' => $count_of_nationality,
            'nationality_bar' => $nationality_bar,
        ]);
    }  //trackiDashboard


}
