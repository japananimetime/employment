<?php //echo '<pre>'; print_r($data); echo '</pre>';?>
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
      <details>
       <summary><center><h1>Average salary on current moment through the depatments<br><br></h1></center></summary>
      <div class="row">
        <div class="col-md-1">
        </div>
         <div class="col-md-10">
            <?php $i = 0?>
            @foreach($currentSalariesAVG as $department)
            <?php $i = $i + 1?>
            <?php if ($i == 1):?>   
            <div class="row">
            <?php endif;?>
              <div class="col-md-4">
                <br>
                <h2><a href="/department/{{$department->dept_no}}">{{$department->dept_name}}</a></h2>
                <h3>${{$department->salary}}</h3>
              </div>
            <?php if ($i == 6):?>
              <?php $i = 0?>        
              </div>
            <?php endif;?>
            @endforeach
        </div>
        <div class="col-md-1">
        </div>
      </div>
      </details>
      <details>
       <summary><center><h1>Average salary on current moment through the titles<br><br></h1></center></summary>
      <div class="row">
        <div class="col-md-1">
        </div>
         <div class="col-md-10">
            <?php $i = 0?>
            @foreach($currentTitleSalariesAVG as $title)
            <?php $i = $i + 1?>
            <?php if ($i == 1):?>   
            <div class="row">
            <?php endif;?>
              <div class="col-md-4">
                <br>
                <h2><a href="/title/{{$title->title}}">{{$title->title}}</a></h2>
                <h3>${{$title->salary}}</h3>
              </div>
            <?php if ($i == 6):?>
              <?php $i = 0?>        
              </div>
            <?php endif;?>
            @endforeach
        </div>
        <div class="col-md-1">
        </div>
      </div>
      </details>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>

</html>