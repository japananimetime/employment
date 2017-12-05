<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use \Cache;


class MainController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function getCurrentWorkersPaginated() {
    	$minutes = 30000;
	    $key = 'main';
    	$employees = Cache::get($key);
    	if ($employees === null) {
			$employees = DB::table('employees')
	    		->join('dept_emp', 'employees.emp_no', '=', 'dept_emp.emp_no')
	    		->join('departments', 'dept_emp.dept_no', '=', 'departments.dept_no')
	    		->join('titles', 'employees.emp_no', '=', 'titles.emp_no')
	    		->join('salaries', 'employees.emp_no', '=', 'salaries.emp_no')
	    		->select('employees.emp_no', 'first_name', 'last_name','title', 'gender', 'hire_date', 'departments.dept_no', 'departments.dept_name', 'dept_emp.from_date', 'birth_date','salary')
	    		->where('dept_emp.to_date','9999-01-01')
	    		->where('titles.to_date','9999-01-01')
	    		->where('salaries.to_date','9999-01-01')
	    		->paginate(14); 	
	    	$result = Cache::add($key, $employees, $minutes);
		}
		$departments = DB::table('departments')->get();
    	return view('index', ['employees' => $employees, 'departments' => $departments]);
    }
    public function getCurrentWorkersByDepartmentPaginated() {
    	$minutes = 30;
	    $key = $_GET['category'];
    	$employees = Cache::get($key);
    	if ($employees === null) {
    		$employees = DB::table('employees')
	    		->join('dept_emp', 'employees.emp_no', '=', 'dept_emp.emp_no')
	    		->join('departments', 'dept_emp.dept_no', '=', 'departments.dept_no')
	    		->join('titles', 'employees.emp_no', '=', 'titles.emp_no')
	    		->join('salaries', 'employees.emp_no', '=', 'salaries.emp_no')
	    		->select('employees.emp_no', 'first_name', 'last_name','title', 'gender', 'hire_date', 'departments.dept_no', 'departments.dept_name', 'dept_emp.from_date', 'birth_date','salary')
	    		->where('dept_emp.to_date','9999-01-01')
	    		->where('titles.to_date','9999-01-01')
	    		->where('salaries.to_date','9999-01-01')
	    		->where('dept_emp.dept_no', $_GET['category'])
	    		->paginate(14)
	    		->appends(request()->query());
	    	$result = Cache::add($key, $employees, $minutes);
	    }    	
    	$departments = DB::table('departments')->get();
    	return view('index', ['employees' => $employees, 'departments' => $departments]);
    }
    public function searchCurrentWorkersPaginated() {
    	if (isset($_GET['name'])){
    		$name = $_GET['name'];
    	} else{
    		$name = '';
    	}
    	if (isset($_GET['surname'])){
    		$surname = $_GET['surname'];
    	} else{
    		$surname = '';
    	}
    	$minutes = 30;
	    $key = $name.$surname;
    	$employees = Cache::get($key);
    	if ($employees === null) {
	    	$employees = DB::table('employees')
	    		->join('dept_emp', 'employees.emp_no', '=', 'dept_emp.emp_no')
	    		->join('departments', 'dept_emp.dept_no', '=', 'departments.dept_no')
	    		->join('titles', 'employees.emp_no', '=', 'titles.emp_no')
	    		->join('salaries', 'employees.emp_no', '=', 'salaries.emp_no')
	    		->select('employees.emp_no', 'first_name', 'last_name','title', 'gender', 'hire_date', 'departments.dept_no', 'departments.dept_name', 'dept_emp.from_date', 'birth_date','salary')
	    		->where('dept_emp.to_date','9999-01-01')
	    		->where('titles.to_date','9999-01-01')
	    		->where('salaries.to_date','9999-01-01')
	    		->where([
	    			['employees.first_name', 'like', '%'.$name.'%'],
	    			['employees.last_name', 'like', '%'.$surname.'%']
	    		])
	    		->paginate(14)
	    		->appends(request()->query());
	     	$result = Cache::add($key, $employees, $minutes);
	    }    	    	
    	$departments = DB::table('departments')->get();
    	return view('index', ['employees' => $employees, 'departments' => $departments]);
    }
   	public function getSpecifiedEmployee($id) {
   		$minutes = 30;
	    $key = 'employee#'.$id;
    	$employees = Cache::get($key);
    	if ($employees === null) {
			$info = DB::table('employees')			
	    		->where('emp_no',$id)
	    		->get();
	    	$salaries = DB::table('salaries')
	    		->where('emp_no',$id)
	    		->get();
	    	$departaments = DB::table('dept_emp')
	    	    ->join('departments', 'dept_emp.dept_no', '=', 'departments.dept_no')
	    	    ->select('dept_emp.*', 'departments.dept_name')
	    		->where('emp_no',$id)
	    		->get();
	    	$titles = DB::table('titles')
	    		->where('emp_no',$id)
	    		->get();
	    	$manager = DB::table('dept_manager')
	    		->where('emp_no',$id)
	    		->get();
	    	$employee = array('info' => $info, 'salaries' => $salaries, 'departments' => $departaments, 'titles' => $titles, 'manager' => $manager);
	    	$result = Cache::add($key, $employees, $minutes);
	    }
    	// echo '<pre>'; print_r($employee); echo '</pre>';
		
    	return view('employee', ['employee' => $employee]);

   	}
}
