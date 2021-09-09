<?php

include "database.php";

function getallcategory() {
    global $con;
    $getcategory = 'SELECT * FROM categories';
    $stmt = $con->prepare($getcategory);
    $stmt->execute();
    $categories = $stmt->fetchAll();
    return $categories;
}

function getcatpost($id) {
    global $con;
    $singlepost = "select * from posts where post_cat_id = :catid";
    $stmt = $con->prepare($singlepost);
    $stmt->execute(['catid' => $id]);
    $onepost = $stmt->fetchAll();
    return $onepost;
}

function getallpost() {
    global $con;
    $getpost = "select * from posts";
    $stmt = $con->prepare($getpost);
    $stmt->execute();
    $posts = $stmt->fetchAll();
    return $posts;
}

function getsinglepost($id) {
    global $con;
    $singlepost = "select * from posts where post_id = :postid";
    $stmt = $con->prepare($singlepost);
    $stmt->execute(['postid' => $id]);
    $onepost = $stmt->fetchAll();
    return $onepost;
}

function getsearch($tag){
    global $con;
    $content = "%$tag%"; 
    $searchtag = "select * from posts where post_tags like ?";
    $stmt = $con->prepare($searchtag);
    $stmt->execute([$content]);
    $tagpost = $stmt->fetchAll();
    return $tagpost;
}

function updatecategory(){
    global $con;
    if(isset($_POST['updatecat'])){
        if(!empty(trim($_POST['cat-title'])) and !empty(trim($_POST['catid']))){
            $title = htmlspecialchars(trim($_POST['cat-title']));
            $id = htmlspecialchars(trim($_POST['catid']));        
            $updatecat = "update categories set cat_name = :catname where cat_id = :id";
            $stmt = $con->prepare($updatecat);
            $result = $stmt->execute([':catname' => $title, ':id' => $id]);
            if($result){
                // echo "<script>alert('Category Added');</script>";
                header("Location:categories.php");
            }
        }
    }
}

function addcategory(){
    global $con;
    if(isset($_POST['addcat'])){
        if(!empty(trim($_POST['cat-title']))){
            $title = htmlspecialchars(trim($_POST['cat-title']));
            $addcat = "insert into categories (cat_name) values (:catname)";
            $stmt = $con->prepare($addcat);
            $result = $stmt->execute([':catname' => $title]);
            if($result){
                // echo "<script>alert('Category Added');</script>";
                header("Location:categories.php");
            }
        }
    }
}

function deletecategory(){
    global $con;
    if(isset($_REQUEST['delcat']) and !empty(htmlspecialchars(trim($_REQUEST['delcat'])))){
        $delcat = htmlspecialchars(trim($_REQUEST['delcat']));
        $catdelete = "delete from categories where cat_id = :id";
        $stmt = $con->prepare($catdelete);
        $result = $stmt->execute([':id' => $delcat]);
        if($result){
            // echo "<script>alert('Category Deleted');</script>";
            header("Location:categories.php");
        }
    }
}

?>