<?php
    require_once "config.php";

    $Book_id = $_POST['bookid'];

    $sql = "select * from books where Book_id=".$Book_id;
    $result = mysqli_query($link,$sql);

    $response = "<table border='0' width='100%'>";
    while( $row = mysqli_fetch_array($result) ){
        $Book_id = $row['Book_id'];
        $Title = $row['Title'];
        $Author = $row['Author'];
        $Category = $row['Category'];
        $Description = $row['Description'];
        $Price = $row['Price'];
        $Review = $row['Review'];
        
        $response .= "<tr>";
        $response .= "<td><b>Title : </b></td><td>".$Title."</td>";
        $response .= "</tr>";

        $response .= "<tr>";
        $response .= "<td><b>Author : </b></td><td>".$Author."</td>";
        $response .= "</tr>";

        $response .= "<tr>";
        $response .= "<td><b>Category : </b></td><td>".$Category."</td>";
        $response .= "</tr>";
        
        $response .= "<tr>";
        $response .= "<td><b>Price : </b></td><td>".$Price."</td>";
        $response .= "</tr>";

        $response .= "<tr>";
        $response .= "<td><b>Review : </b></td><td>".$Review."</td>";
        $response .= "</tr>";

        $response .= "<tr>";
        $response .= "<td><b>Description: </b></td><td>".$Description."</td>";
        $response .= "</tr>";

    }
    $response .= "</table>";

    echo $response;
    exit;