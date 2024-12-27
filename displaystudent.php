<?php
include "database.php"; 
$sql = "SELECT studentid,name,age,gender,teacherid FROM student";
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
            <th>Student ID</th>
            <th>Name</th>
            <th>age</th>
            <th>gender</th>
            <th>Techer ID</th>
          </tr>";

    // Output the data for each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['studentid']) . "</td>
                <td>" . htmlspecialchars($row['name']) . "</td>
                <td>" . htmlspecialchars($row['age']) . "</td>
                <td>" . htmlspecialchars($row['gender']) . "</td>
                <td>" . htmlspecialchars($row['teacherid']) . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No data found.";
}
$conn->close();
?>
