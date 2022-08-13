<?php
include("./include/header.php");
include("./include/slider.php");

if (isset($_GET['category'])) {
    $category_id = $_GET['category'];
    $posts = $db->prepare("SELECT * FROM posts WHERE category_id=:id");
    $posts->execute(['id' => $category_id]); 
}else{
    $query_posts = "SELECT * FROM posts";
    $posts = $db->query($query_posts);
}

?>

<!-- Main -->
<!-- Posts -->
<section class="post my-3">
<div class="container-fluid">
<div class="row">
    <!-- Main Column -->
 
    <div class="col-lg-8 col-md-12 col-sm-12">
    <div class="row">
    <?php
    if ($posts->rowCount() > 0) {
        foreach ($posts as $post) {
            $category_id = $post['category_id'];
            $query_post_category = "SELECT * FROM categories WHERE id =$category_id";
            $post_category = $db->query($query_post_category)->fetch();
            ?>
              <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <img src="./img/<?php echo $post['image'] ?>" class="card-img-top" alt="">
            <div class="card-body">
                <div class="card-title d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><?php echo $post['title'] ?></h4>
                    <span class="badge badge-dark"><?php echo $post_category['title']?></span>
                </div>
                <p><?php echo substr($post['body'], 0, 200,). "..."; ?></p>
                <div class="d-flex justify-content-between align-items-center">
                    <a href="single.php?post=<?php echo $post['id']?>" class="btn btn-outline-primary">Read More</a>
                    <h6 class="mb-0">Author : <?php echo $post['author'] ?></h6>
                </div>

            </div>
        </div>
    </div>
    <?php
        }
       
    }else{
        ?>
        <div class="col">
        <div class="alert alert-danger">
            No Article!!!
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

<!-- Main End-->
<?php
include("./include/footer.php");

?>