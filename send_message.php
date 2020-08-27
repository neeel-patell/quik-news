<?php
    session_start();
    $msg = "";
    if(!isset($_SESSION['logged_in'])){
        header('location: index.php');
    }
    else{
        if($_SESSION['logged_in'] == 0){
            header('location: index.php');
        }
    }
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta charset="UTF-8">
        <title>QuikNews - Send Message</title>
    </head>
    <body>
        <header class="jumbotron bg-primary p-4 mb-0" style="min-height : 10vh;">
            <h3 class="text-white text-monospace">QuikNews - Send Message</h3>
            <div class="text-right">
                <button class="btn btn-danger" onclick="location.href='logout.php'">Log Out</button>
            </div>
        </header>
        <div style="min-height : 78vh;">
            
            <?php if($msg !== ""){ ?>
                <div class="alert alert-primary h6 text-center"><?php echo $msg; ?></div>
            <?php } ?>
            
            <div class="container mt-5">
                <button class="btn btn-danger" onclick="location.href='dashboard.php';">< Add Link</button>
            </div>
            <div class="row p-5 m-0">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card border-success">
                        <div class="jumbotron mb-0 p-4 h4 bg-dark text-warning text-center">Send Message To Android Devices</div>
                        <form action="send_message_to_android.php" method="post">
                            <div class="form-group pl-3 pr-3 mt-3">
                                <label>Title : </label>
                                <input type="text" name="title" class="form-control" placeholder="Enter title of Message" required>
                            </div>
                            <div class="form-group pl-3 pr-3 mt-3">
                                <label>Message : </label>
                                <input type="text" name="message" class="form-control" placeholder="Enter content of Message" required>
                            </div>
                            <div class="row m-0 mt-3 mb-3">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <button type="submit" class="form-control btn-success">Send Message</button>
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
        <footer class="jumbotron p-4 mb-0 bg-info" style="min-height: 10vh;">
            <h5 class="text-right">&copy; Lampros Tech</h5>
        </footer>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>