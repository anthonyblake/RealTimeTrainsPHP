<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
  <title>Departure Board @anthonyblakedev</title>
  <?php include 'getDepartures.php';
    ?>
</head>
<body>
    <div id="tableHolder"></div>
    </body>

    <?php 
    //echo CallAPI('GET', 'https://api.rtt.io/api/v1/json/search/PRE', '');
    ?>
</html>

<script type="text/javascript">
        $(document).ready(function(){
        refreshTable();
        });

        function refreshTable(){
            $('#tableHolder').load('getTable.php', function(){
            setTimeout(refreshTable, 30000);
            });
        }
</script>