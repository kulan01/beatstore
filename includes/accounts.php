
<!--This is the accounts section in the admin page-->

<?php 

//ob_start(); 
?>

<?php 

if (isset($_GET['admin'])){
  $id= $_GET['admin'];
  $query = "UPDATE users SET isAdmin = 1 WHERE id={$id}";
  $result  = mysqli_query($connection, $query);
  if(!$result){
    die(mysqli_error($connection));
  }
  header("Location: cms.php?source=accounts");
}

if (isset($_GET['user'])){
  $id= $_GET['user'];
  $query = "UPDATE users SET isAdmin = 0 WHERE id={$id}";
  $result  = mysqli_query($connection, $query);
  if(!$result){
    die(mysqli_error($connection));
  }
  header("Location: cms.php?source=accounts");
}

if (isset($_GET['delete'])){
  $id= $_GET['delete'];
  $query = "DELETE FROM users WHERE id={$id}";
  $result  = mysqli_query($connection, $query);
  if(!$result){
    die(mysqli_error($connection));
  }
  header("Location: cms.php?source=accounts");
}

?>

<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Username</th>
      <th>Email</th>
      <th>IsAdmin</th>
      <th>Make Admin</th>
      <th>Make Reg</th>
      <th>Delete User</th>
    </tr>
  </thead>
  <tbody>
   <?php 
    $query = 'SELECT * FROM users';
    $result = mysqli_query($connection,$query);
    if(!$result){
      die(mysqli_error($connection));
    }
    
    while($row = mysqli_fetch_assoc($result)){
      
     $id = $row['id'];
     $username = $row['username'];
     $password = $row['password'];
     $email = $row['email'];
     $isAdmin = $row['isAdmin'];
      
      echo "<tr>";
      
      echo "<td>$id</td>";
      echo "<td>$username</td>";
  
      echo "<td>$email</td>";
      echo "<td>$isAdmin</td>";
      echo "<td><a href='cms.php?source=accounts&admin=$id' >Make Admin</a></td>";
      echo "<td><a href='cms.php?source=accounts&user=$id' >Make Reg</a></td>";
      echo "<td><a href='cms.php?source=accounts&delete=$id' >Delete</a></td>";
      echo "</tr>";
    }

    ?>
  </tbody>
</table>



