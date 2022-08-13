<?php
include("./include/header.php");
include("./include/sidebar.php");

$post_query = "SELECT * FROM posts";
$posts = $db->query($post_query);
if (isset($_GET['action']) && isset($_GET['id'])) {

    $action = $_GET['action'];
    $id = $_GET['id'];
    if ($action == "delete") {
        $query = $db->prepare("DELETE FROM posts WHERE id = :id");
        $query->execute(['id' => $id]);
        header("Location:post.php");
    }
}


?>


<main>
        <div class="container-fluid">
            <h2 class="py-3 d-flex align-items-center">Posts <a href="new_post.php" class="btn btn-success ml-5">Create Post</a></h2>
            <div class="table-responsive">
                <table class="table table-light table-sm table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Settings</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                      if ($posts->rowCount() > 0) {
                        foreach ($posts as $post) {

                            $category_id = $post['category_id'];
                            $category_query = "SELECT * FROM categories WHERE id=$category_id";
                            $category = $db->query($category_query)->fetch();
                            ?>
                            <tr>
                                <td><?php echo $post['id']?></td>
                                <td><?php echo $post['title']?></td>
                                <td><?php echo $post['author']?></td>
                                <td><?php echo $category['title']?></td>
                                <td> 
                                    <a href="edit_post.php?id=<?php echo $post['id']?>" class="btn btn-outline-info m-2">Edit</a>
                                    <a href="post.php?action=delete&id=<?php echo $post['id']?>" class="btn btn-outline-danger">Delete</a>
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