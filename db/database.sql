-- Create Database
CREATE DATABASE GalleryCafe;
USE GalleryCafe;

-- Create Tables
CREATE TABLE Users (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    Email VARCHAR(100) UNIQUE,
    Phone VARCHAR(15) UNIQUE,
    Password VARCHAR(255) NOT NULL,
    UserType ENUM('Admin', 'Staff', 'Customer') NOT NULL,
    FullName VARCHAR(100)
);

CREATE TABLE Menu (
    MenuID INT AUTO_INCREMENT PRIMARY KEY,
    MenuName VARCHAR(100) NOT NULL,
    Description TEXT,
    Price DECIMAL(10, 2) NOT NULL,
    CuisineType VARCHAR(50) NOT NULL,
    ImageURL VARCHAR(255)
);

CREATE TABLE Reservations (
    ReservationID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT NOT NULL,
    ReservationDate DATE NOT NULL,
    ReservationTime TIME NOT NULL,
    TableCapacity INT NOT NULL,
    ParkingRequired ENUM('yes', 'no') NOT NULL,
    Message TEXT,
    Status ENUM('Pending', 'Confirmed', 'Completed', 'Cancelled') NOT NULL,
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);

CREATE TABLE PreOrders (
    PreOrderID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    MenuID INT,
    Quantity INT NOT NULL,
    OrderDate DATETIME NOT NULL,
    Status ENUM('Pending', 'Confirmed', 'Preparing', 'Ready', 'Completed', 'Cancelled') NOT NULL,
    OrderID VARCHAR(50) NOT NULL,
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (MenuID) REFERENCES Menu(MenuID)
);

CREATE TABLE SpecialEvents (
    EventID INT AUTO_INCREMENT PRIMARY KEY,
    EventName VARCHAR(100) NOT NULL,
    Description TEXT,
    EventDate DATETIME NOT NULL,
    ImageURL VARCHAR(255)
);

CREATE TABLE Promotions (
    PromotionID INT AUTO_INCREMENT PRIMARY KEY,
    PromotionName VARCHAR(100) NOT NULL,
    Description TEXT,
    StartDate DATE NOT NULL,
    EndDate DATE NOT NULL,
    ImageURL VARCHAR(255)
);

CREATE TABLE TableCapacities (
    TableID INT AUTO_INCREMENT PRIMARY KEY,
    Capacity INT NOT NULL,
    AvailabilityStatus ENUM('Available', 'Occupied') NOT NULL
);

CREATE TABLE ParkingAvailability (
    ParkingID INT AUTO_INCREMENT PRIMARY KEY,
    ParkingSpotNumber VARCHAR(50) NOT NULL,
    AvailabilityStatus ENUM('Available', 'Occupied') NOT NULL
);

CREATE TABLE ContactResponses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone_number VARCHAR(20),
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Subscribers (
    SubscriberID INT AUTO_INCREMENT PRIMARY KEY,
    Email VARCHAR(100) UNIQUE NOT NULL,
    SubscribedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);