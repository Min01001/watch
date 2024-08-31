<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Custom CSS -->
    <style>

        .container-fluid{
            background-color: #333;
        }
        
        .container-login100 {
            width: 100%;
            max-width: 1200px;
            margin: auto;
            background-position: center;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            
        }
        .wrap-login100 {
            width: 100%;
            max-width: 450px;
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .login100-form-title {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
        .input100 {
            font-size: 16px;
            line-height: 1.5;
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 10px;
            width: 100%;
        }
        .login100-form-btn {
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            padding: 15px;
            width: 100%;
            cursor: pointer;
        }
        .login100-form-btn:hover {
            background-color: #0056b3;
        }
        .focus-input100 {
            position: absolute;
            top: 0;
            right: 15px;
            font-size: 18px;
            color: #999;
        }
        .wrap-input100 {
            position: relative;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<?php

include '../main/db_connect.php'; // Make sure this file contains the database connection code

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the username and password from POST request
    $username = $_POST['username'];
    $password = $_POST['pass'];

    // Prepare and execute the SQL query to check credentials
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verify the password (use password_verify() if you used password_hash())
        if ($password === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: new_product.php");
            exit();
        } else {
            echo "Invalid username or password.";
        }
    } else {
        echo "Invalid username or password.";
    }

    $stmt->close();
}

$conn->close();
?>


    <div class="container-fluid">
    <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
        <div class="wrap-login100 p-t-30 p-b-50">
            <div class="text-center">
            <h3 class="login100-form-title p-b-41">
                Account Login
            </h3>
            </div>
            <br>
            
            <form class="login100-form validate-form p-b-33 p-t-5" id="loginForm" method="POST" action="login.php">
                <div class="wrap-input100 validate-input" data-validate="Enter username">
                    <input class="input100" type="text" name="username" placeholder="Username" required>
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter password">
                    <input class="input100" type="password" name="pass" placeholder="Password" required>
                    <span class="focus-input100"></span>
                </div>

                <div class="container-login100-form-btn m-t-32">
                    <button class="login100-form-btn" type="submit">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Custom JS for Form Validation -->
    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            const username = this.username.value.trim();
            const password = this.pass.value.trim();

            if (!username || !password) {
                alert('Please fill in all fields.');
                event.preventDefault(); // Prevent form submission
            }
        });
    </script>

</body>
</html>
