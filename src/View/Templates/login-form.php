<html>

    <head>
        <title>Login</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <link type="text/css" rel="stylesheet" href="assets/style.css">
    </head>

    <body>

    <div class="container">

        <h1 class="jumbotron">Login form</h1>

        <form action="/loginPost" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <label for="email" class="well well-sm">Username</label>
                <input type="text" name="email" id="email" class="form-control">
            </div>

            <div class="form-group">
                <label for="password" class="well well-sm">Password</label>
                <input type="password" name="password" id="password" rows="3" cols="20" class="form-control">
            </div>

            <input type="submit" name="login" value="Login" class="btn btn-default">
            <input type="reset" value="Reset" class="btn btn-default">

        </form>

    </div></br>

    </body>

</html>