
<?php

$query_slider = "SELECT * FROM posts_slider";
$posts_slider = $db->query($query_slider); 


?>
<!-- Slider -->
<div id="demo" class="carousel slide" data-ride="carousel">
<ul class="carousel-indicators">
<li data-target="#demo" data-slide-to="0" class="active"></li>
<li data-target="#demo" data-slide-to="1"></li>
<li data-target="#demo" data-slide-to="2"></li>
<li data-target="#demo" data-slide-to="3"></li>
<li data-target="#demo" data-slide-to="4"></li>
<li data-target="#demo" data-slide-to="5"></li>
</ul>
<div class="carousel-inner">
    <?php
    if ($posts_slider->rowCount() > 0) {
        foreach ($posts_slider as $post_slider) {
            $id_post = $post_slider['post_id'];
            $query_posts = "SELECT * FROM posts WHERE id=$id_post";
            $post = $db->query($query_posts)->fetch();
            ?>
            <div class="carousel-item <?php echo ( $post_slider['active'] ) ? "active" : "" ?>">
    <img src="./img/<?php echo $post['image'] ?>" alt="">
    <div class="carousel-caption">
        <h4><?php echo $post['title']?></h4>
        <p><?php echo substr($post['body'], 0, 200). "..."; ?></p>
        <a href="single.php?post=<?php echo $post['id']?>" class="carousel-btn">Read More</a>
    </div>
</div>
        <?php
        }
    }

?>
</div>
</div>

<!-- Slider End-->
