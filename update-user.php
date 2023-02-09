<?php include "header.php"; 

if(isset($_POST['submit'])){

    include 'config.php';

    $user_id = mysqli_real_escape_string($connection,$_POST['user_id']);
    $fname = mysqli_real_escape_string($connection,$_POST['f_name']);
    $lname = mysqli_real_escape_string($connection,$_POST['l_name']);
    $user = mysqli_real_escape_string($connection,$_POST['username']);
    $role = mysqli_real_escape_string($connection,$_POST['role']);

    move_uploaded_file($_FILES["image"]["tmp_name"],"upload/".$_FILES["image"]["name"]);
    $updateImg=$_FILES["image"]["name"];

    $updateUser = "UPDATE user SET 
    profile='$updateImg',
    first_name = '$fname', 
    last_name = '$lname',
    username = '$user',
    role = '$role' WHERE user_id = '$user_id'";

    $update = mysqli_query($connection,$updateUser) or die("Query faild.");
    if($update){
      header("location: users.php");
    }
}

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">

            <?php 
                $user_id = $_GET['id'];

                include "config.php";
                $findUser = "SELECT * FROM user WHERE user_id = {$user_id}";
                $result = mysqli_query($connection,$findUser) or die("Failed");
                $count = mysqli_num_rows($result);

                if($count > 0){ // if start backet
                while($row = mysqli_fetch_assoc($result)){ // while start backet

            ?>
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF'] ?>" method ="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?php echo $row['user_id'] ?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $row['username'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Image URL</label>
                          <input type="file" name="image" class="form-control" >
                      </div>
                      
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?php echo $row['role']; ?>">
                            <?php 
                                  if($row['role'] == 1){
                                  
                                echo  "<option value='0'>Moderator</option>";
                                echo  "<option value='1' selected >Admin</option>";

                                  }else{
                                 
                                 echo  "<option value='0' selected >Moderator</option>";
                                 echo  "<option value='1'>Admin</option>";

                                  }
                            ?>

                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  <!-- /Form -->

                    <?php 
                          } // while end backet

                    } // if end backet

                    ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
