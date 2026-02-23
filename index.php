<?php
// --- BACKEND (PHP & DATABASE) ---

// 1. Connect to XAMPP's default MySQL database
$host = "localhost";
$username = "root"; // Default XAMPP user
$password = "";     // Default XAMPP password (blank)
$database = "mini_confessions";

$conn = mysqli_connect($host, $username, $password, $database);

$notification = ""; // This will hold our success/error message

// 2. Listen for the user clicking the "Submit" button
if (isset($_POST['submit_btn'])) {
    
    // Grab the text they typed into the box
    $user_message = $_POST['confession_text'];
    
    // Safety check: Make sure they didn't submit an empty box
    if (!empty($user_message)) {
        
        // Sanitize the text (prevents quotes from breaking your SQL)
        $clean_message = mysqli_real_escape_string($conn, $user_message);
        
        // 3. Write the SQL command to INSERT the data
        $sql = "INSERT INTO posts (messages) VALUES ('$clean_message')";
        
        // Execute the command!
        // Execute the command!
        if (mysqli_query($conn, $sql)) {
          $notification = "🎉 Confession sent to the database successfully!";
      } else {
          // WE CHANGED THIS LINE TO PRINT THE EXACT MYSQL ERROR
          $notification = "❌ Database Error: " . mysqli_error($conn);
      }
    } else {
        $notification = "⚠️ Please write something first!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Confession Wall</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #1a1a2e;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .app-container {
            background-color: #16213e;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.5);
            text-align: center;
            width: 400px;
        }
        textarea {
            width: 90%;
            height: 100px;
            padding: 10px;
            border-radius: 5px;
            border: none;
            margin-bottom: 15px;
            resize: none;
        }
        button {
            background-color: #e94560;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover { background-color: #d1304b; }
        .alert { margin-top: 15px; color: #4cd137; font-weight: bold; }
    </style>
</head>
<body>

    <div class="app-container">
        <h2>🗣️ Mini Confession Wall</h2>
        
        <form action="index.php" method="POST">
            <textarea name="confession_text" placeholder="Type your anonymous confession here..."></textarea><br>
            <button type="submit" name="submit_btn">Send Confession</button>
        </form>

        <div class="alert">
            <?php echo $notification; ?>
        </div>
    </div>

</body>
</html>