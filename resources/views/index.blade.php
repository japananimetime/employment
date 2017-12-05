<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="https://pingendo.com/assets/bootstrap/bootstrap-4.0.0-beta.1.css" type="text/css"> </head>

<body>
  <nav class="navbar navbar-expand-md bg-secondary navbar-dark">
    <div class="container">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
      <div class="collapse navbar-collapse m-0 p-0" id="navbarSupportedContent">
        <form class="form-inline m-0 w-100 p-0" method="get" action="/search">
          <input class="form-control mr-2 w-25" type="text" value="" placeholder="Name" name="name">
          <input class="form-control mr-2 w-25" type="text" value="" placeholder="Surname" name="surname">
          <button type="submit" class="btn btn-primary">Find</button>
       	</form>
      </div>
    </div>
  </nav>
  <div class="py-5">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-2">
          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a href="#" class="active nav-link">Filter</a>
            </li>
          </ul>
          <form class="" method="get" action="/filter">
            <fieldset class="form-group">
              @foreach ($departments as $department)
              	<div class="radio-inline"><label class="form-control-label"><input type="radio" name="category" value="{{$department->dept_no}}">{{$department->dept_name}}</label></div>
              @endforeach
            </fieldset>
            <button type="submit" class="btn btn-primary">Apply
              <br>
            </button>
          </form>
        </div>
        <div class="col-md-9 ">
        	<?php $i = 0?>
        	@foreach ($employees as $employee)
        	<?php $i = $i + 1?>
        	<?php if ($i == 1):?>  	
		    	<div class="row">
        	<?php endif;?>
	            <div class="col-md-6">
	              <a href="/employee/{{$employee->emp_no}}"><h1 class="">{{$employee->first_name}} {{$employee->last_name}}</h1></a>
	              <p class="lead">Works in {{$employee->dept_name}} departament</p>
	              <div class="blockquote">
	                <p class="mb-0">Current title: {{$employee->title}}</p>
	                <div class="blockquote-footer">Current Salary: ${{$employee->salary}}</div>
	              </div>
	            </div>
	        <?php if ($i == 2):?>
	          <?php $i = 0?>       	
	          </div>
	        <?php endif;?>
	        @endforeach
        </div>
      </div>
        <div class="row">
        	<div class="col-md-4">
			</div>
        	<div class="col-md-4">
        		<center>
        			{{$employees->links()}}
        		</center>
        	</div>
        	<div class="col-md-4">
        	</div>
        </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>

</html>