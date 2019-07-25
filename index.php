<html>
    <head>
        <title></title>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"
                integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
                crossorigin="anonymous">
        </script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>

    <body>

    <?php require_once 'process.php'; ?>

    <?php
    if(isset($_SESSION['message'])):?>
    <div class="alert alert-<=$_SESSION['msg_type']?>">

    <?php 
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    ?>
    </div>
    <?php endif ?>

    <div class="container">

    <?php
        $mysqli = new mysqli('localhost','root','mypass123','crud') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM data") or die ($mysqli->error);

        //pre_r($result);
    ?>

    <div class="row justify-content-center">
        <table class="table">
            <head>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th colspan="2">Action</th>
                </tr>
            </head>
        <?php
            while ($row = $result->fetch_assoc()):?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td>
                    <a href="index.php?edit=<?php echo $row['id']; ?>" 
                    class="btn btn-info">Edit</a>
                    <a href="process.php?delete=<?php echo $row['id']; ?>" 
                    class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </table>
    </div>

    <?php
        function pre_r( $array ){
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }

    ?>
        <div class="row justify-content-center">
            <form action="process.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter your name">
                </div>
                <div class="form-group">
                    <label>Location</label>
                    <input type="text" name="location" class="form-control" value="<?php echo $location; ?>" placeholder="Enter your location">
                </div>
                <div class="form-group">
                <?php
                if ($update == true):
                ?>
                <button class="btn btn-info" type="submit" name="save">Update</button>
                <?php else: ?>
                    <button class="btn btn-primary" type="submit" name="save">Save</button>
                <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
    </body>
</html>