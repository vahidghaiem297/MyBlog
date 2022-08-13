<?php
include("./include/header.php");
include("./include/sidebar.php");

$comment_query = "SELECT * FROM comments";
$comments = $db->query($comment_query);
if (isset($_GET['action']) && isset($_GET['id'])) {

    $action = $_GET['action'];
    $id = $_GET['id'];
    if ($action == "delete") {
        $query = $db->prepare("DELETE FROM comments WHERE id=:id ");
        $query->execute(['id' => $id]);
        header("Location:comment.php");
    }else{
        $query = $db->prepare("UPDATE comments SET status='1' WHERE id = :id ");
        $query->execute(['id' => $id]);
        header("Location:comment.php");
    }
}


?>


<main>
        <div class="container-fluid">
            <h2 class="py-3">Comments</h2>
            <div class="table-responsive">
                <table class="table table-light table-sm table-striped table-hover">
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
                            
                                <td class="d-flex align-items-center"> 
                                    <?php
                                    if ($comment['status']) {
                                        ?>
                                        <p class="text-success mb-0 ml-3 order-2">Accepted</p>
                                        
                                        <?php
                                    } else {
                                        ?>
                                         <a href="comment.php?action=approve&id=<?php echo $comment['id']?>" class="btn btn-outline-info m-2">Awaiting...</a>
                                         <?php
                                    }
                                    ?>
                                   
                                    <a href="comment.php?action=delete&id=<?php echo $comment['id']?>" class="btn btn-outline-danger">Delete</a>
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