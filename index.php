<?php
//Database connection initialize

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "oopcrud");

Class Database{
  public $host   = DB_HOST;
  public $user   = DB_USER;
  public $pass   = DB_PASS;
  public $dbname = DB_NAME;
  
  
  public $link;
  public $error;
  
  public function __construct(){
    $this->connectDB();
  }
  
  private function connectDB(){
  $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
  if(!$this->link){
    $this->error ="Connection fail".$this->link->connect_error;
    return false;
  }
 }
 //insert data
  public function insert_record($query){
    $result = $this->link->query($query) or die($this->link->error.__LINE__);
    if (!$result) {
      die($this->link->error);
    }
  }
  //Select data
  public function select_record($query){
    $result = $this->link->query($query) or die($this->link->error.__LINE__);
    if ($result->num_rows>0) {
      return $result;
    }else{
    return false;
    }
  }
  //Update data
  public function update_record($query){
    $result = $this->link->query($query) or die($this->link->error.__LINE__);
    if (!$result) {
      die($this->link->error);
    }
  }
  public function delete_record($query){
    $result = $this->link->query($query) or die($this->link->error.__LINE__);
    if (!$result) {
      die($this->link->error);
    }
  }
}
//data fron Index file
?>

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
        <?php	$db =  new Database();

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
          <form action="index.php" method="POST">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                <label for="exampleInputEmail1">First Name</label>
                <input type="firstname" class="form-control" name="firstname"  placeholder="First Name">                
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                <label for="exampleInputEmail1">Last Name</label>
                <input type="lastname" class="form-control" name="lastname" aria-describedby="emailHelp" placeholder="Last Name">              
              </div>
              </div>
            </div>
            
              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" name="email"  placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password">
              </div>              
              <input type="submit" class="btn btn-primary dblock" name="submit" value="Submit" />
            </form>
        </div>
        <div class="col-md-6">

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
        <td><a href="index.php?id=<?php echo $row['id'];?>">Update </a></td>
        <td><a href="index.php?id=<?php echo $row['id'];?>" onClick='return confirm("Are you sure you want to delete?");'>Delete </a></td>
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