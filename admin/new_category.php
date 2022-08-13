<?php
include("./include/header.php");
include("./include/sidebar.php");

if (isset($_POST['add_category'])) {
    if (trim($_POST['title'])) {
        $category_name = $_POST['title']; 
        $insert_query = $db->prepare("INSERT INTO categories(title) VALUES (:title)");
        $insert_query->execute(['title' => $category_name]);
        header("Location:category.php");
    
    }else{
        header("Location:new_category.php?err_msg=Category Name Is Required.");
      }
    }
   



?>
<main>
        <div class="container-fluid">
            <h2 class="py-3 d-flex align-items-center">Edit Category</h2>
       
                    <?php
                  if (isset($_GET['err_msg'])) {
                    ?>

                    <div class="alert alert-danger">
                   <?php echo $_GET['err_msg'] ?>   
                </div>

                    <?php
                  }
                    ?> 
                

            <form method="post">
                <div class="form-group">
                    <label for="title">Name</label>
                    <input type="text" name="title" id="title" placeholder="Enter Category Name" class="form-control" style="max-width:400px;">
                    <button type="submit" name="add_category" class="btn btn-outline-info mt-3">Create</button>
                </div>
            </form>

</div>
</main>