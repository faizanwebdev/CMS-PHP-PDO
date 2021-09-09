<?php include "includes/header.php"; ?>
<?php include "includes/database.php"; ?>
<?php include "includes/functions.php"; ?>
<?php
updatecategory();
addcategory();
deletecategory();
?>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">CMS Admin</a>
            </div>
            <!-- Top Menu Items -->
<?php include "includes/topnav.php"; ?>            
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<?php include "includes/sidebar.php"; ?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Categories
                            <!-- <small>Subheading</small> -->
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Categories
                            </li>
                            <a href="categories.php" class="btn btn-primary btn-sm pull-right">+ Category</a>
                        </ol>
                    </div>
                    <div class="col-lg-6">
                        <?php
                        if(isset($_REQUEST['editcat']) and !empty(htmlspecialchars(trim($_REQUEST['editcat'])))){
                            $id = htmlspecialchars(trim($_REQUEST['editcat']));
                            $singlcat = "select * from categories where cat_id = :id";
                            $stmt = $con->prepare($singlcat);
                            $stmt->execute(['id' => $id]);
                            $category = $stmt->fetchAll();
                            foreach($category as $cat){
                                $catid = $cat->cat_id;
                                $catname = $cat->cat_name;
                            }
                        ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat-title">Update Category</label>
                                <input type="text" class="form-control" value="<?php echo $catname; ?>" name="cat-title" required>
                                <input type="hidden" name="catid" value="<?php echo $catid; ?>">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success" name="updatecat" value="Update">
                            </div>

                        </form>
                        <?php    
                        }
                        else{
                        ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat-title">Add Category</label>
                                <input type="text" class="form-control" placeholder="Please Enter Category Name" name="cat-title" required>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success" name="addcat" value="Add">
                            </div>

                        </form><br><br>
                        <?php    
                        }
                        ?>
                    </div>
                    <div class="col-lg-6">
                        <table class="table table-responsive table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category name</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $allcategories = getallcategory();
                                foreach($allcategories as $cat){
                                    $catname = $cat->cat_name;
                                    $catid = $cat->cat_id;
                                ?>
                                <tr>
                                    <td><?php echo $catid; ?></td>
                                    <td><?php echo $catname; ?></td>
                                    <td><a href="categories.php?editcat=<?php echo $catid; ?>" class="btn btn-sm btn-info"><i class="fa fa-fw fa-edit"></i></a></td>
                                    <td><a href="categories.php?delcat=<?php echo $catid; ?>" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-trash"></i></a></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/footer.php"; ?>    
