<?php
include "database.php"; 
$sql = "SELECT schoolid, schname, location FROM school";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<style>
            table {
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
            <th>School ID</th>
            <th>School Name</th>
            <th>Location</th>
          </tr>";

    // Output the data for each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['schoolid']) . "</td>
                <td>" . htmlspecialchars($row['schname']) . "</td>
                <td>" . htmlspecialchars($row['location']) . "</td>
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
