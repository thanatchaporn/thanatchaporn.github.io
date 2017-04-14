<?php
        echo "<table style='border: solid 1px black;'>";
        echo "<tr><th>ClientNO</th><th>Firstname</th><th>Lastname</th><th>Viewdate</th></tr>";

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
        ?>