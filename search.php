<?php 
if(isset($_POST['search']) and !empty(trim($_POST['tag']))){
    $tag = htmlspecialchars(trim($_POST['tag']));
?>
<?php include("includes/header.php"); ?>

<body>

<?php include "navbar.php"; ?>    

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    All Post
                    <!-- <small>Secondary Text</small> -->
                </h1>

                <!-- First Blog Post -->
                <?php
                $tagpost = getsearch($tag);
                if(empty($tagpost)){
                    echo "<h2>No Post were found for your search result</h2>";
                }
                // $posts = getallpost();
                foreach($tagpost as $post){
                    $postid = $post->post_id;
                    $posttitle = $post->post_title;
                    $postcontent = $post->post_content;
                    $postcontent =substr($postcontent, 0, 250);
                    $postimage = $post->post_image;
                    $postdate = $post->post_date;
                    $postdate = date("d M Y",strtotime($postdate));
                    $postauthor = $post->post_author;
                ?>
                <h2>
                    <a href="post.php?tag=<?php echo $postid; ?>"><?php echo $posttitle; ?></a>
                </h2>
                <p class="lead">
                    by <?php echo $postauthor; ?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $postdate; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $postimage; ?>" alt="">
                <hr>
                <p><?php echo $postcontent; ?></p>
                <a class="btn btn-primary" href="post.php?tag=<?php echo $postid; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                <?php

                }
                ?>
                

                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

<?php include "sidebar.php"; ?>            

        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php"; ?> 
<?php
}
else{
    header("Location: index.php");
}
?>
       