<?php

    require 'database.php';
    //global $wpdb;

    if ( !empty($_POST)) {
        // keep track validation errors
        $IDError = null;
        $FirstNameError = null;
        $LastNameError = null;
        $PositionError = null;

        // keep track post values
        $id = $_POST['ID'];
        $FirstName = $_POST['FirstName'];
        $LastName = $_POST['LastName'];
        $Position = $_POST['Position'];

        // validate input
        $valid = true;
        if (empty($id)) {
            $IDError = 'Please enter ID';
            $valid = false;
        }

        if (empty($FirstName)) {
            $FirstNameError = 'Please enter Name';
            $valid = false;
        }

        if (empty($LastName)) {
            $LastNameError = 'Please enter Last Name';
            $valid = false;
        }
         
        if (empty($Position)) {
            $PositionError = 'Please enter Position';
            $valid = false;
        }

        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO wp_roster (ID,FirstName,LastName,Position) values(?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($id,$FirstName,$LastName,$Position));
            Database::disconnect();
            header("Location: index2.php");
        }
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
                        <h2 style="margin-left:204px;">Create Player</h2>
                    </div>

                    <form class="form-horizontal" action="create.php" method="post">
                      <div class="control-group <?php echo !empty($IDError)?'error':'';?>">
                        <label class="control-label">ID</label>
                        <div class="controls">
                            <input name="ID" type="text"  placeholder="ID" value="<?php echo !empty($id)?$id:'';?>">
                            <?php if (!empty($IDError)): ?>
                                <span class="help-inline"><?php echo $IDError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($FirstNameError)?'error':'';?>">
                        <label class="control-label">First Name</label>
                        <div class="controls">
                            <input name="FirstName" type="text"  placeholder="First Name" value="<?php echo !empty($FirstName)?$FirstName:'';?>">
                            <?php if (!empty($FirstNameError)): ?>
                                <span class="help-inline"><?php echo $FirstNameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($LastNameError)?'error':'';?>">
                        <label class="control-label">Last Name</label>
                        <div class="controls">
                            <input name="LastName" type="text" placeholder="Last Name" value="<?php echo !empty($LastName)?$LastName:'';?>">
                            <?php if (!empty($LastNameError)): ?>
                                <span class="help-inline"><?php echo $LastNameError;?></span>
                            <?php endif;?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($PositionError)?'error':'';?>">
                        <label class="control-label">Position</label>
                        <div class="controls">
                            <input name="Position" type="text"  placeholder="Position" value="<?php echo !empty($Position)?$Position:'';?>">
                            <?php if (!empty($PositionError)): ?>
                                <span class="help-inline"><?php echo $PositionError;?></span>
                            <?php endif;?>
                        </div>
                      </div>


                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="index2.php">Back</a>
                        </div>
                    </form>
                </div>

    </div> <!-- /container -->
  </body>
</html>
