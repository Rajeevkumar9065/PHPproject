<div class="container">
    <h1 class="heading text-center">Question</h1>
    <div class="row">
        <div class="col-8">
            <?php
            include("./common/db.php");
            $query = "SELECT * FROM questions WHERE id=$qid";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $cid = $row['category_id'];
            echo "<h4 class='margin-bottom-15 question-title'> Question: " . $row['title'] . " </h4> 
            <p>" . $row['description'] . "</p>";

            include("answers.php");
            ?>
            <form action="./server/requests.php" method="post">
                <input type="hidden" name="question_id" value="<?php echo $qid ?>">
                <textarea name="answer" class="form-control margin-bottom-15" placeholder="Your answer..."></textarea>
                <button class="btn btn-primary">Write Your answer</button>
            </form>
        </div>
        <div class="col-4">
            <?php
            $categoryQuery = "SELECT name FROM category WHERE id = $cid";
            $categoryResult = $conn->query($categoryQuery);
            $categoryRow = $categoryResult->fetch_assoc();
            echo "<h1>" . ucfirst($categoryRow['name']) . "</h1>";

            $query = "SELECT * FROM questions WHERE category_id = $cid AND id != $qid";
            $result = $conn->query($query);

            if ($result && $result->num_rows > 0) {
                foreach ($result as $row) {
                    $id = $row['id'];
                    $title = $row['title'];
                    echo "<div class='question-list'>
                            <h4><a href='?q-id=$id'>$title</a></h4>
                          </div>";
                }
            } else {
                echo "<p>No related questions found.</p>";
            }
            ?>
        </div>
    </div>
</div>

<style>
    /* Styling for the question list container */
    .question-list {
        border: 1px solid #ddd;
        padding: 15px;
        margin: 10px;
    }

    /* Styling for the question title inside the list */
    .question-list h4 {
        margin: 0;  /* Remove extra margins */
        padding: 0; /* Remove extra padding */
    }

    /* Styling for the links inside question list */
    .question-list a {
        font-size: 18px;  /* Set the font size for the links */
        text-decoration: none;  /* Remove underline from links */
        color: #1c7194 !important;  /* Set the link color */
    }
</style>
