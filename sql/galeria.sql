CREATE DATABASE IF NOT EXISTS galeria_livros;
USE galeria_livros;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL -- armazenada com password_hash()
);

CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL
);

CREATE TABLE livros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    autor VARCHAR(100),
    categoria_id INT NULL,
    imagem VARCHAR(255),
    descricao TEXT,
    id_usuario INT, -- quem cadastrou
    FOREIGN KEY (categoria_id) REFERENCES categorias(id),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);
INSERT INTO usuarios (nome, email, senha) VALUES 
('Admin', 'admin@admin.com', '$2y$12$auTVVtFyvLNxb9BH3KuXiOevRj82ahbpiLg3d0O0.iyMc.NzaVFJi'),
('Heverton', 'heverton@gmail.com', '$2y$12$auTVVtFyvLNxb9BH3KuXiOevRj82ahbpiLg3d0O0.iyMc.NzaVFJi'),
('Caio', 'caio@gmail.com', '$2y$12$auTVVtFyvLNxb9BH3KuXiOevRj82ahbpiLg3d0O0.iyMc.NzaVFJi');

INSERT INTO categorias (nome) VALUES 
('Fantasia'),
('Ficção Científica'),
('Romance'),
('Biografia');

INSERT INTO livros (titulo, autor, categoria_id, imagem, descricao, id_usuario) VALUES 
("O senhor dos anéis: Volume único", "J.R.R. Tolkien", 1, "https://m.media-amazon.com/images/I/71ZLavBjpRL._SY385_.jpg", "Um clássico da literatura fantástica", 2),
("Harry Potter e a Pedra Filosofal", "J.K. Rowling", 1, "https://m.media-amazon.com/images/I/81aOJM2a2sL._SL1500_.jpg", "Um mago e seu mundo mágico", 2),
("O guia do mochileiro das galáxias", "Douglas Adams", 2, "https://m.media-amazon.com/images/I/91NAJgaUlKL._SL1500_.jpg", "Um guia para viajantes intergaláticos", 3),
("Romeu e Julieta", "William Shakespeare", 3, "https://m.media-amazon.com/images/I/71C4f7ZlpfL._SL1200_.jpg", "Um drama de amor trágico", 1),
("A culpa é das estrelas", "John Green", 3, "https://m.media-amazon.com/images/I/51M9IbBqxCL._SL1000_.jpg", "Uma história de amor e perda", 3),
("O Diário de Anne Frank", "Anne Frank", 4, "https://m.media-amazon.com/images/I/81Qn4d3sCLL._SL1500_.jpg", "O diário de uma jovem judia durante o Holocausto", 1),
("Duna", "Frank Herbert", 2, "https://m.media-amazon.com/images/I/81zN7udGRUL._SL1500_.jpg", "Uma epopeia científica e política", 3),
("O Conjurador: O Aprendiz", "Taran Matharu", 1, "https://m.media-amazon.com/images/I/91K4XrzIUiL._SL1500_.jpg", "Um jovem aprendendo a ser um conjurador", 2);
