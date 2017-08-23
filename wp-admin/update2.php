<?php
    require 'database.php';

    $id = null;
    if ( !empty($_GET['ID'])) {
        $id = $_REQUEST['ID'];
    }

    if ( null==$id ) {
        header("Location: index2.php");
    }

    if ( !empty($_POST)) {
        // keep track validation errors
        $FirstNameError = null;
        $LastNameError = null;
        $PositionError = null;

        // keep track post values
        $FirstName = $_POST['FirstName'];
        $LastName = $_POST['LastName'];
        $Position = $_POST['Position'];

        // validate input
        $valid = true;
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

        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE wp_roster SET FirstName = ?, LastName = ?, Position =? WHERE ID = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($FirstName,$LastName,$Position,$id));
            Database::disconnect();
            header("Location: index2.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM wp_roster WHERE ID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $FirstName = $data['FirstName'];
        $LastName = $data['LastName'];
        $Position = $data['Position'];
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
    <div class="container">

                <div class="span10 offset1">
                    <div class="row">
                        <h3>Update Player</h3>
                    </div>

                    <form class="form-horizontal" action="update2.php?ID=<?php echo $id?>" method="post">
                      <div class="control-group <?php echo !empty($FirstNameError)?'error':'';?>">
                        <label class="control-label">First Name:</label>
                        <div class="controls">
                            <input name="FirstName" type="text"  placeholder="First Name" value="<?php echo !empty($FirstName)?$FirstName:'';?>">
                            <?php if (!empty($FirstNameError)): ?>
                                <span class="help-inline"><?php echo $FirstNameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($LastNameError)?'error':'';?>">
                        <label class="control-label">Last Name:</label>
                        <div class="controls">
                            <input name="LastName" type="text" placeholder="Last Name" value="<?php echo !empty($LastName)?$LastName:'';?>">
                            <?php if (!empty($LastNameError)): ?>
                                <span class="help-inline"><?php echo $LastNameError;?></span>
                            <?php endif;?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($PositionError)?'error':'';?>">
                        <label class="control-label">Position:</label>
                        <div class="controls">
                            <input name="Position" type="text"  placeholder="Position" value="<?php echo !empty($Position)?$Position:'';?>">
                            <?php if (!empty($PositionError)): ?>
                                <span class="help-inline"><?php echo $PositionError;?></span>
                            <?php endif;?>
                        </div>
                      </div>

                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update Player</button>
                          <a class="btn" href="index2.php">Back</a>
                        </div>
                    </form>
                </div>

    </div> <!-- /container -->
  </body>
</html>
