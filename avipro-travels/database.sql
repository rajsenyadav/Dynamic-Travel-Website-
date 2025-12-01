-- Avipro Travels Database Schema
-- File: database.sql

CREATE DATABASE IF NOT EXISTS avipro_travels;
USE avipro_travels;

-- Admin Users Table
CREATE TABLE IF NOT EXISTS admin_users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    full_name VARCHAR(150) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Travel Packages Table
CREATE TABLE IF NOT EXISTS packages (
    id INT PRIMARY KEY AUTO_INCREMENT,
    package_name VARCHAR(200) NOT NULL,
    destination VARCHAR(150) NOT NULL,
    duration VARCHAR(50) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    description TEXT NOT NULL,
    itinerary TEXT,
    inclusions TEXT,
    exclusions TEXT,
    featured BOOLEAN DEFAULT FALSE,
    status ENUM('active', 'inactive') DEFAULT 'active',
    main_image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Package Images Table
CREATE TABLE IF NOT EXISTS package_images (
    id INT PRIMARY KEY AUTO_INCREMENT,
    package_id INT NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    image_order INT DEFAULT 0,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (package_id) REFERENCES packages(id) ON DELETE CASCADE
);

-- Bookings/Enquiries Table
CREATE TABLE IF NOT EXISTS bookings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    destination VARCHAR(150) NOT NULL,
    travel_date DATE NOT NULL,
    num_persons INT NOT NULL,
    message TEXT,
    package_id INT,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (package_id) REFERENCES packages(id) ON DELETE SET NULL
);

-- Site Settings Table
CREATE TABLE IF NOT EXISTS site_settings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    setting_key VARCHAR(100) UNIQUE NOT NULL,
    setting_value TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Contact Messages Table
CREATE TABLE IF NOT EXISTS contact_messages (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subject VARCHAR(200),
    message TEXT NOT NULL,
    status ENUM('unread', 'read') DEFAULT 'unread',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert Default Admin User (password: admin123)
INSERT INTO admin_users (username, password, email, full_name) 
VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@avipro.com', 'Administrator');

-- Insert Sample Site Settings
INSERT INTO site_settings (setting_key, setting_value) VALUES
('site_name', 'Avipro Travels'),
('site_tagline', 'Your Journey, Our Passion'),
('contact_email', 'info@avipro.com'),
('contact_phone', '+91 9876543210'),
('contact_address', 'Patna, Bihar, India'),
('about_content', 'Welcome to Avipro Travels - Your trusted travel partner for unforgettable journeys.'),
('hero_video', 'assets/videos/hero-banner.mp4'),
('about_image', 'assets/images/about-us.jpg');

-- Insert Sample Packages
INSERT INTO packages (package_name, destination, duration, price, description, itinerary, inclusions, exclusions, featured, main_image) VALUES
('Kashmir Paradise Tour', 'Kashmir', '6 Days / 5 Nights', 25000.00, 
'Experience the breathtaking beauty of Kashmir with our comprehensive tour package. Visit Dal Lake, Gulmarg, Pahalgam, and Sonamarg.',
'Day 1: Arrival in Srinagar\nDay 2: Srinagar Local Sightseeing\nDay 3: Gulmarg Excursion\nDay 4: Pahalgam Trip\nDay 5: Sonamarg Visit\nDay 6: Departure',
'Accommodation, Meals, Transport, Sightseeing',
'Flight tickets, Personal expenses, Adventure activities',
TRUE, 'assets/images/kashmir-main.jpg'),

('Goa Beach Holiday', 'Goa', '4 Days / 3 Nights', 18000.00,
'Enjoy sun, sand, and sea with our exciting Goa beach package. Perfect for families and groups.',
'Day 1: Arrival & Beach Visit\nDay 2: North Goa Tour\nDay 3: South Goa Exploration\nDay 4: Departure',
'Hotel stay, Breakfast, Sightseeing, Transfers',
'Lunch, Dinner, Water sports, Airfare',
TRUE, 'assets/images/goa-main.jpg'),

('Rajasthan Heritage Tour', 'Rajasthan', '7 Days / 6 Nights', 32000.00,
'Explore the royal heritage of Rajasthan with visits to Jaipur, Udaipur, Jodhpur, and Jaisalmer.',
'Day 1: Jaipur Arrival\nDay 2: Jaipur Sightseeing\nDay 3: Jodhpur\nDay 4: Jaisalmer\nDay 5: Desert Safari\nDay 6: Udaipur\nDay 7: Departure',
'Accommodation, All meals, Transport, Guide',
'Entry fees, Personal expenses',
FALSE, 'assets/images/rajasthan-main.jpg');