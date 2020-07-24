<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta charset="UTF-8">
        <title>QuikNews - Login</title>
    </head>
    <body>
        <header class="jumbotron bg-primary p-4 mb-0" style="min-height : 10vh;">
            <h3 class="text-white text-monospace">QuikNews - Login</h3>
        </header>
        <div style="min-height : 78vh;">
            <div class="row p-5">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="card border-success">
                        <div class="jumbotron mb-0 p-4 h4 bg-dark text-warning text-center">Login</div>
                        <form action="login.php" method="post">
                            <div class="form-group pl-3 pr-3 mt-3">
                                <label>Username : </label>
                                <input type="email" name="email" class="form-control" placeholder="Enter Username" required autofocus>
                            </div>
                            <div class="form-group pl-3 pr-3 mt-3">
                                <label>Password : </label>
                                <input type="password" name="password" class="form-control" placeholder="Enter Your Password" required>
                            </div>
                            <div class="container mt- pl-3 p-2 pr-3 mb-3">
                                <button type="submit" class="form-control btn-success">Sign In</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
        <footer class="jumbotron p-4 mb-0 bg-info" style="min-height: 10vh;">
            <h5 class="text-right">&copy; Lampros Tech</h5>
        </footer>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>