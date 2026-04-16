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
    <title>Disaster Events - ReliefNet</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <nav class="sidebar">
            <div class="logo">Relief<span>Net</span></div>
            <ul>
                <li><a href="index.php">Dashboard</a></li>
                <li class="active"><a href="events.php">Disaster Events</a></li>
                <li><a href="resources.php">Resources</a></li>
                <li><a href="donations.php">Donations</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>

        <main class="content">
            <header>
                <h1>Disaster Events</h1>
                <p>Manage and track ongoing disaster relief efforts.</p>
                <a href="add_event.php" style="text-decoration: none;">
                    <button class="btn-primary">+ Report New Event</button>
                </a>
            </header>

            <section class="table-container">
                <h3>All Disaster Events</h3>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Location</th>
                            <th>Severity</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM Disaster_Event ORDER BY Start_Date DESC";
                        $result = $conn->query($sql);

                        if ($result && $result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                $sev = strtolower($row['Severity']);
                                echo "<tr>
                                        <td>#{$row['Event_ID']}</td>
                                        <td>" . htmlspecialchars($row['Type']) . "</td>
                                        <td>" . htmlspecialchars($row['Location']) . "</td>
                                        <td><span class='badge $sev'>" . htmlspecialchars($row['Severity']) . "</span></td>
                                        <td>" . htmlspecialchars($row['Status']) . "</td>
                                        <td>" . htmlspecialchars($row['Start_Date']) . "</td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' style='text-align:center;'>No records found. Click '+ Report New Event' to add one.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>
</html>