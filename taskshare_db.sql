-- Buat database
CREATE DATABASE IF NOT EXISTS taskshare_db;
USE taskshare_db;

-- Tabel: tasks
CREATE TABLE IF NOT EXISTS tasks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  deadline DATE NOT NULL,
  status ENUM('pending', 'completed') DEFAULT 'pending',
  category VARCHAR(100) NOT NULL
);

-- Contoh data: tasks
INSERT INTO tasks (title, deadline, status, category) VALUES
('Belajar Matematika', '2025-06-13', 'pending', 'Matematika'),
('Tugas Fisika', '2025-06-15', 'completed', 'Fisika'),
('Baca Buku Sejarah', '2025-06-20', 'pending', 'Sejarah'),
('Proyek Informatika', '2025-06-25', 'pending', 'Informatika'),
('Latihan Soal Kimia', '2025-06-17', 'pending', 'Kimia');

-- Tabel: tugas_teman
CREATE TABLE IF NOT EXISTS tugas_teman (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  deadline DATE NOT NULL,
  category VARCHAR(100) NOT NULL
);

-- Contoh data: tugas_teman
INSERT INTO tugas_teman (title, deadline, category) VALUES
('Resume Biologi', '2025-06-14', 'Biologi'),
('Artikel Bahasa Inggris', '2025-06-19', 'Bahasa Inggris'),
('Rangkuman Ekonomi', '2025-06-21', 'Ekonomi'),
('Kuis PKN', '2025-06-22', 'PKN');

-- Tabel: user
CREATE TABLE IF NOT EXISTS user (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  password VARCHAR(255)
);