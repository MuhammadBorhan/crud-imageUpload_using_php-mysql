<?php include "header.php"; ?>

  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>SL No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>

        <?php 
            include "config.php";

            $serial=1;

            $query = "SELECT * FROM user ORDER BY user_id";
            $result = mysqli_query($connection,$query) or die("Failed");
            $count = mysqli_num_rows($result);

            if($count > 0){ // if condition first backet
                while($row = mysqli_fetch_assoc($result)){ // while loop firts backet
        
        ?>
              <tr>
                  <td class='id'><?php echo $serial++; ?></td>
                  <td><?php echo $row['first_name']." ".$row['last_name'] ?></td>
                  <td><?php echo $row['username'] ?></td>
                  <td><?php 
                  
                    if($row['role'] == 1){
                        echo "Admin";
                    }else{
                        echo "Moderator";
                    }
                    
                    ?></td>
                  <td class='edit'><a href='update-user.php?id=<?php echo $row['user_id'] ?>'>Edit</a></td>
                  <td class='delete'>
                    <a onclick="return confirm('Are You Sure?')" href='delete-user.php?id=<?php echo $row['user_id'] ?>'>Delete</a>
                  </td>
              </tr>

        <!-- while loop last backet -->
        <?php } ?>

                    </tbody>
        <!-- if condition last backet -->
        <?php } ?>
        
                </table>
              </div>
          </div>
      </div>
  </div>

<?php include "footer.php"; ?>
