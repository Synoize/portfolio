-- Portfolio Database Schema

-- Create Database
CREATE DATABASE IF NOT EXISTS if0_42013005_portfolio_db;
USE if0_42013005_portfolio_db;

-- Messages Table (for contact form)
CREATE TABLE IF NOT EXISTS messages (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    subject VARCHAR(255) NOT NULL,
    message LONGTEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_read BOOLEAN DEFAULT FALSE
);

-- Projects Table
CREATE TABLE IF NOT EXISTS projects (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    category VARCHAR(100) NOT NULL DEFAULT 'Web',
    description LONGTEXT NOT NULL,
    image_url VARCHAR(500),
    url VARCHAR(500),
    github_url VARCHAR(500),
    technologies VARCHAR(500),
    status ENUM('active', 'completed', 'archived') DEFAULT 'active',
    featured BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Services Table
CREATE TABLE IF NOT EXISTS services (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    category VARCHAR(100) NOT NULL DEFAULT 'Web',
    description LONGTEXT NOT NULL,
    image_url VARCHAR(500),
    icon VARCHAR(255),
    order_by INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Works/Case Studies Table
CREATE TABLE IF NOT EXISTS works (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    category VARCHAR(100) NOT NULL DEFAULT 'Web',
    description LONGTEXT NOT NULL,
    image_url VARCHAR(500),
    technologies VARCHAR(500),
    url VARCHAR(500),
    case_study LONGTEXT,
    featured BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Skills Table
CREATE TABLE IF NOT EXISTS skills (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    category VARCHAR(100) NOT NULL,
    proficiency INT DEFAULT 80,
    order_by INT DEFAULT 0
);

-- Experience Table
CREATE TABLE IF NOT EXISTS experience (
    id INT PRIMARY KEY AUTO_INCREMENT,
    company_name VARCHAR(255) NOT NULL,
    position VARCHAR(255) NOT NULL,
    description LONGTEXT,
    start_date DATE NOT NULL,
    end_date DATE,
    is_current BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Social Links Table
CREATE TABLE IF NOT EXISTS social_links (
    id INT PRIMARY KEY AUTO_INCREMENT,
    platform VARCHAR(50) NOT NULL,
    url VARCHAR(500) NOT NULL,
    icon_class VARCHAR(100)
);

-- Site Settings Table
CREATE TABLE IF NOT EXISTS site_settings (
    setting_key VARCHAR(100) PRIMARY KEY,
    setting_value LONGTEXT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Admin Users Table
CREATE TABLE IF NOT EXISTS admin_users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login_at TIMESTAMP NULL
);

-- Create indexes for better performance
CREATE INDEX idx_messages_email ON messages(email);
CREATE INDEX idx_messages_created ON messages(created_at);
CREATE INDEX idx_projects_category ON projects(category);
CREATE INDEX idx_projects_featured ON projects(featured);
CREATE INDEX idx_services_category ON services(category);
CREATE INDEX idx_works_category ON works(category);
CREATE INDEX idx_works_featured ON works(featured);
CREATE INDEX idx_skills_category ON skills(category);
CREATE INDEX idx_experience_company ON experience(company_name);

-- Default admin login:
-- username: admin
-- password: admin123
-- Change this password before using the site in production.
INSERT INTO admin_users (username, password_hash, name) VALUES
('admin', '$2y$10$BnQQof/8OGnjNAfs5/JncOTaOYFibdtqwY.N6TFelkem6LKNLKSuS', 'Website Admin')
ON DUPLICATE KEY UPDATE username = username;
