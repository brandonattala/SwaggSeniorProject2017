<?php 
$promos= json_decode(file_get_contents("http://jserv.asuscomm.com/api/promotions"));
?>
<html>
  <!-- Header, Title, external elements, and scripts -->
  <head>
    <meta charset="utf-8">
    <title>Swagg</title>
    <!-- JQuery through web -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- Used for site wide javascript, in this case table formatting -->
    <!-- IN DEVELOPMENT -->
    <script language="javascript" src="site.js"></script>

    <!-- Scripts for page -->
    <script type="text/javascript">
      //Uses Ajax and JQuery functionality to adjust elements dynamically
      $(function(){

      });
    </script>

    <!-- Used to enhance the buttons to look a little better than native bootstrap -->
    <style media="screen">
      .btn {
        padding: 14px 24px;
        border: 0 none;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
      }

      .btn:focus, .btn:active:focus, .btn.active:focus {
        outline: 0 none;
      }

      .btn-primary {
        background: #0099cc;
        color: #ffffff;
      }

      .btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .open > .dropdown-toggle.btn-primary {
        background: #33a6cc;
      }

      .btn-primary:active, .btn-primary.active {
        background: #007299;
        box-shadow: none;
      }
    </style>
  </head>
  <body>

    <!-- Submission buttons and header for page -->
    <div class="container-fluid fixed-header-page-body clearfix">
      <div class="row" style="margin-bottom:10px;">
        <div class="col-xs-12 col-sm-4 col-lg-4">
          <h1 class="heading">
            My Promotions
          </h1>
          <span style="color:red"> (View Promotions DEV)</span>
        </div>
        <div class="col-xs-12 col-sm-8 col-lg-8 text-right">
          <a href="index.htm" class="btn btn-primary">Home</a>
        </div>
      </div>
    </div>

    <!-- Main, Actual fields for input -->
    <div class="container-fluid">
      <!-- Hidden div, this is where the alert message is displayed or not depending on user input validation -->
      <div id="ErrorMsg" class="alert alert-danger" style="display:none"></div>

      <!-- Displays in a table format the current promotions a user has -->
      <form name="frmView" id="frmView" method="post" class="form">
        <div class="row">
          <div class="col-sm-2">&nbsp;</div>
          <div class="col-sm-8">
            <div class="list-data">
              <table id="tblData" class="table table-bordered table-data" style="overflow-y:auto;">
                <thead>
                  <tr>
                    <th class="text-center col-sm-2">
                      Actions
                    </th>
                    <th class="text-center col-sm-6">
                      Title
                    </th>
                  </tr>
                </thead>
                <tbody>
				<?php 
					foreach($promos as $promo){
						echo 
						"<tr>"
						. "<td class='text-center' style='white-space:nowrap'>"
						. "<a href='doEdit' class='btn btn-default' title='Edit'><span class='glyphicon glyphicon-edit'></span></a>"
						. "<a href='doDelete' class='btn btn-default delete' title='Delete'><span class='glyphicon glyphicon-remove'></span></a>"
						. "</td>"
						. "<td class='text-left'>"
						. $promo->Title
						. "</td>"
						. "</tr>";
					}
				?>
                      
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </form>
    </div>
  </body>
</html>
