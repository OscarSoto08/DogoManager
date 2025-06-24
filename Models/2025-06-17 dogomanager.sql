DROP DATABASE IF EXISTS dogomanager;
CREATE DATABASE dogomanager;
USE dogomanager;

-- Tabla Admin
CREATE TABLE admin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  last_name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

-- Tabla Breed
CREATE TABLE breed (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  size VARCHAR(255) NOT NULL,
  is_active BOOLEAN DEFAULT TRUE
);

-- Tabla Owner
CREATE TABLE owner (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  last_name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
);

-- Tabla Walker
CREATE TABLE walker (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  last_name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  profile_picture VARCHAR(255) DEFAULT NULL,
  id_admin INT,
  is_active BOOLEAN DEFAULT TRUE,
  rate_per_hour DOUBLE,
  description VARCHAR(255),
  rating_avg FLOAT,
  FOREIGN KEY (id_admin) REFERENCES admin(id)
);

CREATE TABLE verify_code (
  id INT AUTO_INCREMENT PRIMARY KEY,
  code VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  expires_at TIMESTAMP DEFAULT (CURRENT_TIMESTAMP + INTERVAL 0.2 HOUR), -- 20 minutes
  user_id INT,
  FOREIGN KEY (user_id) REFERENCES owner(id) ON DELETE CASCADE
);

-- Tabla Place
CREATE TABLE place (
  id INT AUTO_INCREMENT PRIMARY KEY,
  place VARCHAR(255) NOT NULL
);

-- Tabla Puppy
CREATE TABLE puppy (
  id INT AUTO_INCREMENT PRIMARY KEY,
  owned_by INT,
  picture VARCHAR(255) DEFAULT NULL,
  birth_date DATE DEFAULT NULL,
  id_breed INT,
  FOREIGN KEY (owned_by) REFERENCES owner(id),
  FOREIGN KEY (id_breed) REFERENCES breed(id)
);

-- Tabla Walk
CREATE TABLE walk (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_walker INT,
  starts_at TIMESTAMP NULL,
  ends_at TIMESTAMP NULL,
  price DECIMAL(10,2) DEFAULT NULL,
  is_accepted BOOLEAN DEFAULT NULL,
  rating INT DEFAULT NULL,
  idPlace INT,
  FOREIGN KEY (id_walker) REFERENCES walker(id),
  FOREIGN KEY (idPlace) REFERENCES place(id)
);

-- Tabla Invoice
CREATE TABLE invoice (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_walk INT,
  total DECIMAL(10,2) DEFAULT NULL,
  created_at TIMESTAMP NULL,
  FOREIGN KEY (id_walk) REFERENCES walk(id)
);

-- Tabla WalkPuppy (relación muchos a muchos)
CREATE TABLE walkpuppy (
  walk_id INT,
  puppy_id INT,
  PRIMARY KEY (walk_id, puppy_id),
  FOREIGN KEY (walk_id) REFERENCES walk(id),
  FOREIGN KEY (puppy_id) REFERENCES puppy(id)
);

INSERT INTO admin (name, last_name, email, password) VALUES
('Oscar', 'Gonzalez', 'oscar@example.com', '827ccb0eea8a706c4c34a16891f84e7b'),
('Joan', 'Daniel', 'joan@example.com', '827ccb0eea8a706c4c34a16891f84e7b');
INSERT INTO breed (name, size) VALUES
('Labrador Retriever', 'Large'),
('French Bulldog', 'Medium'),
('Chihuahua', 'Small');
INSERT INTO owner (name, last_name, email, password, created_at, updated_at) VALUES
('Carlos', 'Ramirez', 'carlos1@mail.com', 'pass1', NOW(), NOW()),
('Laura', 'Martinez', 'laura2@mail.com', 'pass2', NOW(), NOW());
INSERT INTO walker (name, last_name, email, password, id_admin, is_active, rate_per_hour, description, rating_avg) VALUES
('Lauren', 'Alvarez', 'walker1@mail.com', 'pass1', 1, 1, 25000, 'Dog walker with 3 years experience', 4.5),
('Danny', 'Sharp', 'walker2@mail.com', 'pass2', 2, 1, 20000, 'Energetic and responsible', 4.0);
INSERT INTO place (place) VALUES
('Parque Simón Bolívar'),
('Parque El Virrey');
INSERT INTO puppy (owned_by, birth_date, id_breed) VALUES
(1, '2022-01-01', 1),
(2, '2021-06-06', 2);
INSERT INTO walk (id_walker, starts_at, ends_at, price, is_accepted, rating, idPlace) VALUES
(1, '2025-06-15 10:00:00', '2025-06-15 11:00:00', 20000.00, 1, 5, 1),
(2, '2025-06-16 09:30:00', '2025-06-16 10:30:00', 18000.00, 1, 4, 2);
INSERT INTO invoice (id_walk, total, created_at) VALUES
(1, 20000.00, '2025-06-15 12:00:00'),
(2, 18000.00, '2025-06-16 11:00:00');
INSERT INTO walkpuppy (walk_id, puppy_id) VALUES
(1, 1),
(2, 2);
UPDATE walker SET password = md5(password);
UPDATE owner SET password = md5(password);
