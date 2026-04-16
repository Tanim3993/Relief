<?php 
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

$active_events_query = $conn->query("SELECT COUNT(*) as total FROM Disaster_Event WHERE Status='Active'");
$active_events = ($active_events_query) ? $active_events_query->fetch_assoc()['total'] : 0;

$total_funds_res = $conn->query("SELECT SUM(Amount) as total FROM Donation");
$total_funds = ($total_funds_res) ? $total_funds_res->fetch_assoc()['total'] : 0;

$total_resources_res = $conn->query("SELECT SUM(Quantity_Available) as total FROM Resource");
$total_resources = ($total_resources_res) ? $total_resources_res->fetch_assoc()['total'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relief Management Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <nav class="sidebar">
            <div class="logo">Relief<span>Net</span></div>
            <ul>
                <li class="active"><a href="index.php">Dashboard</a></li>
                <li><a href="events.php">Disaster Events</a></li>
                <li><a href="resources.php">Resources</a></li>
                <li><a href="donations.php">Donations</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>

        <main class="content">
            <header>
                <h1>Dashboard Overview</h1>
                <p>Welcome back, <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Admin'); ?></p>
                <a href="add_event.php" style="text-decoration: none;">
                    <button class="btn-primary">+ Report New Event</button>
                </a>
            </header>

            <section class="stats-grid">
                <div class="stat-card">
                    <h3>Active Disasters</h3>
                    <p class="value"><?php echo $active_events; ?></p>
                </div>
                <div class="stat-card">
                    <h3>Total Donations</h3>
                    <p class="value">$<?php echo number_format($total_funds, 2); ?></p>
                </div>
                <div class="stat-card">
                    <h3>Available Resources</h3>
                    <p class="value"><?php echo number_format($total_resources); ?> Units</p>
                </div>
            </section>

            <section class="table-container">
                <h3>Current Disaster Events</h3>
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