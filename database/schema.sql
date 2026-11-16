-- NeonLoot database schema (MySQL)
CREATE DATABASE IF NOT EXISTS neonloot CHARACTER SET utf8mb4;
USE neonloot;

CREATE TABLE users (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(100) NOT NULL,
    email      VARCHAR(150) NOT NULL UNIQUE,
    password   VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE products (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(150) NOT NULL,
    category    VARCHAR(50)  NOT NULL,
    description TEXT,
    price       DECIMAL(10,2) NOT NULL,
    image       VARCHAR(255),
    stock       INT DEFAULT 0
);

CREATE TABLE orders (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    user_id    INT NOT NULL,
    total      DECIMAL(10,2) NOT NULL,
    address    VARCHAR(255) NOT NULL,
    status     VARCHAR(20) DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE order_items (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    order_id   INT NOT NULL,
    product_id INT NOT NULL,
    quantity   INT NOT NULL,
    price      DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id)   REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Sample products (image = URL of a free Pexels product photo, https://www.pexels.com/license/)
INSERT INTO products (name, category, description, price, image, stock) VALUES
('Spectra RGB Mechanical Keyboard', 'Peripherals', 'Hot-swappable mechanical switches with per-key RGB lighting and a detachable USB-C cable.', 3499.00, 'https://images.pexels.com/photos/3812048/pexels-photo-3812048.jpeg?auto=compress&cs=tinysrgb&w=600', 40),
('Phantom Lite Gaming Mouse', 'Peripherals', 'Ultra-light 58 g wireless mouse with a 26K DPI sensor and RGB underglow.', 1899.00, 'https://images.pexels.com/photos/28779687/pexels-photo-28779687.jpeg?auto=compress&cs=tinysrgb&w=600', 60),
('Nova Pro Gaming Headset', 'Audio', '7.1 surround sound, memory-foam ear cups and a detachable noise-cancelling mic.', 2799.00, 'https://images.pexels.com/photos/18441496/pexels-photo-18441496.jpeg?auto=compress&cs=tinysrgb&w=600', 35),
('Pulse Wireless Controller', 'Peripherals', 'Low-latency wireless controller with hall-effect sticks and customizable RGB ring.', 2499.00, 'https://images.pexels.com/photos/27424788/pexels-photo-27424788.jpeg?auto=compress&cs=tinysrgb&w=600', 50),
('Throne X Gaming Chair', 'Furniture', 'Ergonomic racing-style chair with lumbar support, 4D armrests and 180° recline.', 8999.00, 'https://images.pexels.com/photos/7862645/pexels-photo-7862645.jpeg?auto=compress&cs=tinysrgb&w=600', 12),
('Vortex 27" 165Hz Monitor', 'Displays', '27-inch QHD IPS panel, 165 Hz refresh rate and 1 ms response time.', 12499.00, 'https://images.pexels.com/photos/30469973/pexels-photo-30469973.jpeg?auto=compress&cs=tinysrgb&w=600', 15),
('Echo USB Streaming Mic', 'Audio', 'Plug-and-play condenser microphone with a tap-to-mute button and RGB gain ring.', 3299.00, 'https://images.pexels.com/photos/1841952/pexels-photo-1841952.jpeg?auto=compress&cs=tinysrgb&w=600', 25),
('Grid XL Desk Mat', 'Accessories', '900 × 400 mm stitched-edge desk mat with a smooth micro-weave surface.', 899.00, 'https://images.pexels.com/photos/30265373/pexels-photo-30265373.jpeg?auto=compress&cs=tinysrgb&w=600', 80);

-- Sample user: email demo@neonloot.com  /  password: password123
INSERT INTO users (name, email, password) VALUES
('Demo User', 'demo@neonloot.com', '$2y$10$S7fNKdalLJCTBaz2wDgoSuWJe4cASLl2Mi2U076GFJBYPl1g.J3U2');
