USE bdd_7_4;
ALTER DATABASE bdd_7_4
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;
-- CREATE DATABASE gestion_running
-- CHARACTER SET utf8mb4
-- COLLATE utf8mb4_general_ci;


-- Table Utilisateur
CREATE TABLE Utilisateur (
    id_utilisateur INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    role ENUM('utilisateur', 'membre_association') DEFAULT 'utilisateur',
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table Membre (pour gérer les membres de l'association)
CREATE TABLE Membre (
    id_membre INT PRIMARY KEY AUTO_INCREMENT,
    utilisateur_id INT,
    date_promotion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (utilisateur_id) REFERENCES Utilisateur(id_utilisateur) ON DELETE CASCADE
);

-- Table Entrainement
CREATE TABLE Entrainement (
    id_entrainement INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    categorie VARCHAR(50) NOT NULL,
    date DATE NOT NULL,
    heure TIME NOT NULL,
    parcours_image VARCHAR(255),
    nb_max_participants INT NOT NULL,
    createur_id INT,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (createur_id) REFERENCES Membre(id_membre) ON DELETE SET NULL
);

-- Table Inscription (pour la relation n-n entre Utilisateur et Entrainement)
CREATE TABLE Inscription (
    id_inscription INT PRIMARY KEY AUTO_INCREMENT,
    utilisateur_id INT NOT NULL,
    entrainement_id INT NOT NULL,
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (utilisateur_id) REFERENCES Utilisateur(id_utilisateur) ON DELETE CASCADE,
    FOREIGN KEY (entrainement_id) REFERENCES Entrainement(id_entrainement) ON DELETE CASCADE,
    UNIQUE (utilisateur_id, entrainement_id) -- Un utilisateur ne peut s'inscrire qu'une seule fois à un entraînement
);

-- Table Photo (bonus)
CREATE TABLE Photo (
    id_photo INT PRIMARY KEY AUTO_INCREMENT,
    entrainement_id INT NOT NULL,
    photo_url VARCHAR(255) NOT NULL,
    date_ajout TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (entrainement_id) REFERENCES Entrainement(id_entrainement) ON DELETE CASCADE
);

-- Table Historique_Entrainement (bonus : pour suivre la participation des utilisateurs aux entraînements passés)
CREATE TABLE Historique_Entrainement (
    id_historique INT PRIMARY KEY AUTO_INCREMENT,
    utilisateur_id INT,
    entrainement_id INT,
    date_participation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (utilisateur_id) REFERENCES Utilisateur(id_utilisateur) ON DELETE CASCADE,
    FOREIGN KEY (entrainement_id) REFERENCES Entrainement(id_entrainement) ON DELETE SET NULL
);