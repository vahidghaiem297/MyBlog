<?php
include("./include/header.php");
include("./include/sidebar.php");

$category_query = "SELECT * FROM categories";
$categories = $db->query($category_query);
if (isset($_GET['action']) && isset($_GET['id'])) {

    $action = $_GET['action'];
    $id = $_GET['id'];
    if ($action == "delete") {
        $query = $db->prepare("DELETE FROM categories WHERE id = :id");
        $query->execute(['id' => $id]);
        header("Location:category.php");
    }
}


?>


<main>
        <div class="container-fluid">
            <h2 class="py-3 d-flex align-items-center">Categories<a href="new_category.php" class="btn btn-success ml-5">Create Category</a></h2>
            <div class="table-responsive">
                <table class="table table-light table-sm table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Settings</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                      if ($categories->rowCount() > 0) {
                        foreach ($categories as $category) {

                         
                            ?>
                            <tr>
                                <td><?php echo $category['id']?></td>
                                <td><?php echo $category['title']?></td>
                            
                                <td> 
                                    <a href="edit_category.php?id=<?php echo $category['id']?>" class="btn btn-outline-info m-2">Edit</a>
                                    <a href="category.php?action=delete&id=<?php echo $category['id']?>" class="btn btn-outline-danger">Delete</a>
                                </td>
                            </tr>
                          
                            <?php
                        }
                      } else {
                        ?>
                        <div class="alert alert-info">
                            There is no post yet.
                        </div>                       
                       <?php
                      }
                     ?>

                      
                    </tbody>
                </table>
            </div>
                    </div>
                    </main>