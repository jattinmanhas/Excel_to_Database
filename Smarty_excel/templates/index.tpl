<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test Excel</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.2/datatables.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-12 mt-4 mb-5">
          <h2 class="mb-4 text-center">Excel File Export</h2>
          <hr>
          <form action="../modules/index.php" method="POST" enctype="multipart/form-data">
            <div class="card card-body shadow-sm">
              <div class="row">
                <div class="col-md-2 my-auto">
                  <h5>Select File: </h5>
                </div>
                <div class="col-md-4">
                  <input type="file" name="import_file" class="form-control">
                </div>
                <div class="col-md-4">
                  <button type="submit" name="import_file_btn" class="btn btn-primary">Upload</button>
                  <button type="submit" name="delete_file_btn" class="btn btn-danger">Delete</button>
                  <button type="submit" name="download_file_btn" class="btn btn-warning">Download</button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!-- Table for the data. -->
        <table id="myTable" class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>FULL NAME</th>
                <th>JOB TITLE</th>
                <th>DEPARTMENT</th>
                <th>GENDER</th>
                <th>AGE</th>
                <th>ANNUAL SALARY</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$data item=item}
                <tr>
                    <td class="border border-black-600 p-2">{$item.id}</td>
                    <td class="border border-black-600 p-2">{$item.full_name}</td>
                    <td class="border border-black-600 p-2">{$item.job_title}</td>
                    <td class="border border-black-600 p-2">{$item.department}</td>
                    <td class="border border-black-600 p-2">{$item.gender}</td>
                    <td class="border border-black-600 p-2">{$item.age}</td>
                    <td class="border border-black-600 p-2">{$item.annual_salary}</td>

                </tr>
        {/foreach}
        </tbody>
    </table>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.2/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    {literal}
    <script>
        $(document).ready( function () {
        $('#myTable').DataTable();
    } );
    </script>
    {/literal}
  </body>
</html>
