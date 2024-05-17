# alchemists
-- Create Users Table
CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    role ENUM('admin', 'user') NOT NULL
 balance DECIMAL(10, 2) DEFAULT 0.00;
);

-- Create Digital Transport Passes Table
CREATE TABLE Digital_Transport_Passes (
    pass_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    pass_type ENUM('daily', 'weekly', 'monthly') NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    status ENUM('active', 'expired') NOT NULL,
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

-- Create Transport Data Table
CREATE TABLE Transport_Data (
    transport_id INT AUTO_INCREMENT PRIMARY KEY,
    vehicle_id INT NOT NULL,
    route_id INT NOT NULL,
    current_location VARCHAR(100) NOT NULL,
    current_status VARCHAR(50) NOT NULL,
    arrival_time DATETIME,
    departure_time DATETIME
);

-- Create Payments Table
CREATE TABLE Payments (
    payment_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    payment_date DATETIME NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

-- Create Parking Spaces Table
CREATE TABLE Parking_Spaces (
    parking_id INT AUTO_INCREMENT PRIMARY KEY,
    parking_name VARCHAR(100) NOT NULL,
    location VARCHAR(100) NOT NULL,
    availability ENUM('available', 'full') NOT NULL
);

-- Create Traffic Patterns Table
CREATE TABLE Traffic_Patterns (
    pattern_id INT AUTO_INCREMENT PRIMARY KEY,
    pattern_name VARCHAR(100) NOT NULL,
    pattern_description TEXT,
    optimization_method VARCHAR(100)
);

-- Create Signal Timings Table
CREATE TABLE Signal_Timings (
    signal_id INT AUTO_INCREMENT PRIMARY KEY,
    location VARCHAR(100) NOT NULL,
    timing TIME NOT NULL,
    status ENUM('active', 'inactive') NOT NULL
);

-- Create Pass Transactions Table
CREATE TABLE Pass_Transactions (
    transaction_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    pass_id INT NOT NULL,
    transaction_date DATETIME NOT NULL,
    transaction_amount DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (pass_id) REFERENCES Digital_Transport_Passes(pass_id)
);
database
