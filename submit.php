<?php
// 1. Connect to the database
$host = "localhost";
$username = "root"; 
$password = "";     
$database = "mini_confessions";

$conn = mysqli_connect($host, $username, $password, $database);

// 2. Check if data was sent
if (isset($_POST['submit_btn'])) {
    
    $user_message = $_POST['confession_text'];
    
    if (!empty($user_message)) {
        
        $clean_message = mysqli_real_escape_string($conn, $user_message);
        
        // Notice I used 'messages' (plural) to match your database!
        $sql = "INSERT INTO posts (messages) VALUES ('$clean_message')";
        
        if (mysqli_query($conn, $sql)) {
            echo "<h2>🎉 Confession saved to database successfully!</h2>";
        } else {
            echo "<h2>❌ Database Error: " . mysqli_error($conn) . "</h2>";
        }
    } else {
        echo "<h2>⚠️ You cannot submit an empty confession!</h2>";
    }
    
    // Provide a link to go back to the form
    echo '<br><a href="index.html">⬅️ Go back to the wall</a>';
}
?>