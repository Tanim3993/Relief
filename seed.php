<?php
include 'db.php';

echo "<h2>Seeding Database...</h2>";

try {
    // 1. Clear existing data (optional, but good for a fresh start)
    $conn->query("DELETE FROM Volunteer_Assignment");
    $conn->query("DELETE FROM Relief_Request");
    $conn->query("DELETE FROM Shelter");
    $conn->query("DELETE FROM Donation");
    $conn->query("DELETE FROM Resource");
    $conn->query("DELETE FROM Disaster_Event");
    $conn->query("DELETE FROM Users");
    
    echo "Existing data cleared.<br>";

    // 2. Create Users
    $pass1 = password_hash('password123', PASSWORD_DEFAULT);
    $conn->query("INSERT INTO Users (Name, Email, Password, Phone_Number, Role) VALUES 
        ('tanim', 'tanim@reliefnet.com', '$pass1', '01711111111', 'Admin'),
        ('soumik', 'soumik@reliefnet.com', '$pass1', '01822222222', 'Volunteer'),
        ('John Donor', 'john@gmail.com', '$pass1', '01933333333', 'Donor')");
    
    echo "Users 'tanim' and 'soumik' created (Password: password123).<br>";

    // 3. Create Disaster Events
    $conn->query("INSERT INTO Disaster_Event (Type, Location, Severity, Status, Start_Date) VALUES 
        ('Flood', 'Sylhet, Bangladesh', 'Critical', 'Active', '2024-05-15'),
        ('Cyclone', 'Chattogram, Bangladesh', 'High', 'Active', '2024-06-10'),
        ('Earthquake', 'Dhaka, Bangladesh', 'Medium', 'Resolved', '2024-01-20')");
    
    echo "Sample Disaster Events created.<br>";

    // 4. Create Resources
    $conn->query("INSERT INTO Resource (Name, Category, Quantity_Available, Unit) VALUES 
        ('Rice', 'Food', 5000, 'kg'),
        ('Fresh Water', 'Water', 10000, 'liters'),
        ('Paracetamol', 'Medicine', 2000, 'packets'),
        ('Tents', 'Shelter', 150, 'units')");
    
    echo "Resources populated.<br>";

    // 5. Create some Donations
    // Get Tanim's ID (Admin/Donor role for this example)
    $tanim_res = $conn->query("SELECT User_ID FROM Users WHERE Name='tanim'");
    $tanim_id = $tanim_res->fetch_assoc()['User_ID'];
    
    $event_res = $conn->query("SELECT Event_ID FROM Disaster_Event WHERE Type='Flood'");
    $flood_id = $event_res->fetch_assoc()['Event_ID'];

    $conn->query("INSERT INTO Donation (Amount, Payment_Method, Donor_ID, Event_ID) VALUES 
        (500.00, 'bKash', $tanim_id, $flood_id),
        (1200.50, 'Credit Card', $tanim_id, $flood_id)");

    echo "Sample Donations added.<br>";

    echo "<br><strong style='color:green;'>Database Seeded Successfully!</strong><br>";
    echo "<a href='login.php'>Go to Login</a>";

} catch (Exception $e) {
    echo "<br><strong style='color:red;'>Error during seeding:</strong> " . $e->getMessage();
}
?>