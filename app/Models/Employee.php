<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Employee extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];

    protected $table = 'employees_all';

    public static function boot(){

        parent::boot();

        static::creating(function($model){
            $personNumGen = PersonNumGen::firstOrFail();
            $last_number = $personNumGen->max('last_number') + 1;
            $personNumGen->update(['last_number' => $last_number]);

            $model->employee_number = 'ABC'.'-'.str_pad($last_number, 5, '0', STR_PAD_LEFT);
        });
    }

    public function emp_files()
    {
        return $this->hasOne(EmployeeFile::class, 'employee_id');
    }

    public function employee_types()
    {
        return $this->hasOne(EmployeeType::class, 'id', 'employee_type');
    }

    public function departments()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }

    public function directorate()
    {
        return $this->hasOne(EmployeeDirectorate::class, 'id', 'directorate_id');
    }

    public function functional_areas()
    {
        return $this->hasOne(FunctionalArea::class, 'id', 'functional_area_id');
    }

    public function entities()
    {
        return $this->hasOne(EmployeeEntity::class, 'id', 'entity_id');
    }

    public function contract_types()
    {
        return $this->hasOne(EmployeeContractType::class, 'id', 'contract_type_id');
    }

    public function sponsorships()
    {
        return $this->hasOne(EmployeeSponsorship::class, 'id', 'sponsorship_id');
    }

    public function job_levels()
    {
        return $this->hasOne(EmployeeJobLevel::class, 'id', 'job_level_id');
    }

    public function designation()
    {
        return $this->hasOne(Designation::class, 'id', 'designation_id');
    }

    public function countries()
    {
        return $this->hasOne(Country::class, 'id', 'country_of_birth');
    }

    public function nationalities()
    {
        return $this->hasOne(Nationality::class, 'id', 'nationality');
    }

    public function genders()
    {
        return $this->hasOne(Gender::class, 'id', 'gender_id');
    }

    public function marital_status()
    {
        return $this->hasOne(MaritalStatus::class, 'id', 'marital_status_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'employee_id', 'id');
    } 
    public function salutations()
    {
        return $this->hasOne(Salutation::class, 'id', 'salutation');
    }

    public function managers()
    {
        return $this->hasOne(Employee::class, 'id', 'reporting_to_id');
    }

    public function projects()
    {
        return $this->belongsToMany(Event::class, 'employee_project');
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'employee_task');
    }

    public function workspaces(){
        return $this->belongsToMany(Workspace::class, 'employee_workspace');
    }

    public function salariesxxx()
    {
        return $this->hasMany(EmployeeSalary::class, 'employee_id');
    }

    public function addresses()
    {
        return $this->hasMany(EmployeeAddress::class,'employee_id');
    }

    public function banks()
    {
        return $this->hasOne(EmployeeBank::class,'employee_id', 'id');
    }

    public function salaries()
    {
        return $this->hasOne(EmployeeSalary::class, 'employee_id', 'id');
    }

    public function attachments()
    {
        return $this->hasMany(EmployeeAttachment::class, 'employee_id');
    }

    public function relationships()
    {
        return $this->hasMany(EmployeeRelationship::class, 'employee_id');
    }

    public function leaves()
    {
        return $this->hasMany(EmployeeLeave::class, 'employee_id', 'id');
    }

    public function timesheets()
    {
        return $this->hasMany(EmployeeTimeSheet::class, 'employee_id');
    }
}
