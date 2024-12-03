<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
       body {
            font-family: Arial, sans-serif;
            background-color: #FFC0CB; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #9B59B6; 
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            color: #fff; 
        }

        .form-group {
            margin-bottom: 15px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }

        input[type="text"]:focus, input[type="password"]:focus {
            border-color: #FF69B4; 
            outline: none;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #FF69B4; 
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #FF1493; 
        }

        .error-message {
            color: red;
            font-size: 12px;
            text-align: center;
        }

        .success-message {
            color: green;
            font-size: 14px;
            text-align: center;
        }

        .back-link {
            text-align: center;
            margin-top: 15px;
        }

        .back-link a {
            text-decoration: none;
            color: #9B59B6; 
        }

        .back-link a:hover {
            color: #5A2D8C; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registration Form</h2>
        
        <span class="error-message">
            <?php
                if(isset($_GET['message'])) {
                    echo $_GET['message'];
                }
            ?>
        </span>
        
        <form action="register_account.php" method="post"> <!-- Updated form action -->
            <div class="form-group">
                <input type="text" name="firstname" placeholder="Enter Firstname" required>
            </div>
            
            <div class="form-group">
                <input type="text" name="lastname" placeholder="Enter Lastname" required>
            </div>

            <div class="form-group">
                <input type="text" name="phone_number" placeholder="Enter Phone Number" required>
            </div>
            <div class="form-group">
                <input type="text" name="email" placeholder="Enter Email" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Enter Password" required>
            </div>
            <input type="submit" value="register"> 
        </form>

        <div class="back-link">
            <a href="index.php">Back to Login</a>
        </div>
    </div>
</body>
</html>
