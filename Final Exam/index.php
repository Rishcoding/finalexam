<?php
include 'header.php';

$conn = new mysqli("localhost", "root", "", "final");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = trim($_POST["message"]);
    if (!empty($message)) {
        $stmt = $conn->prepare("INSERT INTO string_info (message) VALUES (?)");
        $stmt->bind_param("s", $message);
        $stmt->execute();
        $stmt->close();
        echo "<p style='color:green;'>Message saved successfully!</p>";
    } else {
        echo "<p style='color:red;'>Please enter a message.</p>";
    }
}
?>

<form method="post" action="">
    <label for="message">Enter a message:</label>
    <input type="text" name="message" id="message" maxlength="50" required>
    <input type="submit" name="submit" value="Submit">
</form>

<p><a href="showAll.php">Show All Records</a></p>
