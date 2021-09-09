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

?>