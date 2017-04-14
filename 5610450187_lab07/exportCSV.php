<?php
header('Content-type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=dreamhome.csv');
$output= fopen("php://output","w");
?>
<?php
  $connect=mysqli_connect("localhost","root","45018140","dreamhome");
  fputcsv($output,array('Clientno','Firstname','Lastname','Viewdate','City'));
    $query="SELECT DISTINCT Client.clientno, Client.fname, Client.lname, Viewing.viewdate,PropertyForRent.city
            FROM Client
            INNER JOIN Viewing ON Client.clientno=Viewing.clientno
            INNER JOIN PropertyForRent ON Viewing.propertyno=PropertyForRent.propertyno";
    $result = mysqli_query($connect,$query);
    while($row=mysqli_fetch_assoc($result)){
        fputcsv($output, $row);

    }
    fclose($output);
?>