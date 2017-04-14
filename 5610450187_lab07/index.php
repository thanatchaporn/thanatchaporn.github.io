<?php
        echo "<table style='border: solid 1px black;'>";
        echo "<tr>
                <th>ClientNO</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Viewdate</th>
                <th>City</th>
            </tr>";

        class TableRows extends RecursiveIteratorIterator {

            function __construct($it) {
                parent::__construct($it, self::LEAVES_ONLY);
            }

            function current() {
                return "<td style='width: 250px; border: 2px solid black;'>" . parent::current() . "</td>";
            }

            function beginChildren() {
                echo "<tr>";
            }

            function endChildren() {
                echo "</tr>" . "\n";
            }

        }

        $servername = "localhost";
        $username = "root";
        $password = "45018140";
        $dbname = "dreamhome";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT DISTINCT Client.clientno, Client.fname, Client.lname, Viewing.viewdate,PropertyForRent.city
                                    FROM Client
                                    INNER JOIN Viewing ON Client.clientno=Viewing.clientno
                                    INNER JOIN PropertyForRent ON Viewing.propertyno=PropertyForRent.propertyno;");
            $stmt->execute();

            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

            foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k => $v) {
                echo $v;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        echo "</table>";

function fetch_data(){
    $output='';
    $connect=mysqli_connect("localhost","root","45018140","dreamhome");
    $query="SELECT DISTINCT Client.clientno, Client.fname, Client.lname, Viewing.viewdate,PropertyForRent.city
            FROM Client
            INNER JOIN Viewing ON Client.clientno=Viewing.clientno
            INNER JOIN PropertyForRent ON Viewing.propertyno=PropertyForRent.propertyno";
    $result = mysqli_query($connect,$query);
    while($row = mysqli_fetch_array($result)){
        $output.='          
        <tr>
            <td>'.$row["clientno"].'</td>
            <td>'.$row["fname"].'</td>
            <td>'.$row["lname"].'</td>
            <td>'.$row["viewdate"].'</td>
            <td>'.$row["city"].'</td>
        </tr>
        ';

    }
    return $output;

}

?>


<!DOCTYPE html>
<html>
<head>
<link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

    
<div class="btn-group" style="margin-left:73%;">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Export <span class="caret"></span>
  </button>
  
  <ul class="dropdown-menu" style="padding-left: 10px;">
  <form method="post">
    <!-- <li><input type="submit" name="create_pdf" value="Create PDF"></li> -->
    <li><a href="exportPDF.php" target="_blank">PDF</a></li>
    <li role="separator" class="divider"></li>
    <li><a href="exportMS.php" target="_blank">Word</a></li>
    <li><a href="exportExcel.php" target="_blank">XLS</a></li>
    <li><a href="exportPPT.php" target="_blank">PowerPoint</a></li>
    <li role="separator" class="divider"></li>
    <li><a href="exportCSV.php" target="_blank">CSV</a></li>
    </form>
  </ul>

</div>

</body>
</html>