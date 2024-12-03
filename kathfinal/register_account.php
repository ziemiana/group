<?php
// Include the connection file
include('db/connection.php');

// Check if form is submitted
//if(isset($_POST[''])) CHECK YOUR ISSET IF CORRECT
 {
    // Sanitize user input
    echo "hello";
    $firstname = $conn->real_escape_string($_POST['firstname']);
    $lastname = $conn->real_escape_string($_POST['lastname']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone_number = $conn->real_escape_string($_POST['phone_number']);
    $role = "client";  // Default role for new users
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);  // Encrypt password

    // Check if the email already exists in the database
    $check_sql = "SELECT email FROM users WHERE email='$email'";
    $result = $conn->query($check_sql);
    
    if($result->num_rows > 0) {
        // If email exists, redirect with an error message
        header("Location: register.php?message=" . urlencode("Email is already taken!"));
        exit();
    } else {
        // Insert the new user data into the database
        $addusersql = "INSERT INTO users (firstname, lastname, phone_number, email, password, role) 
                       VALUES ('$firstname', '$lastname', '$phone_number', '$email', '$password', '$role')";

        if($conn->query($addusersql) === TRUE) {
            // Registration successful, redirect to login page with success message
            header("Location: index.php?message_success=" . urlencode("Registration successful!"));
            exit();
        } else {
            // Error during insertion
            echo "Error: " . $addusersql . "<br>" . $conn->error;
            exit();
        }
    }
}
?>
