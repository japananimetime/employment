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
    public function getCurrentWorkersByTitlePaginated($id){
    	$minutes = 30;
	    $key = 'titleView'.$id;
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
	    		->where('title', $id)
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
    	$minutes = 10;
	    $key = 'departments';
    	$departments = Cache::get($key);
    	if ($departaments === null) {
	   			$departments = DB::table('departments')->get();
		}
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
	    	$employees = array('info' => $info, 'salaries' => $salaries, 'departments' => $departaments, 'titles' => $titles, 'manager' => $manager);
	    	$result = Cache::add($key, $employees, $minutes);
	    }
    	// echo '<pre>'; print_r($employee); echo '</pre>';
		
    	return view('employee', ['employee' => $employees]);

   	}    
   	public function statistics() {
   		$minutes = 10;
	    $key = 'currentSalariesAVG';
    	$currentSalariesAVG = Cache::get($key);
    	if ($currentSalariesAVG === null) {
	   		$currentSalariesAVG = DB::table('salaries')
	   			->join('dept_emp', 'dept_emp.emp_no', '=', 'salaries.emp_no')
				->join('departments', 'dept_emp.dept_no', '=', 'departments.dept_no')
	   			->select(DB::raw('avg(`salary`) AS salary, `dept_name`,`departments`.`dept_no`'))
	    		->where('salaries.to_date','9999-01-01')
	    		->groupBy('dept_emp.dept_no')
	    		->get();;
		    	// echo '<pre>'; print_r($currentSalariesAVG); echo '</pre>';
	    }	    
	    $minutes = 10;
	    $key = 'currentTitleSalariesAVG';
    	$currentTitleSalariesAVG = Cache::get($key);
    	if ($currentTitleSalariesAVG === null) {
	   		$currentTitleSalariesAVG = DB::table('salaries')
	   			->join('dept_emp', 'dept_emp.emp_no', '=', 'salaries.emp_no')
				->join('titles', 'dept_emp.emp_no', '=', 'titles.emp_no')
	   			->select(DB::raw('avg(`salary`) AS salary, `title`'))
	    		->where('salaries.to_date','9999-01-01')
	    		->groupBy('title')
	    		->orderBy('salary', 'desc')
	    		->get();;
		    	// echo '<pre>'; print_r($currentSalariesAVG); echo '</pre>';
	    }
	    return view('statistics', ['currentSalariesAVG' => $currentSalariesAVG, 'currentTitleSalariesAVG' => $currentTitleSalariesAVG]);
   	}
   	public function getDepartmentStatistics($id) {
   		$minutes = 10;
	    $key = 'deptData'.$id;
    	$deptData = Cache::get($key);
    	if ($deptData === null) {
	   		$deptData = DB::table('salaries')
		   		->join('dept_emp', 'dept_emp.emp_no', '=', 'salaries.emp_no')
				->join('departments', 'dept_emp.dept_no', '=', 'departments.dept_no')
		   		->select(DB::raw('YEAR(`salaries`.`from_date`) AS \'Year\', AVG(`salary`) AS \'salary\''))
	    		->where('dept_emp.dept_no',$id)
	    		->groupBy(DB::raw('YEAR(`salaries`.`from_date`)'))
				->get();
				//echo '<pre>'; print_r($deptData); echo '</pre>';
		}
		$minutes = 10;
	    $key = 'genderP';
    	$genderP = Cache::get($key);
    	if ($genderP === null) {
	   		$genderP = DB::table('employees')
	   			->join('dept_emp', 'dept_emp.emp_no', '=', 'employees.emp_no')
	   			->select(DB::raw('`gender`, COUNT(`gender`) AS \'c\''))
	   			->where('dept_emp.to_date','9999-01-01')
	    		->where('dept_no', $id)
	    		->groupBy('gender')
	    		->get();;
		    	// echo '<pre>'; print_r($currentSalariesAVG); echo '</pre>';
	    }
		$minutes = 10;
	    $key = 'deptName'.$id;
    	$deptName = Cache::get($key);
    	if ($deptName === null) {
	   		$deptName = DB::table('departments')
	   			->select('dept_name')
	    		->where('dept_no',$id)
	    		->get();
				//echo '<pre>'; print_r($deptData); echo '</pre>';
		}
		$minutes = 10;
	    $key = 'workers'.$id;
    	$workers = Cache::get($key);
    	if ($workers === null) {
	   		$workers =  DB::table('dept_emp')	    	    
	    		->where('dept_no',$id)
	    		->where('to_date','9999-01-01')
	    		->count('emp_no');	    		
		}
		$minutes = 10;
	    $key = 'currentSalaryAVG'.$id;
    	$currentSalaryAVG = Cache::get($key);
    	if ($currentSalaryAVG === null) {
	   		$currentSalaryAVG = DB::table('salaries')
	   			->join('dept_emp', 'dept_emp.emp_no', '=', 'salaries.emp_no')
	   			->select(DB::raw('avg(`salary`) AS salary'))
	   			->where('dept_no',$id)
	    		->where('salaries.to_date','9999-01-01')
	    		->get();;
		    	// echo '<pre>'; print_r($currentSalariesAVG); echo '</pre>';
	    }
	    $minutes = 10;
	    $key = 'manager'.$id;
    	$manager = Cache::get($key);
    	if ($manager === null) {
	   		$manager = DB::table('dept_manager')
	   			->join('dept_emp', 'dept_emp.emp_no', '=', 'dept_manager.emp_no')
	   			->join('employees', 'employees.emp_no', '=', 'dept_manager.emp_no')
	   			->select('dept_manager.emp_no', 'dept_manager.from_date', 'dept_manager.to_date', 'first_name', 'last_name')
	   			->where('dept_manager.dept_no',$id)
	   			->orderBy('dept_manager.to_date', 'desc')
	    		->get();
		    	// echo '<pre>'; print_r($currentSalariesAVG); echo '</pre>';
	    }
		return view('department', ['deptData' => $deptData, 'dept_name' => $deptName, 'workers' => $workers, 'currentSalaryAVG' => $currentSalaryAVG, 'manager' => $manager, 'genderP' => $genderP]);
   	}
}
