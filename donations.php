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
    <title>Donations - ReliefNet</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <nav class="sidebar">
            <div class="logo">Relief<span>Net</span></div>
            <ul>
                <li><a href="index.php">Dashboard</a></li>
                <li><a href="events.php">Disaster Events</a></li>
                <li><a href="resources.php">Resources</a></li>
                <li class="active"><a href="donations.php">Donations</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>

        <main class="content">
            <header>
                <h1>Donations History</h1>
                <p>Tracking financial contributions for relief efforts.</p>
            </header>

            <section class="table-container">
                <h3>Recent Donations</h3>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Donor</th>
                            <th>Event</th>
                            <th>Amount</th>
                            <th>Method</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT d.*, u.Name as Donor_Name, e.Type as Event_Type 
                                FROM Donation d
                                JOIN Users u ON d.Donor_ID = u.User_ID
                                JOIN Disaster_Event e ON d.Event_ID = e.Event_ID
                                ORDER BY d.Date DESC";
                        $result = $conn->query($sql);

                        if ($result && $result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>#{$row['Donation_ID']}</td>
                                        <td>" . htmlspecialchars($row['Donor_Name']) . "</td>
                                        <td>" . htmlspecialchars($row['Event_Type']) . "</td>
                                        <td>$" . number_format($row['Amount'], 2) . "</td>
                                        <td>" . htmlspecialchars($row['Payment_Method']) . "</td>
                                        <td>" . htmlspecialchars($row['Date']) . "</td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' style='text-align:center;'>No donation records found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>
</html>