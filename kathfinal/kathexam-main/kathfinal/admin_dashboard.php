<?php
// Start Session
session_start();

if(!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit();
}

// Include connection string
include('db/connection.php');

// Create Variable that will store search value
$search_query = '';

// Check if a search query is submitted
if(isset($_GET['search'])){
    $search_query = $conn->real_escape_string($_GET['search']);
}

// Check for a deletion success message
$delete_success = isset($_GET['deleted']) ? $_GET['deleted'] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f2f5;
        }
        .container {
            width: 90%;
            max-width: 900px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        h1 {
            color: #333;
            font-size: 24px;
        }
        .logout {
            text-decoration: none;
            color: #e63946;
            font-weight: bold;
            transition: color 0.3s;
        }
        .logout:hover {
            color: #d32f2f;
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
        .search-bar {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 20px;
        }
        .search-bar input[type="text"],
        .search-bar select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .search-bar input[type="submit"] {
            padding: 8px 12px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .search-bar input[type="submit"]:hover {
            background-color: #388e3c;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        td a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            transition: color 0.3s;
        }
        td a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Client Dashboard</h1>
            <a href="logout.php" class="logout">Logout</a>
        </div>
        
        <?php if ($delete_success): ?>
            <div class="success-message">Account successfully deleted!</div>
        <?php endif; ?>

        <p>Welcome, Admin, <?php echo $_SESSION['username']; ?></p>

        <!-- Search Form -->
        <form action="" method="get" class="search-bar">
            <input type="text" name="search" placeholder="Search by username" value="<?php echo htmlspecialchars($search_query); ?>">
            <select name="search_field">
                <option value="username">Username</option>
                <option value="firstname">Firstname</option>
                <option value="lastname">Lastname</option>
            </select>
            <input type="submit" value="Search">
        </form>

        <!-- Client Table -->
        <table>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            <?php
                // Modify SQL query based on the search input
                if(!empty($search_query)){
                    $search_field = $conn->real_escape_string($_GET['search_field']);
                    $sql = "SELECT * FROM users WHERE role='client' AND $search_field LIKE '%$search_query%'";
                } else {
                    $sql = "SELECT * FROM users WHERE role='client'";
                }

                $result = $conn->query($sql);

                // Check if any clients exist
                if($result->num_rows > 0){
                    $count = 1;
                    while($row = $result->fetch_assoc()){
                        echo "<tr>";
                        echo "<td>$count</td>";
                        echo "<td>".$row['username']."</td>";
                        echo "<td>".$row['firstname']."</td>";
                        echo "<td>".$row['lastname']."</td>";
                        echo "<td>".$row['role']."</td>";
                        echo "<td>";
                        echo "<a href='edit_client.php?ID=".$row['ID']."'>Edit</a> | ";
                        echo "<a href='delete_client.php?ID=".$row['ID']."' onclick='return confirmDelete()'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                        $count++;
                    }
                } else {
                    echo "<tr><td colspan='6'>No clients found!</td></tr>";
                }
            ?>
        </table>
    </div>

    <script>
        // Confirm delete function
        function confirmDelete() {
            return confirm('Are you sure you want to delete this account?');
        }
    </script>
</body>
</html>
