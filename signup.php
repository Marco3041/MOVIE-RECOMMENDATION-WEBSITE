<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") { 
        $server = "localhost";
        $username = "root";
        $password = "";
        $database = "msd";

        $conn = mysqli_connect($server, $username, $password, $database);
        if(!$conn){
            die("connection to this database is failed due to ".mysqli_connect_error());
        }
        //echo "connect to db";
        $username = $_POST['uname'];
        $password = $_POST['psw'];
        $sql= "INSERT INTO MSD.signup (`uname`, `psw`, `date`) VALUES ('$username', '$password', current_timestamp())";
        //echo $sql;
        if($conn->query($sql) == true){
            header("location: login.php");
        }
        else{
            echo "Error : $sql <br> $conn->error";
        }
        $conn->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
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

        /* Submit button */
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

        /* Add some spacing */
        .container {
            padding: 16px;
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
    <div class="imgcontainer">
        <img src="icon-for-movie-recommendation-app-137281771.png" alt="Avatar" class="avatar" height="150px" width="100px">
    </div>
    <form id="signupForm" action="signup.php" method="post">
        <div class="container">
            <label for="uname"><b>Enter Your Username</b></label>
            <input type="text" id="uname" name="uname" placeholder="Enter Username" required>
            <label for="psw"><b>Enter Your Password</b></label>
            <input type="password" id="psw" name="psw" placeholder="Enter Password" required>
            <label for="confirmPsw"><b>Confirm Your Password</b></label>
            <input type="password" id="confirmPsw" name="confirmPsw" placeholder="Confirm Password" required>

            <!-- Sign up button -->
            <button type="button" id="signupButton" onclick="validateAndSubmit()">Sign Up</button>
            <p id="error" style="color: red; display: none;">Password should contain only letters.</p>
            <p id="matchError" style="color: red; display: none;">Passwords do not match.</p>
        </div>
    </form>

    <script>
        // Get form and input elements
        const form = document.getElementById('signupForm');
        const usernameInput = document.getElementById('uname');
        const passwordInput = document.getElementById('psw');
        const confirmPasswordInput = document.getElementById('confirmPsw');
        const signupButton = document.getElementById('signupButton');
        const errorParagraph = document.getElementById('error');
        const matchErrorParagraph = document.getElementById('matchError');

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
            // Check if username, password, and confirm password are not empty
            if (usernameInput.value.trim() === '' || passwordInput.value.trim() === '' || confirmPasswordInput.value.trim() === '') {
                return false;
            }

            // Check if password contains only letters
            if (!/^[a-zA-Z]+$/.test(passwordInput.value.trim())) {
                return false;
            }

            // Check if password and confirm password match
            if (passwordInput.value.trim() !== confirmPasswordInput.value.trim()) {
                matchErrorParagraph.style.display = 'block';
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
