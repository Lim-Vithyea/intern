<?php
include "database.php"; 
$sql = "SELECT stufid,stufname,gender,age,position,address,schlid FROM staff";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<style>
            table {
                margin: 20px;
                width: 100%;
                border-collapse: collapse;
                margin: 20px 0;
            }
            th, td {
                padding: 8px 12px;
                text-align: left;
                border: 1px solid #ddd;
            }
            th {
                background-color: #4CAF50;
                color: white;
            }
            tr:nth-child(even) {
                background-color: #f2f2f2;
            }
            tr:hover {
                background-color: #ddd;
            }
          </style>";
    echo "<table border='1px solid black'>";
    echo "<tr>
            <th>stuff ID</th>
            <th>stuff Name</th>
            <th>Gende</th>
            <th>Position</th>
            <th>address</th>
            <th>school ID</th>
          </tr>";

    // Output the data for each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['stufid']) . "</td>
                <td>" . htmlspecialchars($row['stufname']) . "</td>
                <td>" . htmlspecialchars($row['gender']) . "</td>
                <td>" . htmlspecialchars($row['position']) . "</td>
                <td>" . htmlspecialchars($row['address']) . "</td>
                <td>" . htmlspecialchars($row['schlid']) . "</td>
              </tr>";
    }

    // End the table
    echo "</table>";
} else {
    echo "No data found.";
}

// Close the connection
$conn->close();
?>
