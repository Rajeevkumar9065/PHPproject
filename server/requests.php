<?php

session_start();  // Start session at the beginning

include("../common/db.php");

if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];

    // Hash the password before storing it
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL query for user registration
    $user = $conn->prepare("INSERT INTO `users` (`username`, `email`, `password`, `address`) VALUES (?, ?, ?, ?)");
    $user->bind_param("ssss", $username, $email, $hashedPassword, $address);

    $result = $user->execute();
    if ($result) {
        // Store user session data
        $_SESSION["user"] = ["username" => $username, "email" => $email, "user_id" => $user->insert_id];
        header("Location: /discuss");  // Redirect to another page
        exit;
    } else {
        echo "New user not registered";
    }
} elseif (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepared statement to prevent SQL injection
    $query = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows == 1) {
        // Fetch user data
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password is correct, store user data in session
            $_SESSION["user"] = ["username" => $row['username'], "email" => $email, "user_id" => $row['id']];
            header("Location: /discuss");   // Redirect to another page
            exit;
        } else {
            echo "Invalid login credentials";
        }
    } else {
        echo "Invalid login credentials";
    }
} elseif (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: /discuss");
    exit;
} elseif (isset($_POST["ask"])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category_id = $_POST['category'];
    $user_id = $_SESSION['user']['user_id'];

    // Prepare the SQL query for adding a question
    $question = $conn->prepare("INSERT INTO `questions` (`title`, `description`, `category_id`, `user_id`) VALUES (?, ?, ?, ?)");
    $question->bind_param("ssii", $title, $description, $category_id, $user_id);

    $result = $question->execute();
    if ($result) {
        header("Location: /discuss");  // Redirect to another page
        exit;
    } else {
        echo "Question is not added to the website";
    }
} elseif (isset($_POST["answer"])) {
    $answer = $_POST['answer'];  // Correctly fetch the answer
    $question_id = $_POST['question_id'];  // Correctly fetch the question_id
    $user_id = $_SESSION['user']['user_id'];

    // Prepare the SQL query for adding an answer
    $query = $conn->prepare("INSERT INTO `answers` (`answer`, `question_id`, `user_id`) VALUES (?, ?, ?)");
    $query->bind_param("sii", $answer, $question_id, $user_id);  // Bind the correct values

    $result = $query->execute();

    if ($result) {
        header("Location: /discuss?q-id=$question_id");  // Redirect to another page
        exit;
    } else {
        echo "Answer is not submitted";
    }
} elseif (isset($_GET["delete"])) {
    $qid = intval($_GET["delete"]);  // Sanitize input
    $query = $conn->prepare("DELETE FROM questions WHERE id = ?");
    $query->bind_param("i", $qid);

    $result = $query->execute();

    if ($result) {
        header("Location: /discuss");  // Redirect to questions page
        exit;
    } else {
        echo "Question not deleted";
    }
}
?>
