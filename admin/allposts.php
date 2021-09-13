<?php include "includes/header.php"; ?>
<?php include "includes/database.php"; ?>
<?php include "includes/functions.php"; ?>
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
                <a class="navbar-brand" href="dashboard.php">CMS Admin</a>
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
                            All Posts
                            <!-- <small>Subheading</small> -->
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> All Posts
                            </li>
                            <a href="posts.php?addpost=yes" class="btn btn-primary btn-sm pull-right">+ Post</a>
                        </ol>
                    </div>
                    <div class="col-lg-12">
                        <table class="table table-responsive table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Title</th>
                                    <!-- <th>Content</th> -->
                                    <th>Image</th>
                                    <th>Author</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>View / Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $posts = getallpost();
                            foreach($posts as $post){
                                $postid = $post->post_id;
                                $posttitle = $post->post_title;
                                $postcontent = $post->post_content;
                                $postcontent =substr($postcontent, 0, 100);
                                $postimage = $post->post_image; 
                                $postdate = $post->post_date;
                                $postdate = date("d M Y",strtotime($postdate));
                                $postauthor = $post->post_author;
                                $poststatus = $post->post_status;
                            ?>
                                <tr>
                                    <td><?php echo $postid; ?></td>
                                    <td><?php echo $posttitle; ?></td>
                                    <td><img width="120px;" src="../images/<?php echo $postimage ?>"></td>
                                    <td><?php echo $postauthor; ?></td>
                                    <td><?php echo $poststatus; ?></td>
                                    <td><?php echo $postdate ?></td>
                                    <td><a href="posts.php?editpost=<?php echo $postid; ?>" class="btn btn-sm btn-info"><i class="fa fa-fw fa-edit"></i></a></td>
                                    <td><a href="posts.php?delpost=<?php echo $postid; ?>" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-trash"></i></a></td>
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
