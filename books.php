<?php 
    require_once "config.php";
?>
<!doctype html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>Welcome</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
        <script src='bootstrap/js/bootstrap.bundle.min.js' type='text/javascript'></script>
    </head>
    <body style = "background-image: url('images/book.jpg'); text-align:center; vertical-align: middle;">
        <div class="container" >
            <div class="modal fade" id="bookModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Book Info</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          
                        </div>
                        <div class="modal-body">
                          
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </div>  
                </div>
            </div>
            <br/>
            <a href="logout.php">
                <button class="navbar-nav ml-auto btn-primary">
                    LogOut
                </button> 
            </a>
            <br/>
        <div>              
            <h1 style="background-color:brown; color:#FFD700;"> Welocome to e-library! </h1>
        </div>
            <br/>
        <div style="background-color:white;">
            <h2 style="background-color:brown; color:#FFD700;"> Books Catalogue <br/> </h2>
            <table class="table table-striped table-bordered table-sm" style="width:100%;">
            <thead>
                <th class="th-sm">Book id</th>
                <th class="th-sm">Title</th>
                <th class="th-sm">Author</th>
                <th class="th-sm">Price</th>
                <th class="th-sm">More Info</th>
            </thead>
            <tbody>
            <span><?php
                $query = "select * from books";
                $result = mysqli_query($link,$query);
                if (!$result) {
                    printf("Error: %s\n", mysqli_error($link));
                    exit();
                }
                while($row = mysqli_fetch_array($result)){
                    $book_id = $row['Book_id'];
                    $Title = $row['Title'];
                    $Author = $row['Author'];
                    $Price = $row['Price'];
                    echo "<tr>";
                    echo "<td>".$book_id."</td>";
                    echo "<td>".$Title."</td>";
                    echo "<td>".$Author."</td>";
                    echo "<td>".$Price."</td>";
                    echo "<td><button data-id='".$book_id."' class='bookinfo' style='background-color: blue; color:white;'>Load</button></td>";
                    echo "</tr>";
                }
                ?>
            </span>
            </tbody>
            </table>
        </div>
            <script type='text/javascript'>
            $(document).ready(function(){

                $('.bookinfo').click(function(){
                   
                    var bookid = $(this).data('id');

                    $.ajax({
                        url: 'display.php',
                        type: 'post',
                        data: {bookid: bookid},
                        success: function(response){ 
                            $('.modal-body').html(response); 
                            $('#bookModal').modal('show'); 
                        }
                    });
                });
            });
            </script>
        </div>
    </body>
</html>

        