<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">PHP-CMS-PDO</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php
                    $allcat = getallcategory();
                    foreach($allcat as $category){
                        $catid = $category->cat_id;
                        $catname = $category->cat_name;
                    ?>
                     <li>
                        <a href="category.php?cat=<?php echo $catid; ?>"><?php echo $catname; ?></a>
                    </li>
                    <?php
                    }
                    ?>
                    <li>
                        <a href="admin/dashboard.php">Admin</a>
                    </li>                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>