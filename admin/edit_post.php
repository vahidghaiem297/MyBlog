<?php
include("./include/header.php");
include("./include/sidebar.php");

if (isset($_GET['id'])) {
    $post_id = $_GET['id'];

    $post = $db->prepare("SELECT * FROM posts WHERE id=:id");
    $post->execute(['id' => $post_id]);
    $post = $post->fetch();


    $category_query = "SELECT * FROM categories";
    $categories = $db->query($category_query);

}
if (isset($_POST['edit_post'])) {
    if (trim($_POST['title']) != "" && trim($_POST['author']) != "" && trim($_POST['category_id']) != "" && trim($_POST['body']) != "") {


        $title = $_POST['title'];
        $author = $_POST['author'];
        $category_id = $_POST['category_id'];
        $body= $_POST['body'];


        if (trim($_FILES['image']['name']) != "" ) {
            $image_name = $_FILES['image']['name'];
            $tmpName = $_FILES['image']['tmp_name'];
            if (move_uploaded_file($tmpName, "../upload/$image_name")) {
                echo "Image Uploaded Successfully.";
            }else {
                echo "Upload Failed.";
            }
            
        $update_post = $db->prepare("UPDATE posts SET title=:title, author=:author,category_id=:category_id,body=:body, image = :imageName WHERE id = :id");
        $update_post->execute(['title' => $title,'author' => $author,'category_id' => $category_id, 'body' => $body, 'imageName' => $image_name, 'id' => $post_id]);

         
        }else{
            
        $update_post = $db->prepare("UPDATE posts SET title=:title, author=:author,category_id = :category_id , body = :body WHERE id = :id ");
        $update_post->execute(['title' => $title,'author' => $author,'category_id' => $category_id, 'body' => $body ,'id' => $post_id]);

        }
      
 
        header("Location:post.php");
        exit();
      
    } else {
        header("Location:edit_post.php?id=$post_id&err_msg=Please Fill All Required Fields");
        exit();
    }
    
}

?>



<main>
        <div class="container-fluid">
            <h1>Edit Post</h1>
        <?php
        if (isset($_GET['err_msg'])) {
            ?>
            <div class="alert alert-danger">
                <?php echo $_GET['err_msg'] ?>
                
            </div>
            <?php
        }
?>    
       

           <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Enter Post Title</label>
                <input type="text" name="title" id="title" value="<?php echo $post['title'] ?>" class="form-control">
             
            </div>
            <div class="form-group">
                <label for="author">Enter Post Author Name</label>
                <input type="text" name="author" value="<?php echo $post['author'] ?>" id="author" class="form-control">
            </div>
            <div class="form-group">

                <label for="category_id">Choose Post Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    <?php
                    if ($categories->rowCount() > 0) {
                        foreach ($categories as $category) {
                            ?>
                            <option value="<?php echo $category['id']?>"  <?php echo($category['id'] == $post['category_id']) ? "selected" : "" ?>><?php echo $category['title'] ?></option>
                            <?php
                        }
                    }
                    ?>
                    
                   
                </select>
            </div>
            <div class="form-group">
                <label for="body">Post Content</label>
                <textarea name="body" id="body" class="form-control form-control-lg" cols="30" rows="3">
                    <?php echo $post['body'] ?>
                </textarea>
                <small class="text-muted">Enter Post Content</small>
            </div>
            <img src="../img/<?php echo $post['image']?>" width="300" class="img-fluid" alt="">
            <div class="form-group">
                <label for="image"></label>
                <input type="file" class="form-control" name="image" id="image">
                <small class="text-muted">Select Post Image</small>
            </div>
            <button type="submit" name="edit_post" class="btn btn-outline-info">Edit</button>
           </form>


    </main>

</body>
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace('body');
</script>

</html>
