<?php
    include_once '../../connection.php';
    $conn = getConn();
    $details = "";
    if(!isset($_GET['details'])){
        header("Location: ../../this_site_certainly_does_not_exist");
    }
    else{
        $details = str_replace("blog_"," ",$_GET['details']);
        $details[-1] = " ";
        $details = trim($details);
        if(!is_numeric($details)){
            header("Location: ../../this_site_certainly_does_not_exist");
        }
    }
    $blog = $conn->query("SELECT subject,description from blog where image_id=$details");
    $image = $conn->query("SELECT image from images where id=$details");
    $image = $image->fetch_array();
    $blog = $blog->fetch_array();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta charset="UTF-8">
        <title>QuikNews - Blog</title>
    </head>
    <body>
        <header class="jumbotron bg-primary p-4 m-0" style="min-height : 10vh;">
            <h3 class="text-white text-monospace"><?php echo $blog['subject']; ?></h3>
        </header>
        <div style="min-height : 80vh; margin:0;">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8 mt-5 mb-5 card p-3 p">
                    <div class="container text-center">
                        <img src="<?php echo $image['image']; ?>" alt="Featured Image" class="img-thumbnail">
                    </div>
                    <?php
                        echo $blog['description'];
                    ?>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
        <footer class="jumbotron m-0 p-4 bg-info" style="min-height: 10vh;">
            <h5 class="text-right">&copy; Lampros Tech</h5>
        </footer>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>