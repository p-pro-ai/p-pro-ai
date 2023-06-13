<?php

require ('dbconn.php');

?>
<!DOCTYPE html>
<html>
<head>
    <title>Hassan's Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <h2>Hassan's Dashboard</h2>
    <table>
        <tr>
            <th>Email</th>
            <th>Subscription</th>
            <th>Тo be paid to you</th>
        </tr>
        <?php
        

        $sql = "SELECT email_adds, subscription, topay FROM twitter_hassan_toor";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["email_adds"]. "</td><td>" . $row["subscription"]. "</td><td>" . $row["topay"]. "</td></tr>";
            }
        } else {
           // echo "0 results";
        }

        $sql_total = "SELECT SUM(topay) as total_pay FROM twitter_hassan_toor";
        $result_total = $conn->query($sql_total);
        $total = $result_total->fetch_assoc();

        $total_rounded = round($total["total_pay"], 2);
echo "Total to be paid to you: " . $total_rounded." EUR";
        $conn->close();
        ?>
    </table>
</body>
</html>
