<?php

function escape($string){
    global $connection;
    mysqli_real_escape_string($connection, trim($string));
}


function confirmQuery($query_result){
        global $connection;
           if(!$query_result){
           die("QUERY FAILED" . mysqli_error($connection));
       }

}



function insert_categories(){
        global $connection;
        //if statement to execute an action if the submit button is pressed
       if(isset($_POST['submit'])){
           //variable set to catch the information entered in the input tag 
           //with the name="cat_title" attribute
           $cat_title = $_POST['cat_title'];
        //if text input area is empty a validation is performed
        //and no query is ran
        if($cat_title == "" || empty($cat_title)){
            echo "This field should not be empty";

        }else{
            //SQL query to add a new cat_title row based off the
            // input entered in the Add Category input text tag
            $query = "INSERT INTO categories(cat_title) ";
            $query .= "VALUE('{$cat_title}')";
            //mysqli_query function needs 2 parameters, 
            //1st: database connection 2nd: query
            $create_category_query = mysqli_query($connection, $query);
            //if there are any syntax errors this if statement within
            //the else statement will use the die function to stop the 
            //program and print an error for debugging
            if(!$create_category_query){
                die('QUERY FAILED' . mysqli_error($connection));
            }                             
        }                                              
       }  
}

function findAllCategories(){
    global $connection;
    
                //Find all categories query
            $query = 'SELECT * FROM categories ';
            $select_catagories = mysqli_query($connection, $query );



            while($row = mysqli_fetch_assoc($select_catagories)){
            $cat_title = $row['cat_title']; 
            $cat_id = $row['cat_id']; 
            echo"<tr>";
            echo "<td>{$cat_id}</td>";
            echo "<td>{$cat_title}</td>"; 
            //This line creates a reference tag for the $_GET super global to work with
            //{cat_id} is the column in database 
            echo "<td><a href='categories.php?goDelete={$cat_id}'>Delete</a></td>";
            echo "<td><a href='categories.php?goEdit={$cat_id}'>Edit</a></td>";
            echo "</tr>";
            }
    
}

function deleteCategory(){
    global $connection;
    
            //calling the $_GET super global
            if(isset($_GET['goDelete'])){
            //creating a variable to work with to make coding easier
            $cat_id_to_delete = $_GET['goDelete'];
            //sql query to delete row from database
            $query = "DELETE FROM categories WHERE cat_id = {$cat_id_to_delete} ";
            $delete_query = mysqli_query($connection, $query);
            //this header function is to cause the page to refesh or redirect back
            //to the page after the query is sent
            header("Location: categories.php");
            }

    
}

function usersOnline(){
    
    
    if(isset($_GET['onlineusers'])){
        
     global $connection;
    if(!$connection){
        session_start();
        include("../includes/db.php"); 
        
        
        $session = session_id();
        $time = time();
        $time_out_in_seconds = 30;
        $time_out = $time - $time_out_in_seconds;

        $query = "SELECT * FROM users_online WHERE session = '$session' ";
        $send_query = mysqli_query($connection, $query);
        $count = mysqli_num_rows($send_query);

            if($count == NULL){
            mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', '$time')");
            }else{
            mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session' ");
            }

        $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time < '$time_out' ");
        echo $count_user = mysqli_num_rows($users_online_query);
        
        
    }
   



    }
}

usersOnline();

?>