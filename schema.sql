-- TABLE esgi_des utilisateurs
CREATE TABLE esgi_users (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    role_id INT,
    verification_token VARCHAR(255),
    email_verifie BOOLEAN DEFAULT FALSE,
    date_inserted TIME,
    date_updated TIME
);

-- TABLE esgi_des rôles
CREATE TABLE esgi_roles (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(255) UNIQUE NOT NULL,
    description TEXT
);

-- Add FOREIGN KEY
ALTER TABLE esgi_users ADD FOREIGN KEY (role_id) REFERENCES esgi_roles (id);

-- TABLE esgi_des pages
CREATE TABLE esgi_pages (
    id SERIAL PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    contenu TEXT,
    user_id INT NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_modification TIMESTAMP
);

-- Add FOREIGN KEY
ALTER TABLE esgi_pages ADD FOREIGN KEY (user_id) REFERENCES esgi_users (id);

-- TABLE esgi_des commentaires
CREATE TABLE esgi_comments (
    id SERIAL PRIMARY KEY,
    contenu TEXT,
    user_id INT NOT NULL,
    page_id INT NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    statut_moderation BOOLEAN DEFAULT FALSE
);

-- Add FOREIGN KEYs
ALTER TABLE esgi_comments ADD FOREIGN KEY (user_id) REFERENCES esgi_users (id);
ALTER TABLE esgi_comments ADD FOREIGN KEY (page_id) REFERENCES esgi_pages (id);

-- TABLE esgi_des menus
CREATE TABLE esgi_menus (
    id SERIAL PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    page_id INT,
    ordre INT NOT NULL
);

-- Add FOREIGN KEY
ALTER TABLE esgi_menus ADD FOREIGN KEY (page_id) REFERENCES esgi_pages (id);

-- TABLE esgi_des templates
CREATE TABLE esgi_templates (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description TEXT,
    couleur VARCHAR(7),
    police VARCHAR(255)
);

-- TABLE esgi_des SEO
CREATE TABLE esgi_seo (
    id SERIAL PRIMARY KEY,
    title VARCHAR(255),
    meta_description VARCHAR(255),
    page_id INT NOT NULL
);

-- Add FOREIGN KEY
ALTER TABLE esgi_seo ADD FOREIGN KEY (page_id) REFERENCES esgi_pages (id);
