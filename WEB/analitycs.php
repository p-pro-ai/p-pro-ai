<?php

require('autoexec.php');

if ($email_addr != 'petrovsvetoslav82@gmail.com' && $email_addr != 'Vvladigpasev@gmail.com') {
  die($email_addr);
}


$sql = "SELECT id, pers_name, email_addr FROM users_ai";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Users AI Table</title>
<style>
  body {
    font-family: Arial, sans-serif;
  }

  table {
    width: 100%;
    border-collapse: collapse;
  }

  th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }

  th {
    background-color: #f2f2f2;
  }

  tr:hover {
    background-color: #f5f5f5;
  }

  @media screen and (max-width: 600px) {
    table, th, td {
      display: block;
    }

    th, td {
      width: 100%;
    }

    th {
      position: absolute;
      top: -9999px;
      left: -9999px;
    }

    tr {
      padding: 10px 0;
      border-bottom: 1px solid #ddd;
    }

    td:before {
      content: attr(data-label);
      font-weight: bold;
      display: inline-block;
      width: 100%;
      background-color: #f2f2f2;
      padding: 4px;
      margin-bottom: 4px;
    }
  }
</style>
</head>
<body>
<?php
if ($result->num_rows > 0) {
  echo "<table>";
  echo "<thead>";
  echo "<tr><th data-label='ID'>ID</th><th data-label='Name'>Name</th><th data-label='Email'>Email</th></tr>";
  echo "</thead>";
  echo "<tbody>";

  while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td data-label='ID'>" . $row["id"] . "</td>";
    echo "<td data-label='Name'>" . $row["pers_name"] . "</td>";
    echo "<td data-label='Email'>" . $row["email_addr"] . "</td>";
    echo "</tr>";
  }

  echo "</tbody>";
  echo "</table>";
} else {
  echo "0 results";
}

$conn->close();
?>

</body>
</html>
