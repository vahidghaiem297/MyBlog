 <?php
 $query_category = "SELECT * FROM categories";
 $categories = $db->query($query_category);

 ?>
 <!-- Sidebar -->
   
  <div id="sidebar" class="col-lg-4 col-md-12 col-sm-12">
        <!-- Search -->
        <form action="search.php" class="my-3 bg-light p-4">
            <h4>Search In Our Blog</h4>
            <div class="btn-group d-flex">
                <input type="text" class="form-control" name="search" placeholder="Search...">
                <div class="btn-append">
                    <button type="submit" class="btn btn-outline-primary"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>

        <!-- Search End-->
        <!-- Lists -->
        <div class="list-group">
            <div class="list-group-item list-group-item-action bg-primary text-white">categories</div>
            <?php
            if ($categories->rowCount() > 0) {
                foreach ($categories as $category) {
                    ?>
                    <a href="index.php?category=<?php echo $category['id'] ?>" class="list-group-item list-group-item-action"><?php echo $category['title']?></a>
                    <?php
                }
            }
            ?>
           
       
        </div>
        <!-- Lists End-->
      
        <!-- Newsletter -->
        <form method="post" class="my-4 bg-dark p-5">
        <?php

if (isset($_POST['subscribe'])) {
    if (trim($_POST['name']) != "" || trim($_POST['email']) != "") {
        
$name = $_POST['name'];
$email = $_POST['email'];

        $newsletter_query_insert = $db->prepare("INSERT INTO subscribers(name , email) VALUES(:name, :email)");
        $newsletter_query_insert->execute(['name' => $name, 'email' => $email]);
    }
    else{
       echo "<a href='#' class='alert alert-danger d-block'>Name and Email Are Required</a>";
    }
}


        ?>
            <label for="" class="text-white">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter Your Name">
            <label for="" class="mt-2 text-white">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter Your Email">
            <button type="submit" class="btn btn-block btn-primary my-3" name="subscribe"><i class="fas fa-bell"></i> Subscribe</button>
        </form>

        <!-- Newsletter End-->
        <!-- About Us -->
        <div class="about my-4 p-4 bg-secondary">
            <h4 class="text-white">About Us</h4>
            <p class="text-white text-left">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Est velit egestas dui id ornare arcu odio.</p>
        </div>
        <!-- About Us End-->
    </div>
     <!-- Sidebar End-->