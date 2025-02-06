<?php
include('connect.php');

// Retrieve form data
$name = $_POST['name'];
$address = $_POST['address'];
$mobile = $_POST['mobile'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$image = $_FILES['photo']['name']; 
$tmp_name = $_FILES['photo']['tmp_name']; 
$role = $_POST['role'];

// Check if passwords match
if ($password == $cpassword) {
    // Define the upload directory and file path
    $upload_directory = "../uploads/";
    $target_file = $upload_directory . basename($image);

    // Move the uploaded file to the uploads directory
    if (move_uploaded_file($tmp_name, $target_file)) {
        // Use prepared statements to prevent SQL injection
        $stmt = $connect->prepare("INSERT INTO user (name, address, mobile, password, photo, role, status, voters) VALUES (?, ?, ?, ?, ?, ?, 0, 0)");
        $stmt->bind_param("ssssss", $name, $address, $mobile, $password, $image, $role);

        // Execute the query
        if ($stmt->execute()) {
            echo '
            <script>
                alert("Registration Successful");
                window.location = "../";
            </script>
            ';
        } else {
            echo '
            <script>
                alert("Database Error: ' . $stmt->error . '");
                window.location = "../routes/register.html";
            </script>
            ';
        }
    } else {
        echo '
        <script>
            alert("File Upload Error!");
            window.location = "../routes/register.html";
        </script>
        ';
    }
} else {
    echo '
    <script>
        alert("Password and Confirm password do not match!");
        window.location = "../routes/register.html";
    </script>
    ';
}
?>