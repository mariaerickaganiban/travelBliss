-- DROP DATABASE travelbliss;
-- CREATE DATABASE travelbliss;
-- USE travelbliss;

-- Admin Table
CREATE TABLE admins (
	admin_id INT AUTO_INCREMENT PRIMARY KEY,
    f_name VARCHAR(50) NOT NULL,
    l_name VARCHAR(50) NOT NULL,
    a_username VARCHAR(50) UNIQUE NOT NULL,
    a_password VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT NOW()
);
INSERT INTO admins (f_name, l_name, a_username, a_password)
VALUES ('Neariah', 'Magtalas', 'Neariah.Magtalas.08', 'Ne08Magtalas'),
('Ericka', 'Ganiban', 'Ericka.Ganiban.01', 'Er01Ganiban');

-- User Table
CREATE TABLE users (
	user_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    middle_name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    phone_number VARCHAR(50) NOT NULL,
	gender VARCHAR(50) NOT NULL CHECK (gender IN ('Male', 'Female', 'Prefer not to say')),
    user_username VARCHAR(50),
    user_password VARCHAR(50),
    created_at TIMESTAMP DEFAULT NOW()
);

INSERT INTO users (first_name, last_name, middle_name, email, phone_number, gender, user_username, user_password)
VALUES 
	('Mae', 'Solis', 'F', 'mae_solis@gmail.com', '09154457789', 'Female', 'M.Solis.01', 'Ma01Solis'),
    ('Mark', 'Bautista', 'A', 'mark_bautista@gmail.com', '09629986645', 'Male', 'M.Bautista.02', 'Ma02Bautista');

-- Orders/Ticketing/Reservations Table
CREATE TABLE reservations (
	reservations_no INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    origin VARCHAR(50) NOT NULL, CHECK (origin IN ('Manila', 'Iriga', 'Sorsogon', 'Clark, Pampanga', 'Baguio', 'Naga', 'El Nido', 'Puerto Prinses', 'Baler', 'Legazpi', 'Leyte', 'Iloilo', 'Davao', 'Kalibo/Caticlan Airport', 'Boracay')),
    destination VARCHAR(50) NOT NULL, CHECK (destination IN ('Manila', 'Iriga', 'Sorsogon', 'Clark, Pampanga', 'Baguio', 'Naga', 'El Nido', 'Puerto Prinses', 'Baler', 'Legazpi', 'Leyte', 'Iloilo', 'Davao', 'Kalibo/Caticlan Airport', 'Boracay')),
    s_class VARCHAR(50) NOT NULL, CHECK (s_class IN ('Deluxe', 'Premiere', 'Executive')),
	FOP VARCHAR(50) NOT NULL, CHECK (FOP IN ('Cash', 'GCash', 'PayMaya', 'Debit Card')),
    fare VARCHAR(50) NOT NULL,
    ticket_status VARCHAR(50) NOT NULL DEFAULT 'Pending for Payment', CHECK (ticket_status IN ('Paid', 'Pending for Payment', 'Complete travel')),
    traveldate DATE, 
    created_at TIMESTAMP DEFAULT NOW(),
    FOREIGN KEY(user_id) REFERENCES users(user_id)
    ON DELETE CASCADE
);



