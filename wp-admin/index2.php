<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
            <div class="row">
                <h3 style="text-align:center; color:blue;">PHP CRUD Grid | Golden State Warriors</h3>
            </div>
            <div class="row">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th> ID </th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Position</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'database.php';
                   global $wpdb;


                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM  wp_roster ORDER BY id ASC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['ID'] . '</td>';
                            echo '<td>'. $row['First Name'] . '</td>';
                            echo '<td>'. $row['Last Name'] . '</td>';
                            echo '<td>'. $row['Position'] . '</td>';
                            echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>
