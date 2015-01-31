CREATE TABLE icbac_thoughtcast (
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id INTEGER NOT NULL,
    date DATE DEFAULT NULL,
    content TEXT DEFAULT NULL,
    title VARCHAR(255) NOT NULL,
    excerpt VARCHAR(255) NOT NULL,
    status INT(3) NOT NULL DEFAULT 0,
    priority VARCHAR(50) NOT NULL,
    menu_name VARCHAR(128) NOT NULL,
    category_id INT(10) NOT NULL, 
    
);
CREATE TABLE icbac_meta_values (
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    cast_id INTEGER NOT NULL,
    meta_key VARCHAR(255) NOT NULL,
    metavalue LONGTEXT NOT NULL
);
CREATE TABLE icbac_category (
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    category_name VARCHAR(255) NOT NULL,
    category_slug VARCHAR(255) NOT NULL,
    parent_id VARCHAR(255) NOT NULL,
);
CREATE TABLE icbac_user (
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(128) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(128) NOT NULL,
    token VARCHAR(255) DEFAULT NULL
);
