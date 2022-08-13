<?php
include("./include/header.php");
include("./include/sidebar.php");

if (isset($_GET['id'])) {
    $category_id = $_GET['id'];
    $edit_category = $db->prepare("SELECT * FROM categories WHERE id = :id");
    $edit_category->execute(['id' => $category_id]);
    $edit_category = $edit_category->fetch(); 
}
if (isset($_POST['edit_category'])) {
    if (trim($_POST['title'])) {
        $title = $_POST['title'];
        $update_query = $db->prepare("UPDATE categories SET title = :title WHERE id = :id");
        $update_query->execute(['title' => $title, 'id' => $category_id]);
        header("Location:category.php");
    } else{
        
  
        header("Location:edit_category.php?err_msg=Category Name Is Required.");
    }

}


?>
<style>
    input::placeholder{
   
    font-size:.8rem;
}
</style>
<main>
        <div class="container-fluid">
            <h2 class="py-3 d-flex align-items-center">Edit Category</h2>
        
            <?php
                  if (isset($_GET['err_msg'])) {
                    error_reporting(E_ERROR | E_PARSE);
                    ?>
  
                    <div class="alert alert-danger">
                   <?php echo $_GET['err_msg'] ?>   
                </div>

                    <?php
                  }
                    ?> 
            <form method="post" style="max-width:400px;">
                <div class="form-group">
                    <label for="title">Name</label>
                    <input type="text" name="title" id="title" placeholder="Enter New Category Name" class="form-control">
                   <small class="text-dark">Old Category Name : <?php echo $edit_category['title']?></small><br>
                    <button type="submit" name="edit_category" class="btn btn-outline-info mt-3">Edit</button>
                </div>
            </form>

</div>
</main>