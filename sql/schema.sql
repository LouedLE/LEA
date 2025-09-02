-- Schéma MySQL minimal pour LEA Web Creation (version simple)
CREATE DATABASE IF NOT EXISTS leaweb CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE leaweb;

CREATE TABLE IF NOT EXISTS services (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(160) NOT NULL,
  excerpt TEXT NOT NULL,
  price VARCHAR(60) NOT NULL,
  position INT NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS reviews (
  id INT AUTO_INCREMENT PRIMARY KEY,
  author VARCHAR(120) NOT NULL,
  rating TINYINT NOT NULL CHECK (rating BETWEEN 1 AND 5),
  content TEXT NOT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS quotes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(190) NOT NULL,
  message TEXT NOT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO services (title, excerpt, price, position) VALUES
('Site vitrine essentiel', 'Une page propre et responsive.', '499€', 1),
('Vitrine + (3-5 pages)', 'Services, À propos, Contact.', '990€', 2)
ON DUPLICATE KEY UPDATE title=VALUES(title);

INSERT INTO reviews (author, rating, content) VALUES
('Julie', 5, 'Simple et efficace !'),
('Thomas', 4, 'Rapide à mettre en place.');