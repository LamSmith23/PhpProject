<?php
    require 'database.php';
    $id = null;
    if ( !empty($_GET['ID'])) {
        $id = $_REQUEST['ID'];
    }

    if ( null==$id ) {
        header("Location: index2.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM wp_roster WHERE ID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container" style="margin-top:100px;">

                <div class="span10 offset1">
                    <div class="row">
                        <h2 style="margin-left:137px;">View Player</h2>
                    </div>

                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">ID:</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['ID'];?>
                            </label>
                        </div>
                      </div>

                      <div class="control-group">
                        <label class="control-label">First Name:</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['FirstName'];?>
                            </label>
                        </div>
                      </div>

                      <div class="control-group">
                        <label class="control-label">Last Name:</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['LastName'];?>
                            </label>
                        </div>
                      </div>

                      <div class="control-group">
                        <label class="control-label">Position:</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['Position'];?>
                            </label>
                        </div>
                      </div>

                        <div class="form-actions">
                          <a class="btn" href="index2.php">Back</a>
                       </div>


                    </div>
                </div>

    </div> <!-- /container -->
  </body>
</html>
