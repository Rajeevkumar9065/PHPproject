<div class="container">
   <div class="row">
      <div class="col-8">
         <h1 class="heading text-center">Questions</h1>
         <?php
         // Include database connection
         include('./common/db.php');

         // Initialize query variable
         $query = "";

         // Check for filters in the URL
         if (isset($_GET["c-id"])) {
             $categoryId = intval($_GET["c-id"]); // Sanitize input
             $query = "SELECT * FROM `questions` WHERE category_id=$categoryId";
         } elseif (isset($_GET["u-id"])) {
             $userId = intval($_GET["u-id"]); // Sanitize input
             $query = "SELECT * FROM `questions` WHERE user_id=$userId";
         } elseif (isset($_GET["latest"])) {
             $query = "SELECT * FROM `questions` ORDER BY id DESC";
         } elseif (isset($_GET["search"])) {
             $search = htmlspecialchars($_GET["search"], ENT_QUOTES, 'UTF-8'); // Sanitize input
             $query = "SELECT * FROM `questions` WHERE `title` LIKE '%$search%'";
         } else {
             $query = "SELECT * FROM `questions`";
         }

         // Execute the query
         $result = $conn->query($query);

         // Check if the query execution was successful
         if ($result && $result->num_rows > 0) {
             // Loop through each question and display
             foreach ($result as $row) {
                 $title = htmlspecialchars($row['title']); // Safely escape the title
                 $id = $row['id']; // Question ID

                 echo "<div class='row question-list'>
                          <h4 class='my-question'>
                              <a href='?q-id=$id'>$title</a>";

                 // Add "Delete" link for user-specific questions
                 if (isset($_GET['u-id'])) {
                     echo " <a href='./server/requests.php?delete=$id' style='color: red;'>Delete</a>";
                 }

                 echo " </h4>
                       </div>";
             }
         } else {
             echo "<p>No questions available.</p>";
         }

         // Close the database connection
         $conn->close();
         ?>
      </div>
      <div class="col-4">
         <?php
         // Include the category list component
         include('categorylist.php');
         ?>
      </div>
   </div>
</div>

<style>
.question-list {
    border: 1px solid #ddd;
    padding: 15px;
    margin: 10px;
}
.question-list h4 {
    margin: 0;
    padding: 0;
}
.question-list a {
    font-size: 18px;
    text-decoration: none;
    color: #1c7194 !important;
}
.my-question {
    display: flex;
    justify-content: space-between;
}
</style>
