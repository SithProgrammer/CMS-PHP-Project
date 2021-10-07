<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
 
<?php

if(isset($_POST['submit'])){
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if(!empty($username) && !empty($email) && !empty($password)){
        
    $username = mysqli_real_escape_string($connection, $username);
    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);
    
    $query = "SELECT randSalt FROM users";
    $select_randsalt_query = mysqli_query($connection, $query);
    
    if(!$select_randsalt_query){
        die("query failed". mysqli_error($connection));
    }
    
    $row = mysqli_fetch_array($select_randsalt_query);
    $salt = $row['randSalt'];
        
    $password = crypt($password, $salt);
    
    $query = "INSERT INTO users (username, user_email, user_password, user_role ) ";
    $query .= "VALUES ('{$username}', '{$email}', '{$password}', 'subscriber' )";
    $register_user_query = mysqli_query($connection, $query);
    if(!$register_user_query){
        die("query failed" . mysqli_error($connection) . ' ' . mysqli_errno($connection));
    } 
    echo "<script>alert('Account registration complete!');</script>";   
    }else{
        echo "<script>alert('Please fill out all fields before Registering!');</script>";
    }
}

?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap ">
                <h1 class="text-center">New Account Registration</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
