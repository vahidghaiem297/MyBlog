
<?php

include("./include/header.php");
if (isset($_GET['post'])) {
    $post_id = $_GET['post'];

    $post = $db->prepare("SELECT * FROM posts WHERE id = :id");
    $post->execute(['id' => $post_id]);
    $post = $post->fetch();
}


if (isset($_POST['post_comment'])) {
    if (trim($_POST['name']) != "" || trim($_POST['comment']) != "") {
        $name = $_POST['name'];
        $comment = $_POST['comment'];
        $comment_insert = $db->prepare("INSERT INTO comments (name, comment, post_id) VALUES(:name, :comment, :post_id)");
        $comment_insert->execute(['name' => $name, 'comment' => $comment, 'post_id' =>$post_id]);
     header("Location:single.php?post=$post_id");
    
    } else {
        ?>
        <div class="row">

    <div class="alert alert-danger">
        name & comment are required.
    </div>

        </div>
        <?php
    }

} 
?>


<style>
    #sidebar{
        margin-top: 3rem;
    }
    .alert-danger{
        position: fixed;
        z-index:5;
        top:3rem;
        left:3rem;
    }
   
</style>
<!-- Posts -->
<section class="post my-3">
<div class="container-fluid">
<div class="row">
    <!-- Main Column -->
 
    <div class="col-lg-8 col-md-12 col-sm-12 mt-5">
    <div class="row">
    <?php
    if ($post) {
        $category_id = $post['category_id'];
        $query_post = "SELECT * FROM categories WHERE id=$category_id";
        $post_category = $db->query($query_post)->fetch();
        $post_id = $post['id'];
        $comments = $db->prepare("SELECT * FROM comments WHERE post_id=:id AND status='1' ");
        $comments->execute(['id'=> $post_id]);
   
    
    ?>
    
              <div class="col-lg-12 col-sm-12">
        <div class="card">
            <img src="./img/<?php echo $post['image'] ?>" class="card-img-top" alt="">
            <div class="card-body">
                <div class="card-title d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><?php echo $post['title'] ?></h4>
                    <span class="badge badge-dark"><?php echo $post_category['title'] ?></span>
                </div>
                <p><?php echo $post['body'] ?></p>
                <div>
                    <h6 class="mb-0">Author : <?php echo $post['author'] ?></h6>
                </div>

            </div>
        </div>
    </div>
    <?php
    
}else{
    ?>
        <div class="col mt-3">
            <div class="alert alert-danger">
                No Articles!!!
            </div>
        </div>


    <?php
}
?>

    </div>
   
    </div>
     <!-- Main Column End-->
  
   
<?php
include("./include/sidebar.php");

?>


</div>
</div>
</section>

<!-- Posts End-->
<hr>
   
    
    <section class="messages">
       
<form method="post" class="m-3" style="max-width:600px;">
    <div class="form-group">
        <label for="">Name</label>
        <input type="text" name="name" class="form-control" placeholder="Enter Your Name">
    </div>
    <div class="form-group">
        <label for="">Comment</label>
  <textarea name="comment" class="form-control" placeholder="Enter Your Message" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
       <button type="submit" class="btn btn-outline-primary" name="post_comment">Send</button>
    </div>
</form>
</section>
 
<hr>

<div class="row">
    <div class="col">
    <p class="pl-3">Comments : <?php echo $comments->rowCount()?></p>
        <div class="card m-3" style="width:500px;">
            <div class="card-body bg-light text-dark p-4">
           
                <?php
                if ($comments->rowCount() > 0) {
                    foreach ($comments as $comment) {
                        ?>
                    <div class="d-flex align-items-center">
                       <div><img src="./img/user.png" alt=""> </div>
                    <h4 class="pl-2"><?php echo $comment['name']?> </h4>

                  
                    </div>
                  <div class="card-text text-left p-2">  <p><?php echo $comment['comment']?></p></div>
                  <?php
                    }
                }else{
                    echo"<p class='text-danger'>No Comments For This Post.</p>";
                }
                ?>
             
            </div>
        </div>
    </div>
</div>

<!-- Main End-->
<?php
include("./include/footer.php");

?>
