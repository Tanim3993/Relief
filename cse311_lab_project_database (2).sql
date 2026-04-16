CREATE DATABASE IF NOT EXISTS cse311_lab_project_database;
USE cse311_lab_project_database;


-- 1. Create the USER table (The Actors)
CREATE TABLE Users (
    User_ID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(100) NOT NULL,
    Email VARCHAR(100) UNIQUE NOT NULL,
    Password VARCHAR(255) NOT NULL,
    Phone_Number VARCHAR(20),
    Role ENUM('Admin', 'Field Officer', 'Volunteer', 'Donor') NOT NULL
);

-- 2. Create the DISASTER_EVENT table (The Hub)
CREATE TABLE Disaster_Event (
    Event_ID INT PRIMARY KEY AUTO_INCREMENT,
    Type VARCHAR(50) NOT NULL,
    Location VARCHAR(150) NOT NULL,
    Severity ENUM('Low', 'Medium', 'High', 'Critical') NOT NULL,
    Status ENUM('Active', 'Resolved', 'Pending') DEFAULT 'Active',
    Start_Date DATE NOT NULL
);

-- 3. Create the RESOURCE table (The Warehouse)
CREATE TABLE Resource (
    Resource_ID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(100) NOT NULL,
    Category VARCHAR(50),
    Quantity_Available INT DEFAULT 0,
    Unit VARCHAR(20) -- e.g., 'kg', 'liters', 'packets'
);

-- 4. Create the DONATION table (The Financer)
CREATE TABLE Donation (
    Donation_ID INT PRIMARY KEY AUTO_INCREMENT,
    Amount DECIMAL(15, 2) NOT NULL,
    Date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Payment_Method VARCHAR(50),
    Donor_ID INT NOT NULL,
    Event_ID INT NOT NULL,
    FOREIGN KEY (Donor_ID) REFERENCES Users(User_ID) ON DELETE CASCADE,
    FOREIGN KEY (Event_ID) REFERENCES Disaster_Event(Event_ID) ON DELETE CASCADE
);

-- 5. Create the SHELTER table (The Safe Haven)
CREATE TABLE Shelter (
    Shelter_ID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(100) NOT NULL,
    Location VARCHAR(150),
    Capacity INT NOT NULL,
    Current_Occupancy INT DEFAULT 0,
    Event_ID INT NOT NULL,
    FOREIGN KEY (Event_ID) REFERENCES Disaster_Event(Event_ID) ON DELETE CASCADE
);

-- 6. Create the RELIEF_REQUEST table (The Communication Bridge)
CREATE TABLE Relief_Request (
    Request_ID INT PRIMARY KEY AUTO_INCREMENT,
    Quantity INT NOT NULL,
    Status ENUM('Pending', 'Approved', 'Rejected', 'Delivered') DEFAULT 'Pending',
    Request_Date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Event_ID INT NOT NULL,
    Officer_ID INT NOT NULL,
    Resource_ID INT NOT NULL,
    FOREIGN KEY (Event_ID) REFERENCES Disaster_Event(Event_ID) ON DELETE CASCADE,
    FOREIGN KEY (Officer_ID) REFERENCES Users(User_ID) ON DELETE CASCADE,
    FOREIGN KEY (Resource_ID) REFERENCES Resource(Resource_ID) ON DELETE CASCADE
);

-- 7. Create the VOLUNTEER_ASSIGNMENT table (The Workforce Manager)
CREATE TABLE Volunteer_Assignment (
    Assignment_ID INT PRIMARY KEY AUTO_INCREMENT,
    Task_Description TEXT,
    Shift_Date DATE NOT NULL,
    Status ENUM('Assigned', 'In Progress', 'Completed', 'Cancelled') DEFAULT 'Assigned',
    Volunteer_ID INT NOT NULL,
    Event_ID INT NOT NULL,
    FOREIGN KEY (Volunteer_ID) REFERENCES Users(User_ID) ON DELETE CASCADE,
    FOREIGN KEY (Event_ID) REFERENCES Disaster_Event(Event_ID) ON DELETE CASCADE
);

