<?php
// include_once 'mysql.php';
// var_dump(mysqli_fetch_assoc(pull()));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css' />
    <link rel='stylesheet' href='style.css' />
    <script src="script.js"></script>

</head>

<body>
    <div class="login">
        <div id="login">
            <a><h1>Sign In:</h1></a>
            <div class="form-group">
                <label for="username-login">Username</label>
                <input type="text" class="form-control" id="username-login" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <label for="password-login">Password</label>
                <input type="password" class="form-control" id="password-login" placeholder="Enter Password">
            </div>
            <div class="d-flex">
                <button type="submit" id="sign-in" class="m-1 btn btn-light">Sign in</button>
                <button type="submit" id="sign-up" class="m-1 btn btn-light d-none">Sign up</button>
            </div>
        </div>
    </div>
</body>

</html>
<?php
// closeConnection();
?>