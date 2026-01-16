-- Creació de la base de dades
DROP DATABASE IF EXISTS pokemon_v2;
CREATE DATABASE pokemon_v2 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE pokemon_v2;

-- 1. Taula de Rols
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    description TEXT
) ENGINE=InnoDB;

-- 2. Taula d'Usuaris
CREATE TABLE usuaris (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role_id INT NOT NULL,
    birth_date DATE NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES roles(id)
) ENGINE=InnoDB;

-- 3. Taula de Pokemon
CREATE TABLE pokemon (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pokedex_num INT NOT NULL UNIQUE,
    name VARCHAR(50) NOT NULL,
    type1 VARCHAR(20) NOT NULL,
    type2 VARCHAR(20) DEFAULT NULL,
    height DECIMAL(5,2) NOT NULL,
    weight DECIMAL(6,2) NOT NULL,
    sprite VARCHAR(255)
) ENGINE=InnoDB;

-- 4. Taula de Captures
CREATE TABLE captures (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    pokemon_id INT NOT NULL,
    nickname VARCHAR(50) DEFAULT NULL,
    captured_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    level INT DEFAULT 1,
    is_on_team BOOLEAN DEFAULT FALSE,
    pokeball ENUM('pokeball', 'greatball', 'ultraball', 'masterball') DEFAULT 'pokeball',
    FOREIGN KEY (user_id) REFERENCES usuaris(id) ON DELETE CASCADE,
    FOREIGN KEY (pokemon_id) REFERENCES pokemon(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- DADES D'EXEMPLE

INSERT INTO roles (name, description) VALUES 
('admin', 'Administrador del sistema amb accés total.'),
('trainer', 'Usuari estàndard amb límit de 3 Pokémon.'),
('vip', 'Usuari prèmium amb límit de 6 Pokémon.');

-- Inserir Usuaris
-- Passwords hashos generats via script (BCRYPT)
-- ash_ketchum: pika123
-- gary_oak: smellyalater
-- professor_oak: research
-- vip_user: vip123

INSERT INTO usuaris (username, email, password, role_id, birth_date) VALUES 
('ash_ketchum', 'ash@pokemon.com', '$2y$10$IqnwkoVlAZWOmVP9PBR79OuQ9MB94fKV6kopwBL4jdf8nv96eAV3y', 2, '2010-05-22'),
('gary_oak', 'gary@pokemon.com', '$2y$10$jnX2jcg7hbVNPjOxf46OpOtxG4qyIs.zkE9A0/tj7tqAA/dOPpIaa', 2, '2010-04-10'),
('professor_oak', 'oak@pokemon.com', '$2y$10$9w7vJj7c8ao19AXX6XUjruCSAz9A378VmvImfNmd7z4COfAAekaf6', 1, '1960-01-01'),
('vip_user', 'vip@pokemon.com', '$2y$10$UlbfFQdBe3To0he5vcPvNuPBHV5EQHwyWdYwNOxVJHw2QcDmqhjhG', 3, '2000-01-01');

INSERT INTO pokemon (pokedex_num, name, type1, type2, height, weight, sprite) VALUES 
(1, 'bulbasaur', 'grass', 'poison', 0.7, 6.9, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/1.png'),
(4, 'charmander', 'fire', NULL, 0.6, 8.5, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/4.png'),
(7, 'squirtle', 'water', NULL, 0.5, 9.0, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/7.png'),
(25, 'pikachu', 'electric', NULL, 0.4, 6.0, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/25.png'),
(150, 'mewtwo', 'psychic', NULL, 2.0, 122.0, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/150.png'),
(152, 'chikorita', 'grass', NULL, 0.9, 6.4, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/152.png'),
(158, 'totodile', 'water', NULL, 0.6, 9.5, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/158.png'),
(155, 'cyndaquil', 'fire', NULL, 0.5, 7.9, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/155.png'),
(384, 'rayquaza', 'dragon', 'flying', 7.0, 206.5, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/384.png'),
(132, 'ditto', 'normal', NULL, 0.3, 4.0, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/132.png');

INSERT INTO captures (user_id, pokemon_id, nickname, captured_at, level, is_on_team, pokeball) VALUES 
(1, 4, 'Pikapi', '2023-01-01 10:00:00', 50, TRUE, 'pokeball'),
(1, 1, 'Bulby', '2023-01-02 11:30:00', 32, TRUE, 'greatball'),
(1, 7, NULL, '2023-01-03 09:15:00', 15, TRUE, 'pokeball'),
(2, 7, 'Shellshocker', '2023-01-01 10:05:00', 52, TRUE, 'ultraball'),
(2, 5, 'MyMewtwo', '2023-12-25 00:00:01', 70, TRUE, 'masterball'),
(3, 10, 'TestSubject1', '2020-05-01 08:00:00', 10, FALSE, 'pokeball');
