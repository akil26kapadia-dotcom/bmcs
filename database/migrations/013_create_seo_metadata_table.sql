CREATE TABLE IF NOT EXISTS seo_metadata (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    route_key VARCHAR(150) NOT NULL,
    meta_title VARCHAR(200) NULL,
    meta_description VARCHAR(300) NULL,
    canonical_url VARCHAR(255) NULL,
    og_title VARCHAR(200) NULL,
    og_description VARCHAR(300) NULL,
    og_image VARCHAR(255) NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY uq_seo_metadata_route (route_key)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
