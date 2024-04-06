<?php
    $login = false;
    $showError = false;
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $server = "localhost";
        $username = "root";
        $password = "";
        $database = "msd";

        $conn = mysqli_connect($server, $username, $password, $database);
        if(!$conn){
            die("connection to this database is failed due to ".mysqli_connect_error());
        }
        //echo "connect to db";
        $username = $_POST["uname"];
        $password = $_POST["psw"];

        $sql = "Select * from signup where uname='$username' AND psw='$password'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);

        if ($num == 1){
          $login = true;
          session_start();
          $_SESSION['loggesin'] = true;
          $_SESSION['uname'] = $username;
          header("location: index.html");
          //echo "success!";
        }
        else{
          $showError = "Invalid Credentials";
        }
        $conn->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        /* Basic form styling */
        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
        }

        /* Input fields */
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            transition: border-color 0.3s; /* Add transition effect */
        }

        /* Highlight input fields on focus */
        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #04AA6D;
        }

        /* Login button */
        button {
            background-color: #04AA6D;
            color: white;
            padding: 10px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s; /* Add transition effect */
        }

        /* Change button color on hover */
        button:hover {
            background-color: #21825c;
        }

        /* Cancel button */
        .cancelbtn {
            background-color: #aaa;
        }

        /* Add some spacing */
        .container {
            padding: 16px;
        }

        /* Align the "Forgot password" text */
        span.psw {
            float: right;
            padding-top: 16px;
        }

        /* Center the avatar image */
        .imgcontainer {
            text-align: center;
            margin-bottom: 20px;
        }

        /* Avatar image */
        img.avatar {
            width: 20%;
            border-radius: 30%;
        }

        /* Media queries for responsiveness */
        @media screen and (max-width: 600px) {
            /* Adjust the form width for smaller screens */
            form {
                max-width: 300px;
            }
        }

        @media screen and (max-width: 400px) {
            /* Adjust the avatar image size for even smaller screens */
            img.avatar {
                width: 40%;
            }
        }
    </style>
</head>
<body bgcolor="maroon">
<?php
  if($login){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> You are logged in successfully
    </div>';
  }
  if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong>'. $showError.'
    <button type="button" class="close" data-dismiss="alert" aria-label="close">
    </div>';
}
?>
    <div class="imgcontainer">
        <img src="icon-for-movie-recommendation-app-137281771.png" alt="Avatar" class="avatar" height="150px" width="100px">
    </div>
    <form id="loginForm" action="login.php" method="post">
        <div class="container">
            <label for="uname"><b>Username</b></label>
            <input type="text" id="uname" name="uname" placeholder="Enter Username" required>
            <label for="psw"><b>Password</b></label>
            <input type="password" id="psw" name="psw" placeholder="Enter Password" required>
            <!-- Login button -->
            <button type="button" id="loginButton" onclick="validateAndSubmit()">Login</button>
            <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
            <p id="error" style="color: red; display: none;">Password should contain only letters.</p>
        </div>
    </form>

    <script>
        // Get form and input elements
        const form = document.getElementById('loginForm');
        const usernameInput = document.getElementById('uname');
        const passwordInput = document.getElementById('psw');
        const loginButton = document.getElementById('loginButton');
        const errorParagraph = document.getElementById('error');

        // Function to validate and submit the form
        function validateAndSubmit() {
            // Validate form inputs
            if (validateForm()) {
                // Submit form
                form.submit();
            } else {
                // Display error message or handle invalid inputs
                errorParagraph.style.display = 'block';
            }
        }

        // Function to validate form inputs
        function validateForm() {
            // Check if username and password are not empty
            if (usernameInput.value.trim() === '' || passwordInput.value.trim() === '') {
                return false;
            }

            // Check if password contains only letters
            if (!/^[a-zA-Z]+$/.test(passwordInput.value.trim())) {
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
