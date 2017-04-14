<?php
header("Content-type: application/vnd.ms-word");
// header('Content-type: application/csv'); //*** CSV ***//
header("Content-Disposition: attachment; filename=dreamhome.doc");
header("Pragma:no-cache");
header("Expires:0");
?>
<html>
<body>
<?php
  $connect=mysqli_connect("localhost","root","45018140","dreamhome");
    $query="SELECT DISTINCT Client.clientno, Client.fname, Client.lname, Viewing.viewdate,PropertyForRent.city
            FROM Client
            INNER JOIN Viewing ON Client.clientno=Viewing.clientno
            INNER JOIN PropertyForRent ON Viewing.propertyno=PropertyForRent.propertyno";
    $result = mysqli_query($connect,$query);
?>
<table width="600" border="1">
<tr>
<th width="91"> <div align="center">Clientno </div></th>
<th width="198"> <div align="center">Firstname </div></th>
<th width="198"> <div align="center">Lastname </div></th>
<th width="97"> <div align="center">Viewdate </div></th>
<th width="97"> <div align="center">City </div></th>
</tr>
<?php
  while($row=mysqli_fetch_array($result)){
?>
  <tr>
  <td><?php echo $row["clientno"];?></td>
  <td><?php echo $row["fname"];?></td>
  <td><?php echo $row["lname"];?></td>
  <td><?php echo $row["viewdate"];?></td>
  <td ><?php echo $row["city"];?></td>
  </tr>
<?php
}
?>
</table>

</body>
</html>