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
        <title>QuikNews - Dashboard</title>
    </head>
    <body>
        <header class="jumbotron bg-primary p-4 mb-0" style="min-height : 10vh;">
            <h3 class="text-white text-monospace">QuikNews - Add Link</h3>
            <div class="text-right">
                <button class="btn btn-danger" onclick="location.href='logout.php'">Log Out</button>
            </div>
        </header>
        <div style="min-height : 78vh;">
            
            <?php if($msg !== ""){ ?>
                <div class="alert alert-primary h6 text-center"><?php echo $msg; ?></div>
            <?php } ?>
            
            <div class="container text-right mt-5">
                <button class="btn btn-danger" onclick="location.href='send_message.php';">Send Custom Notification ></button>
            </div>
            <div class="row p-5">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card border-success">
                        <div class="jumbotron mb-0 p-4 h4 bg-dark text-warning text-center">Add Image Link</div>
                        <form action="add_link.php" method="post">
                            <div class="form-group pl-3 pr-3 mt-3">
                                <label>Category : </label>
                                <select name="category" class="form-control" id="category" autofocus required onchange="set_required()">
                                    <option value=""> - - - Select Category - - - </option>
                                    <!-- <option value="0">Blog</option> -->
                                    <option value="1">Stocks</option>
                                    <option value="2">Mutual Funds</option>
                                    <option value="3">IPOs</option>
                                    <option value="4">Prime</option>
                                    <option value="5">Others</option>

                                </select>
                            </div>
                            <div class="form-group pl-3 pr-3 mt-3">
                                <label>Image Link : </label>
                                <input type="url" name="image_link" class="form-control" placeholder="Enter / Paste Image Link" required>
                            </div>

                            <!-- Uncomment these lines for blogs -->
                            <!-- It'll be visible when type is blog -->
                            <!-- <div class="form-group pl-3 pr-3 mt-3" id="div_sub" style="display: none;">
                                <label>Blog Subject : </label>
                                <input type="text" name="blog_subject" id="blog_subject" maxlength="40" class="form-control" placeholder="Enter Blog subject">
                            </div>
                            <div class="form-group pl-3 pr-3 mt-3" id="div_des" style="display: none;">
                                <label>Blog Description : </label>
                                <textarea class="form-control" rows="10" name="description" id="description">
                                    &lt;p&gt;This is some sample content.&lt;/p&gt;
                                </textarea>
                            </div> -->
                            <!-- Blog Section ends here -->
                            
                            <div class="form-group pl-3 pr-3 mt-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="notify" id="not_chk" onclick="set_notification_elements()">
                                    <label class="form-check-label" for="not_chk">Notify User for post</label>
                                </div>
                            </div>
                            
                            <!-- Notification Section which will visible on notify checkbox checked = true -->
                            <div class="form-group pl-3 pr-3 mt-3" id="div_not_title" style="display: none;">
                                <label>Notification Title : </label>
                                <input type="text" name="title" id="not_title" maxlength="30" class="form-control" placeholder="Enter Notification Title">
                            </div>
                            <div class="form-group pl-3 pr-3 mt-3" id="div_not_body" style="display: none;">
                                <label>Notification Body : </label>
                                <textarea class="form-control" placeholder="Enter Notification body" name="body" id="not_body" rows="3" style="resize: none;" maxlength="100"></textarea>
                            </div>
                            <!-- Notification section ends here -->

                            <div class="container mt-3 pl-3 p-2 pr-3 mb-3">
                                <button type="submit" class="form-control btn-success">Add Link / Blog</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
            <div class="container text-left">
                <button class="form-control text-danger" onclick="location.href='view.php'">View Inserted Links</button>
            </div>
        </div>
        <footer class="jumbotron p-4 mb-0 bg-info" style="min-height: 10vh;">
            <h5 class="text-right">&copy; Lampros Tech</h5>
        </footer>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/20.0.0/classic/ckeditor.js"></script>
        <script>

            // Unable Javascript function code for blogs while it sets some rules in html
            // function set_required(){
            //     if(document.getElementById('category').value == 0){
            //         document.getElementById('blog_subject').setAttribute("required","");
            //         document.getElementById('description').setAttribute("required","");
            //         document.getElementById('div_sub').style.display = "block";
            //         document.getElementById('div_des').style.display = "block";
            //     }
            //     else{
            //         document.getElementById('blog_subject').removeAttribute("required");
            //         document.getElementById('description').removeAttribute("required");
            //         document.getElementById('div_sub').style.display = "none";
            //         document.getElementById('div_des').style.display = "none";
            //     }
            // }
            function set_notification_elements(){
                if(document.getElementById('not_chk').checked === true){
                    document.getElementById('not_title').setAttribute("required","");
                    document.getElementById('not_body').setAttribute("required","");
                    document.getElementById('div_not_title').style.display = "block";
                    document.getElementById('div_not_body').style.display = "block";
                }
                else{
                    document.getElementById('not_title').removeAttribute("required");
                    document.getElementById('not_body').removeAttribute("required");
                    document.getElementById('div_not_title').style.display = "none";
                    document.getElementById('div_not_body').style.display = "none";
                }
            }
            ClassicEditor
                .create( document.querySelector( '#description' ) )
                .catch( error => {
                    console.error( error );
            });
            // JQuery code to enable text editor in text-area
        </script>
    </body>
</html>