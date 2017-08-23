<?php
    require 'database.php';
    $id = 0;

    if ( !empty($_GET['ID'])) {
        $id = $_REQUEST['ID'];
    }

    if ( !empty($_POST)) {
        // keep track post values
        $id = $_POST['ID'];

        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE  FROM wp_roster  WHERE ID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Database::disconnect();
        header("Location: index2.php");

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container" style="margin-top:100px;">

                <div class="span10 offset1">
                    <div class="row">
                        <h3>Delete Player</h3>
                    </div>

                    <form class="form-horizontal" action="delete.php" method="post">
                      <input type="hidden" name="ID" value="<?php echo $id;?>"/>
                      <p class="alert alert-error">Are you sure Cut This Player ?  </p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn" href="index2.php">No</a>
                        </div>
                    </form>
                </div>

    </div> <!-- /container -->
  </body>
</html>
