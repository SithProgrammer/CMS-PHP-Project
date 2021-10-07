<?php include "includes/admin_header.php" ?>


    <div id="wrapper">

       
       <?php include "includes/admin_navigation.php" ?> 
       
        <!-- Navigation -->
 
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Author</small>
                        </h1>
                       <div class="col-xs-6">
                       
                       <?php insert_categories(); ?>
                       
<!--                        The form tag needs the method equaling post to create the post super global-->
                        <form action="" method="post">
                          <label for="cat-title">Add Category</label>
                           <div class="form-group">
<!--                              In this input tag the name attribute of name="cat_title" is what the POST super global uses-->
                               <input type="text" class="form-control" name="cat_title">
                           </div>
                             <div class="form-group">
<!--                              adding an input tag with the type="submit" attribute is needed for the POST super global-->
                               <input class="btn btn-primary" type="submit" name="submit" value= "Add Category">
                           </div>
                            
                        </form>
                        
                        
                        
                        <?php //Update catagory
                        if(isset($_GET['goEdit'])){
                            $cat_id = $_GET['goEdit'];
                            include "includes/update_categories.php";                      
                        }
                         
                        ?>
                        
                        
                        </div>
                        
                        
                        <div class="col-xs-6">                        
                        
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
     
                                </tr>                         
                            <?php findAllCategories(); ?>
                            
                            <?php deleteCategory(); ?>
                            
                            </tbody>
                        </table>                           
                        </div>                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


<?php include "includes/admin_footer.php" ?>