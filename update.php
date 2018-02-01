<?php require_once('db.php');
$db =  new Database(); ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>PHP OOP CRUD</title>
  </head>
  <body>    
    <div class="container"> 
     <div class="jumbotron"><h1 class="text-center">User Information</h1> </div>    
      <div class="row">
        <div class="col-md-6">
            <?php 
            if (isset($_GET['id'])) {
               $id=$_GET['id']??'';           
            
            $sql="SELECT * FROM users WHERE id='$id'"; 
            $result=$db->select_record($sql);
            if ($result->num_rows > 0) {
                    // output data of each row
                    $row = $result->fetch_assoc();
                } else {
                    echo "0 results";
                } 

                   
            
            //Update Query                 

            ?>
          <form action="update.php" method="POST">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                <label for="exampleInputname">First Name</label>
                <input type="firstname" value="<?php echo $row['firstname'];?>" class="form-control" name="firstname"  placeholder="First Name">                
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                <label for="exampleInputEmail1">Last Name</label>
                <input type="lastname" value="<?php echo $row['lastname'];?>" class="form-control" name="lastname" aria-describedby="emailHelp" placeholder="Last Name">              
              </div>
              </div>
            </div>            
              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" value="<?php echo $row['email'];?>" name="email"  placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" value="<?php echo $row['password'];?>" class="form-control" name="password" placeholder="Password">
              </div>              
              <input type="submit" class="btn btn-primary dblock" name="submit" value="Submit" />
            </form>
            <?php }?>
        </div>
        <div class="col-md-6">
            <a href="index.php">Go to Home Page</a>
            <?php   $db =  new Database();

                    if (isset($_POST['submit'])) {
                      $firstname=$_POST['firstname'];
                      $lastname=$_POST['lastname'];
                      $email=$_POST['email'];
                      $password=$_POST['password'];
                      $query="INSERT INTO users (firstname, lastname,email,password) 
                      VALUES('$firstname','$lastname','$email','$password')";
                      $data=$db->insert_record($query);               
                        echo "<span class='alert-success'>Record Inserted Successfully</span>";
                        
                    }
                    ?>
                    <?php
                    if (isset($_POST['submit'])) {
                      $firstname=$_POST['firstname'];
                      $lastname=$_POST['lastname'];
                      $email=$_POST['email'];
                      $password=$_POST['password'];
                      $query="UPDATE users SET firstname='$firstname', lastname='$firstname',email='$email',password='$password' WHERE id='$id'";
                      $data=$db->update_record($query);               
                        echo "<span class='alert-success'>Record Inserted Successfully</span>";
                        
                    }
                    ?>

          <div class="table-responsive">          
  <table class="table table-bordered">
    <thead>
      <tr>       
        <th>Serial</th>
        <th>Name</th>
        <th>Email</th>
        <th>Update</th>
        <th>Delete</th>
      </tr>
    </thead>
    <?php 
    
    //Select query
    $sql="SELECT * FROM users";
    $result=$db->select_record($sql);
    $i=0;
    while($row=$result->fetch_assoc()){
        $i++;
    ?>
    <tbody>
      <tr>        
        <td><?php echo $i;?></td>
        <td><?php echo $row['firstname']." ".$row['lastname'];?></td>
        <td><?php echo $row['email']; ?></td>
        <td></td>
        <td></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery.min.js" ></script>    
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
