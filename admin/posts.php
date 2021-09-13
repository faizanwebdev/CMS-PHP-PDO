<?php include "includes/header.php"; ?>
<?php include "includes/database.php"; ?>
<?php include "includes/functions.php"; ?>
<?php 
if(isset($_REQUEST['delpost']) && !empty(trim($_REQUEST['delpost']))){
    $delid = htmlspecialchars(trim($_REQUEST['delpost']));
    $deletepost = "delete from posts where post_id = :id";
    $stmt = $con->prepare($deletepost);
    $result = $stmt->execute(['id'=> $delid]);
    // $postdel = deletepost($delid);
    if($result){
        echo "<script>alert('Post Deleted Successfully');</script>";
        echo "<script>window.location.href='allposts.php';</script>";
    }
    else{
        echo "<script>alert('Something went wrong, please try again');</script>";
        echo "<script>window.location.href='allposts.php';</script>";
    }
}
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
                    <?php 
                    if(isset($_REQUEST['editpost']) && !empty(trim($_REQUEST['editpost']))){
                        $editid = htmlspecialchars(trim($_REQUEST['editpost']));
                        $posts = getsinglepost($editid);
                        foreach($posts as $post){
                            $postid = $post->post_id;
                            $postcatid = $post->post_cat_id;
                            $title = $post->post_title;
                            $content = $post->post_content;
                            $author = $post->post_author;
                            $tags = $post->post_tags;
                            $image = $post->post_image;
                            $status = $post->post_status;
                        }
                    ?>
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                View / Edit Post
                                <!-- <small>Subheading</small> -->
                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-dashboard"></i>  <a href="dashboard.php">Dashboard</a>
                                </li>
                                <li class="active">
                                    <i class="fa fa-file"></i> View/Edit Posts
                                </li>
                                <a href="posts.php?addpost=yes" class="btn btn-primary btn-sm pull-right">+ Post</a>
                            </ol>
                        </div>
                        <div class="col-lg-12">
                        
                            <div class="form-group">
                              <label for="">Title</label>
                              <input type="hidden" name="postid" value="<?php echo $postid; ?>">
                              <input type="text" name="title" id="title" class="form-control" placeholder="Post Title" value="<?php echo $title; ?>">
                            </div>
                            <div class="form-group">
                            <label for="">Category</label>
                              <select name="category" id="category" class="form-control">
                                  <option value="">Select Category</option>
                                  <?php 
                                  $categories = getallcategory();
                                  foreach($categories as $category){
                                      $catid = $category->cat_id;
                                      $catname = $category->cat_name;
                                  ?>
                                  <option value="<?php echo $catid ?>" <?php if($catid == $postcatid) echo "selected" ?>><?php echo $catname;?></option>
                                  <?php
                                  }  
                                  ?>
                              </select>
                              
                            </div>
                            <div class="form-group">
                              <label for="">Content</label>
                              <textarea name="content" class="form-control" id="content" cols="30" rows="5" placeholder="Post Conent"><?php echo $content; ?></textarea>
                            </div>
                            <div class="form-group">
                              <label for="">Image</label>
                              <div>
                                  <img src="../images/<?php echo $image; ?>" class="img-responsive" width="100px">
                              </div>
                              <input type="file" name="image" id="postimage" class="form-control" accept="image/*">
                            </div>
                            <div class="form-group">
                              <label for="">Author</label>
                              <input type="text" name="author" id="author" class="form-control" placeholder="Post Author" value="<?php echo $author; ?>" readonly>
                            </div>
                            <div class="form-group">
                              <label for="">Tags</label>
                              <input type="text" name="tags" id="tags" class="form-control" placeholder="Post Tags" value="<?php echo $tags; ?>">
                            </div>
                            <div class="form-group">
                            <label for="">Status</label>
                              <select name="status" id="status" class="form-control">
                                  <option value="">Select Status</option>
                                  <option value="draft" <?php if($status == "draft") echo "selected" ?>>Draft</option>
                                  <option value="published" <?php if($status == "published") echo "selected" ?> >Published</option>
                              </select>
                              
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success" name="updatepost" id="updatepost" value="Update">
                            </div>
                            <br><br><br>
                        </div> 
                    <?php 
                    }
                    
                    if(isset($_REQUEST['addpost']) && !empty(trim($_REQUEST['addpost']))){
                    ?>
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Add Post
                                <!-- <small>Subheading</small> -->
                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-dashboard"></i>  <a href="dashboard.php">Dashboard</a>
                                </li>
                                <li class="active">
                                    <i class="fa fa-file"></i> Add Post
                                </li>
                                <!-- <a href="posts.php?add=yes" class="btn btn-primary btn-sm pull-right">+ Post</a> -->
                            </ol>
                        </div>
                        <div class="col-lg-12">
                        
                            <div class="form-group">
                              <label for="">Title</label>
                              <input type="text" name="posttitle" id="posttitle" class="form-control" placeholder="Post Title" required>
                            </div>
                            <div class="form-group">
                            <label for="">Category</label>
                              <select name="postcategory" id="postcategory" class="form-control" required="required">
                                  <option value="">Select Category</option>
                                  <?php 
                                  $cat = getallcategory();
                                  foreach($cat as $category){
                                      $catid = $category->cat_id;
                                      $catname = $category->cat_name;
                                  ?>
                                  <option value="<?php echo $catid ?>"><?php echo $catname;?></option>
                                  <?php
                                  }  
                                  ?>
                              </select>
                              
                            </div>
                            <div class="form-group">
                              <label for="">Content</label>
                              <textarea name="postcontent" class="form-control" id="postcontent" cols="30" rows="5" placeholder="Post Conent" required></textarea>
                            </div>
                            <div class="form-group">
                              <label for="">Image</label>
                              <input type="file" name="postimage" id="postimage" class="form-control" accept="image/*" required>
                            </div>
                            <div class="form-group">
                              <label for="">Author</label>
                              <input type="text" name="postauthor" id="author" class="form-control" placeholder="Post Author" required>
                            </div>
                            <div class="form-group">
                              <label for="">Tags</label>
                              <input type="text" name="posttags" id="posttags" class="form-control" placeholder="Post Tags" required>
                            </div>
                            <div class="form-group">
                            <label for="">Status</label>
                              <select name="poststatus" id="poststatus" class="form-control" required="required">
                                  <option value="">Select Status</option>
                                  <option value="draft">Draft</option>
                                  <option value="published">Published</option>
                              </select>
                              
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success" name="insertpost" id="addpost" value="Add">
                            </div>
                            <br><br><br>
                        </div> 
                    <?php
                    }
                    ?>                    
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/footer.php"; ?>    
