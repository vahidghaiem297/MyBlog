<?php
include("./include/header.php");
include("./include/sidebar.php");

if (isset($_GET['entity']) && isset($_GET['action']) && isset($_GET['id'])) {
    $entity = $_GET['entity'];
    $action = $_GET['action'];
    $id = $_GET['id'];
if ($action == "delete") {
    if ($entity == "post") {
        $query = $db->prepare("DELETE FROM posts WHERE id =:id");
        header("Location:index.php");
    }elseif ($entity == "comment") {
        $query = $db->prepare("DELETE FROM comments WHERE id =:id");
        header("Location:index.php");
    }else {
        $query = $db->prepare("DELETE FROM categories WHERE id = :id");
        header("Location:index.php");
    }
    $query->execute(['id' => $id]);
}else{
    $query = $db->prepare("UPDATE comments SET status='1' WHERE id = :id");
    $query->execute(['id' => $id]);
    header("Location:index.php");
}

 

   
}

$query_posts = "SELECT * FROM posts ORDER BY id DESC LIMIT 5";
$posts = $db->query($query_posts);

$query_comments = "SELECT * FROM comments WHERE status='0' ORDER BY id DESC LIMIT 5";
$comments = $db->query($query_comments);

$query_categories = "SELECT * FROM categories ORDER BY id DESC LIMIT 5 ";
$categories = $db->query($query_categories);

?>

<main>
        <div class="container-fluid">
            <h2 class="py-3">Dashboard</h2>
            <h5 class="py-4">Recent Posts</h5>
            <div class="table-responsive">
                <table class="table table-light table-sm table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Settings</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                      if ($posts->rowCount() > 0) {
                        foreach ($posts as $post) {
                            ?>
                            <tr>
                                <td><?php echo $post['id']?></td>
                                <td><?php echo $post['title']?></td>
                                <td><?php echo $post['author']?></td>
                                <td> 
                                    <a href="edit_post.php?id=<?php echo $post['id']?>" class="btn btn-outline-info m-2">Edit</a>
                                    <a href="index.php?entity=post&action=delete&id=<?php echo $post['id']?>" class="btn btn-outline-danger">Delete</a>
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
            <div class="table-responsive">
            <h5 class="py-4">Recent Comments</h5>
                <table class="table table-sm table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Comment</th>
                            <th>Settings</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                      if ($comments->rowCount() > 0) {
                        foreach ($comments as $comment) {
                            ?>
                            <tr>
                                <td><?php echo $comment['id']?></td>
                                <td><?php echo $comment['name']?></td>
                                <td><?php echo $comment['comment']?></td>
                                
                                <td> 
                                    <a href="index.php?entity=comment&action=approve&id=<?php echo $comment['id'] ?>" class="btn btn-outline-success m-2">Accept</a>
                                    <a href="index.php?entity=comment&action=delete&id=<?php echo $comment['id']?>" class="btn btn-outline-danger">Delete</a>
                                </td>
                            </tr>
                          
                            <?php
                        }
                      } else {
                        ?>
                        <div class="alert alert-info">
                            There is no Comment On Posts yet.
                        </div>                       
                       <?php
                      }
                     ?>

                      
                    </tbody>
                </table>
            </div>
            <div class="table-responsive">
            <h5 class="py-4">Categories</h5>
                <table class="table table-sm table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
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
                                    <a href="index.php?entity=category&action=delete&id=<?php echo $category['id']?>" class="btn btn-outline-danger">Delete</a>
                                </td>
                            </tr>
                          
                            <?php
                        }
                      } else {
                        ?>
                        <div class="alert alert-info">
                            There is no Categories yet.
                        </div>                       
                       <?php
                      }
                     ?>

                      
                    </tbody>
                </table>
            </div>
      



        </div>
    </main>