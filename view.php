<?php
    require_once 'connection.php';
    $conn = getConn();
    session_start();
    $msg = "";
    $page = 1;
    $date = "";
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
    if(isset($_GET['page'])){
        $page = $_GET['page'];
        if($page <= 0){
            $page = 1;
        }
    }
    if(isset($_GET['date'])){
        $date  = $_GET['date'];
    }
    $limit = ($page-1) * 20;
    // provide upper limit for specific page

    if($date != ""){
        $date = date("Y-m-d",strtotime($date));
        $query = "SELECT id,image,created_at,category from images where created_at like '$date%' order by created_at desc";
        // setting date which has to be searched with specific limits using pagination
    }
    else{
        $query = "SELECT id,image,created_at,category from images order by created_at desc";
        // setting only limits and generating the record
    }
    $images = $conn->query($query);
    $totalPages = ceil(mysqli_num_rows($images)/20);
    $images = $conn->query($query." limit $limit,20");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta charset="UTF-8">
        <title>QuikNews - View</title>
    </head>
    <body>
        <header class="jumbotron bg-primary p-4 mb-0" style="min-height : 10vh;">
            <h3 class="text-white text-monospace">QuikNews - View</h3>
            <div class="text-right">
                <button class="btn btn-danger" onclick="location.href='logout.php'">Log Out</button>
            </div>
        </header>
        <div style="min-height : 78vh;">
            <div class="container mt-4 text-left">
                <button class="form-control btn-warning" onclick="location.href='dashboard.php'">Add Images / Blog</button>
            </div>
            <div class="container text-right mt-5">
                <input type="date" class="form-control" id="date_search" <?php if($date != ""){ ?> value="<?php echo date("Y-m-d", strtotime($date)); ?>" <?php } ?> onchange="send_view()">
            </div>
            <div class="clearfix mt-5 mb-5">
                <div class="float-left">
                    
                    <?php if($page > 1){ ?>
                    <button class="btn btn-danger" onclick="location.href='view.php?page=<?php echo ($page-1); ?>&date=<?php echo $date; ?>'">< < < Previous</button>
                    <?php } ?>

                </div>
                <div class="float-right">

                    <?php if($page < $totalPages){ ?>
                    <button class="btn btn-danger" onclick="location.href='view.php?page=<?php echo ($page+1); ?>&date=<?php echo $date; ?>'">Next > > ></button>
                    <?php } ?>

                </div>
            </div>

            
            <div class="container w-75 text-center mt-5">
                
                <?php if($msg !== ""){ ?>
                    <div class="alert alert-primary h6 text-center"><?php echo $msg; ?></div>
                <?php } ?>

               <?php
                    while($row = $images->fetch_array()){
                    $category = $row['category'];
                ?>

                <div class="mb-3 mt-3 p-3 border">
                    <h4 class="text-left">
                        
                        <?php
                            switch($category){
                                // case 0:
                                //     echo "Blog";
                                //     break;
                                case 1:
                                    echo "Home";
                                    break;
                                case 2:
                                    echo "Stocks";
                                    break;
                                case 3:
                                    echo "Mutual Funds";
                                    break;
                                case 4:
                                    echo "IPOs";
                                    break;
                                case 5:
                                    echo "Economy";
                                    break;
                                case 6:
                                    echo "Others";
                                    break;
                            }
                            // writing name of category in place of numeric identification we have
                        ?>

                    </h4>
                    <h5 class="text-right mb-2"><?php echo date('dS F Y - H:i A',strtotime($row['created_at'])); ?></h5>


                    <!-- Uncomment all the lines below for blogs -->
                    <?php
                        // if($category == 0){ // Fetching subject when link / post is of type blog
                        //     $blog = $conn->query("SELECT subject from blog where image_id=".$row['id']);
                        //     $blog = $blog->fetch_array();
                    ?>
                    <!-- <button class="btn btn-link p-0" onclick="location.href='read.php?details=<?php echo $row['id']; ?>';"><?php echo $blog['subject']; ?></button><br> -->
                    <?php //} ?>
                    
                    <img src="<?php echo $row['image'] ?>" alt="Links Image" class="img-thumbnail">
                    <button class="form-control btn-danger mt-3" onclick="if(confirm('Do you want to delete the link / blog?')){location.href='delete.php?id=<?php echo $row['id']; ?>&date=<?php echo $date; ?>&page=<?php echo $page; ?>';}">Delete Link / Blog</button>
                </div>
                <?php } ?>

            </div>
            <div class="clearfix mt-5 mb-5">
                <div class="float-left">
                    
                    <?php if($page > 1){ ?>
                    <button class="btn btn-danger" onclick="location.href='view.php?page=<?php echo ($page-1); ?>&date=<?php echo $date; ?>'">< < < Previous</button>
                    <?php } ?>

                </div>
                <div class="float-right">

                    <?php if($page < $totalPages){ ?>
                    <button class="btn btn-danger" onclick="location.href='view.php?page=<?php echo ($page+1); ?>&date=<?php echo $date; ?>'">Next > > ></button>
                    <?php } ?>

                </div>
            </div>
        </div>
        <footer class="jumbotron p-4 mb-0 bg-info" style="min-height: 10vh;">
            <h5 class="text-right">&copy; Lampros Tech</h5>
        </footer>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script>
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth()+1;
            var yyyy = today.getFullYear();
            if(dd<10){
                dd='0'+dd
            } 
            if(mm<10){
                mm='0'+mm
            } 
            today = yyyy+'-'+mm+'-'+dd;
            // setting max date as today's date for date picker
            document.getElementById("date_search").setAttribute("max", today);
            function send_view(){
                var date = document.getElementById('date_search').value;
                location.href="view.php?date="+date;
            }
        </script>
    </body>
</html>