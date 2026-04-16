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
    <title>Report Disaster - ReliefNet</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: 600; color: #334155; }
        input, select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
            box-sizing: border-box;
        }
        .btn-submit {
            background-color: #2563eb;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
        }
        .btn-submit:hover { background-color: #1d4ed8; }
        .back-link { display: block; margin-top: 20px; text-align: center; color: #64748b; text-decoration: none; }
    </style>
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
                <h1>Report New Disaster Event</h1>
                <p>Provide details about a new disaster occurrence.</p>
            </header>

            <div class="form-container">
                <form action="process_event.php" method="POST">
                    <div class="form-group">
                        <label>Disaster Type</label>
                        <input type="text" name="type" placeholder="e.g., Flood, Earthquake, Fire" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Location</label>
                        <input type="text" name="location" placeholder="City, State/Province" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Severity Level</label>
                        <select name="severity">
                            <option value="Low">Low</option>
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>
                            <option value="Critical">Critical</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Start Date</label>
                        <input type="date" name="start_date" value="<?php echo date('Y-m-d'); ?>" required>
                    </div>

                    <button type="submit" class="btn-submit">Save Event to Database</button>
                </form>
                <a href="events.php" class="back-link">← Back to Events</a>
            </div>
        </main>
    </div>
</body>
</html>