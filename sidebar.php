<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">

<!-- Blog Search Well -->
<div class="well">
    <h4>Blog Search</h4>
    <form action="search.php" method="POST">
    <div class="input-group">
        <input type="text" class="form-control" name="tag">
        <span class="input-group-btn">
            <button class="btn btn-default" name="search" type="submit">
                <span class="glyphicon glyphicon-search"></span>
        </button>
        </span>
    </div>
    </form>
    <!-- /.input-group -->
</div>

<!-- Blog Categories Well -->
<div class="well">
    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-6">
            <ul class="list-unstyled">
               <?php
               $sidecat = getallcategory(); 
               foreach($sidecat as $cat){
                   $ctid = $cat->cat_id;
                   $ctname = $cat->cat_name;
                ?>
               <li><a href="category.php?cat=<?php echo $ctid; ?>"><?php echo $ctname; ?></a></li> 
               <?php 
               }
               ?>
            </ul>
        </div>
       
    </div>
    <!-- /.row -->
</div>

<!-- Side Widget Well -->
<div class="well">
    <h4>Side Widget Well</h4>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
</div>

</div>