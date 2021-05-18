<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href="bootstrap.min.css" />
    <link rel='stylesheet' href='style.css' />
    <script src="script.js"></script>

</head>

<body>
    <div class="login">
        <div id="login">
            <div class="d-flex">
                <h4 class="choice current">Sign In</h4>
                <h4 class="choice">Sign Up</h4>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Enter Password">
            </div>
            <div class="d-flex">
                <button type="submit" id="sign-in" class="m-1 btn btn-light">Sign in</button>
                <button type="submit" id="sign-up" class="m-1 btn btn-light d-none">Sign up</button>
            </div>
            <p id="error" class="text-center text-danger"></p>
        </div>
    </div>
    <div id="content">

    </div>
</body>

</html>