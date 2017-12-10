<!-- <?php// echo '<pre>'; print_r($genderP); echo '</pre>';?> -->
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
    <a href="/"><button class="btn btn-primary">Main</button></a>
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
    </div>
    <a href="/statistics"><button class="btn btn-primary">Statistics</button></a>   
  </nav>
  <div class="py-5">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-1 ">
        </div>
        <div class="col-md-5 ">
          <h2 class="display-4">{{$dept_name["0"]->dept_name}}</h2>
          <br>
          <h2 style="display: inline" class="">Workers:&nbsp;</h2><h4 style="display: inline" class="">{{$workers}}</h4><br>
          <br>
          <h2 class="" style="display: inline">Average salary:&nbsp;</h2><h4 style="display: inline">${{$currentSalaryAVG["0"]->salary}}</h4><br>
          <br>
          <h2 class="">Manager:
            <br>
          </h2>
            @foreach ($manager as $man)
            <h4 class="px-5"><a href="/employee/{{$man->emp_no}}">{{$man->first_name}} {{$man->last_name}}</a></h4>
            <h6 class="text-muted px-5">{{$man->from_date}} till 
              <?php 
                if ($man->to_date == '9999-01-01'):
                  echo 'nowadays';
                else:
                  echo $man->to_date;
                endif;
              ?>
            </h6>            
          @endforeach      
        </div>
        <div class="col-md-5 "><br><br><br> 
          <details>
            <summary>
              Average salary of the worker in the department through the years:
            </summary>
            <div id="myDiv"></div>
          </details>
          <br>
          <details>
            <summary>
              Gender proportion in the department
            </summary>
            <div id="pie"></div>
          </details>
        </div>
        <div class="col-md-1 ">
        </div>
      </div>      
    </div>
  </div>
  <script type="text/javascript">
    var data = [
      {
        x: [@foreach ($deptData as $period) '{{$period->Year}}',@endforeach],
        y: [@foreach ($deptData as $period) '{{$period->salary}}',@endforeach],
        type: 'scatter'
      }
    ];
      var layout = {
        height: 400,
        width: 500
      };

    Plotly.newPlot('myDiv', data, layout);
  </script>
    <script type="text/javascript">
      var data = [{
        values: [{{$genderP["0"]->c}}, {{$genderP["1"]->c}}],
        labels: ['Male', 'Female'],
        type: 'pie'
      }];

      var layout = {
        height: 400,
        width: 500
      };

    Plotly.newPlot('pie', data, layout);
  </script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>

</html>