<!DOCTYPE html>
<html>
 <head>
  <title>Grootan Coding Assignment</title>  
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
 
 </head>
 <body style="background-image: linear-gradient(-90deg, rgb(238, 123, 15), rgb(82, 39, 39));">
  
  <br />
  <br />
  <div class="container">
   <h1 align="center" style="color: white;">Grootan Coding Assignment</h1>
   <br />
   <div class="panel panel-default">
    <div class="panel-heading">
     <h3 class="panel-title">Import Large CSV File Data into DataBase Table</h3>
    </div>
      <div class="panel-body">
       <span id="message"></span>
       <form id="sample_form" method="POST" enctype="multipart/form-data" class="form-horizontal" action="store.php">
        <div class="form-group" style="text-align:center">
         Select CSV File<br><br>
         <input type="file" name="file" id="file" style="margin-left:40%;" accept=".csv" required/><br><br>
         Table Name
         <input type="text" name="table" id="file" required />
        </div>
        <div class="form-group" align="center">
         <input type="hidden" name="hidden_field" value="1" />
         <input type="submit" name="import" id="import" class="btn btn-info" value="Import" />
        </div>
       </form>
      </div>
     </div>
  </div>
 </body>
</html>

