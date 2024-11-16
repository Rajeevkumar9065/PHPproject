<div>
    <h1 class="heading text-center" >Categories</h1>
    <?php
    include('./common/db.php');
    $query = "SELECT * FROM `category`";
    $result = $conn->query($query);

    // Loop through the questions and create links for each
    foreach ($result as $row) {
        $name = ucfirst($row['name']);  // Safely output the title
        $id = $row['id'];   
         echo "<div class='row question-list'>
                <h4><a href='?c-id=$id'>$name</a></h4>  <!-- This is the link with the question ID -->
              </div>";
    }
    ?>
</div>