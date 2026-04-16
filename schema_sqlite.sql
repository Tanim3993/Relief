-- 1. Create the Users table
CREATE TABLE IF NOT EXISTS Users (
    User_ID INTEGER PRIMARY KEY AUTOINCREMENT,
    Name TEXT NOT NULL,
    Email TEXT UNIQUE NOT NULL,
    Password TEXT NOT NULL,
    Phone_Number TEXT,
    Role TEXT CHECK(Role IN ('Admin', 'Field Officer', 'Volunteer', 'Donor')) NOT NULL
);

-- 2. Create the Disaster_Event table
CREATE TABLE IF NOT EXISTS Disaster_Event (
    Event_ID INTEGER PRIMARY KEY AUTOINCREMENT,
    Type TEXT NOT NULL,
    Location TEXT NOT NULL,
    Severity TEXT CHECK(Severity IN ('Low', 'Medium', 'High', 'Critical')) NOT NULL,
    Status TEXT CHECK(Status IN ('Active', 'Resolved', 'Pending')) DEFAULT 'Active',
    Start_Date DATE NOT NULL
);

-- 3. Create the Resource table
CREATE TABLE IF NOT EXISTS Resource (
    Resource_ID INTEGER PRIMARY KEY AUTOINCREMENT,
    Name TEXT NOT NULL,
    Category TEXT,
    Quantity_Available INTEGER DEFAULT 0,
    Unit TEXT -- e.g., 'kg', 'liters', 'packets'
);

-- 4. Create the Donation table
CREATE TABLE IF NOT EXISTS Donation (
    Donation_ID INTEGER PRIMARY KEY AUTOINCREMENT,
    Amount REAL NOT NULL,
    Date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Payment_Method TEXT,
    Donor_ID INTEGER NOT NULL,
    Event_ID INTEGER NOT NULL,
    FOREIGN KEY (Donor_ID) REFERENCES Users(User_ID) ON DELETE CASCADE,
    FOREIGN KEY (Event_ID) REFERENCES Disaster_Event(Event_ID) ON DELETE CASCADE
);

-- 5. Create the Shelter table
CREATE TABLE IF NOT EXISTS Shelter (
    Shelter_ID INTEGER PRIMARY KEY AUTOINCREMENT,
    Name TEXT NOT NULL,
    Location TEXT,
    Capacity INTEGER NOT NULL,
    Current_Occupancy INTEGER DEFAULT 0,
    Event_ID INTEGER NOT NULL,
    FOREIGN KEY (Event_ID) REFERENCES Disaster_Event(Event_ID) ON DELETE CASCADE
);

-- 6. Create the Relief_Request table
CREATE TABLE IF NOT EXISTS Relief_Request (
    Request_ID INTEGER PRIMARY KEY AUTOINCREMENT,
    Quantity INTEGER NOT NULL,
    Status TEXT CHECK(Status IN ('Pending', 'Approved', 'Rejected', 'Delivered')) DEFAULT 'Pending',
    Request_Date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Event_ID INTEGER NOT NULL,
    Officer_ID INTEGER NOT NULL,
    Resource_ID INTEGER NOT NULL,
    FOREIGN KEY (Event_ID) REFERENCES Disaster_Event(Event_ID) ON DELETE CASCADE,
    FOREIGN KEY (Officer_ID) REFERENCES Users(User_ID) ON DELETE CASCADE,
    FOREIGN KEY (Resource_ID) REFERENCES Resource(Resource_ID) ON DELETE CASCADE
);

-- 7. Create the Volunteer_Assignment table
CREATE TABLE IF NOT EXISTS Volunteer_Assignment (
    Assignment_ID INTEGER PRIMARY KEY AUTOINCREMENT,
    Task_Description TEXT,
    Shift_Date DATE NOT NULL,
    Status TEXT CHECK(Status IN ('Assigned', 'In Progress', 'Completed', 'Cancelled')) DEFAULT 'Assigned',
    Volunteer_ID INTEGER NOT NULL,
    Event_ID INTEGER NOT NULL,
    FOREIGN KEY (Volunteer_ID) REFERENCES Users(User_ID) ON DELETE CASCADE,
    FOREIGN KEY (Event_ID) REFERENCES Disaster_Event(Event_ID) ON DELETE CASCADE
);
