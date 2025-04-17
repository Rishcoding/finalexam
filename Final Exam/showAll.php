<?php
include 'header.php';

$conn = new mysqli("localhost", "root", "", "final");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $string_id_to_delete = $_POST["string_id"];
    if (!empty($string_id_to_delete)) {
        $stmt = $conn->prepare("DELETE FROM string_info WHERE string_id = ?");
        $stmt->bind_param("i", $string_id_to_delete);
        $stmt->execute();
        $stmt->close();
        echo "<p style='color:green;'>Record with ID " . $string_id_to_delete . " has been deleted.</p>";
    } else {
        echo "<p style='color:red;'>Please enter a valid string_id to delete.</p>";
    }
}

$sql = "SELECT string_id, message FROM string_info";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>All Records:</h2>";
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["string_id"] . " - Message: " . $row["message"] . "<br>";
    }
} else {
    echo "<p>No records found.</p>";
}
?>

<h3>Delete Record</h3>
<form method="post" action="">
    <label for="string_id">Enter string_id to delete:</label>
    <input type="number" name="string_id" id="string_id" required>
    <input type="submit" name="delete" value="Delete">
</form>

<?php
$conn->close();

?>
