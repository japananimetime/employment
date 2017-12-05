<?php //echo '<pre>'; print_r($employee); echo '</pre>';?>
<!DOCTYPE html>
<html>

<head></head>

<body>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="https://pingendo.com/assets/bootstrap/bootstrap-4.0.0-beta.1.css" type="text/css">
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
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
        <div class="col-md-1 ">
        </div>
        <div class="col-md-6 ">
          <h2 class="display-4">{{$employee["info"][0]->first_name}} {{$employee["info"][0]->last_name}}</h2>
          <h2 style="display: inline" class="">Born:&nbsp;</h2><h4 style="display: inline" class="">{{$employee["info"][0]->birth_date}}</h4><br>
          <h2 class="" style="display: inline">Gender:&nbsp;</h2><h4 style="display: inline">
            <?php 
              if ($employee["info"][0]->gender == 'M'):
                echo 'Male';
              else:
                echo 'Female';
              endif;
            ?>
              </h4><br>
          <h2 style="display: inline" class="">Hired:&nbsp;</h2><h4 style="display: inline">{{$employee["info"][0]->hire_date}}
            <br>
          </h4>
          <h2 class="">Part of:
            <br>
          </h2>
          @foreach ($employee["departments"] as $department)
            <h4 class="px-5">{{$department->dept_name}} department</h4>
            <h6 class="text-muted px-5">{{$department->from_date}} till 
              <?php 
                if ($department->to_date == '9999-01-01'):
                  echo 'nowadays';
                else:
                  echo $department->to_date;
                endif;
              ?>
                  </h6>            
          @endforeach
          <h2 class="">Title: </h2><h4 class="px-5">@foreach ($employee["titles"] as $title){{$title->title}} since {{$title->from_date}} <br>@endforeach</h4>
        </div>
        <div class="col-md-5 "><br><br><br> Salary though the years:
          <div id="myDiv"></div>
        </div>
      </div>      
    </div>
  </div>
  <script type="text/javascript">
    var data = [
      {
        x: [@foreach ($employee["salaries"] as $salary) '{{$salary->from_date}}',@endforeach],
        y: [@foreach ($employee["salaries"] as $salary) '{{$salary->salary}}',@endforeach],
        type: 'scatter'
      }
    ];

    Plotly.newPlot('myDiv', data);
  </script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>

</html>