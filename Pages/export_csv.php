<?php
    if(isset($_POST["export"]))
    {
        $connect = mysqli_connect("localhost","root","parola12","tw");
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=data.csv');
        $output = fopen("php://output","w");
        fputcsv($output,array('id','album_id','artist_id','song_title','number_of_likes','uploaded_at'));
        $query = "select * from songs";
        $result = mysqli_query($connect,$query);
        while($row = mysqli_fetch_assoc($result))
        {
            fputcsv($output,$row);
        }
        fclose($output);
    }
?>