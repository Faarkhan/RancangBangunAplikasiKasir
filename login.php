<?php
require 'function.php';

if (isset($_SESSION['login'])) {
    // Sudah login, redirect ke halaman index
    header('location:index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <style>
        body {
            background-color: #f7f9fc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            max-width: 1200px;
            margin: auto;
        }
        .login-image {
            flex: 1;
            display: none; /* Hide on small screens */
        }
        .login-image img {
            width: 100%;
            height: auto;
        }
        .login-form {
            flex: 1;
            max-width: 400px;
            background: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }
        .login-form h3 {
            text-align: left;
            margin-bottom: 10px;
            font-size: 24px;
        }
        .login-form p {
            text-align: left;
            margin-bottom: 20px;
            color: #6c757d;
        }
        .form-floating {
            position: relative;
        }
        .form-floating input {
            border-radius: 4px;
            border: 1px solid #ced4da;
            padding: 1rem;
            width: 100%;
            margin-bottom: 20px;
        }
        .form-floating label {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #6c757d;
            font-size: 16px;
            pointer-events: none;
            transition: all 0.2s;
        }
        .form-floating input:focus + label,
        .form-floating input:not(:placeholder-shown) + label {
            top: -10px;
            left: 10px;
            font-size: 12px;
            color: #495057;
        }
        .form-check {
            margin-bottom: 10px;
        }
        .btn-primary {
            background-color: #5867dd;
            border-color: #5867dd;
            padding: 10px;
            width: 100%;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #4857c8;
            border-color: #4857c8;
        }
        .social-login {
            text-align: center;
            margin-top: 20px;
        }
        .social-login a {
            margin: 0 10px;
            color: #6c757d;
            font-size: 18px;
        }
        .forgot-password {
            text-align: right;
            margin-top: 10px;
        }
        .forgot-password a {
            color: #5867dd;
            text-decoration: none;
        }
        .forgot-password a:hover {
            text-decoration: underline;
        }
        @media (min-width: 768px) {
            .login-image {
                display: block;
                max-width: 600px;
            }
            .login-image img {
                max-width: 100%; 
                height: auto; 
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-image">
            <img src="assets/tampilanlogin.png" alt="Login Image">
        </div>
        <div class="login-form">
            <h3>Login</h3>
            <p>Aplikasi Kasir</p>
            <form method="post">
                <div class="form-floating">
                    <input class="form-control" id="inputEmail" name="username" type="text" placeholder=" " required />
                    <label for="inputEmail">Username</label>
                </div>
                <div class="form-floating">
                    <input class="form-control" id="inputPassword" name="password" type="password" placeholder=" " required />
                    <label for="inputPassword">Password</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">
                        Remember me
                    </label>
                </div>
                <div class="forgot-password">
                    <a href="#"></a>
                </div>
                <button type="submit" name="login" class="btn btn-primary">Log In</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
