<?php 
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resources - ReliefNet</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <nav class="sidebar">
            <div class="logo">Relief<span>Net</span></div>
            <ul>
                <li><a href="index.php">Dashboard</a></li>
                <li><a href="events.php">Disaster Events</a></li>
                <li class="active"><a href="resources.php">Resources</a></li>
                <li><a href="donations.php">Donations</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>

        <main class="content">
            <header>
                <h1>Resource Inventory</h1>
                <p>Tracking available relief supplies and equipment.</p>
            </header>

            <section class="table-container">
                <h3>Stock Levels</h3>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Quantity Available</th>
                            <th>Unit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM Resource ORDER BY Category ASC";
                        $result = $conn->query($sql);

                        if ($result && $result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>#{$row['Resource_ID']}</td>
                                        <td>" . htmlspecialchars($row['Name']) . "</td>
                                        <td>" . htmlspecialchars($row['Category']) . "</td>
                                        <td>" . number_format($row['Quantity_Available']) . "</td>
                                        <td>" . htmlspecialchars($row['Unit']) . "</td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' style='text-align:center;'>No resources found in inventory.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>
</html>