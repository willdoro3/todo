<!DOCTYPE html>
<html>
    <head>
        <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>



        <title style = "font-family:latin">ToDo List</title>
    </head>

    <?php
$servername = "servername";
$username = "username";
$password = "password";
$dbname = "database";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


?>

    <body>

  <div class = "container">
  <div class = "row">
  <div class = "col-lg-12" style = "background-color:pink">
    
    <br><br><h1 style = "color:blue; font-weight:bold; font-family:cursive">ToDo List</h1>

    <?
        // Add item
        if(isset($_POST['add'])){
            $item = filter_var($_POST['item']);

            // Adds to database
            $sql = "INSERT INTO todo (item) VALUES ('{$item}')";

        //echo $sql;die;
        if (mysqli_query($conn, $sql)) {
            echo '<div class="alert alert-success">
                <strong>Success!</strong> Item Added!
                </div>';
        }  else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
        }

        // Delete Item
        if (isset($_POST['delete'])){
            $item = filter_var($_POST['item']);

            // Delete from database
            $sql = "DELETE FROM todo WHERE id ='{$_POST['id']}'";
            if (mysqli_query($conn, $sql)){
                echo '<div class="alert alert-danger">
                <strong>Danger!</strong> Item Deleted!
                </div>';
                }
            else {
                echo "Error deleting record: " . mysqli_error($conn);
                }
            }

           



            

    ?>

    <form action = "index.php" method = "POST">
        <br><input type = "text" name = "item" placeholder = "item" style = "width:300px; height:40px;"><br><br>
        <input type = "submit" name = "add" value = "Add Item" style = "background-color:blue; color:white; font-family:cursive;"><br>
    </form><br><br>
    <table class = "table table-striped table-hover">
            <tr>
                <th>Item</th>
                <th>Delete</th>
               
    </tr>


<?
    $sql = "SELECT * FROM todo";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
        ?>
<tr>
    <td><?=$row['item']?></td>
   
    <td>
    <form action = "index.php" method = "POST">
                <input type = "submit" name = "delete" value = "Delete Item" style = "background-color:red; color:white">
                <input type = "hidden" name = "id" value = "<?=$row['id']?>">
                </form></td>


        <?
      }
    } else {
      echo "0 results";
    }
?>
</table>
    

  




    </body>
    </html>
