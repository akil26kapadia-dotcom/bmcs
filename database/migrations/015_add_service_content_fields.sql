ALTER TABLE services
    ADD COLUMN technologies VARCHAR(255) NULL AFTER description,
    ADD COLUMN capabilities JSON NULL AFTER technologies,
    ADD COLUMN benefits JSON NULL AFTER capabilities,
    ADD COLUMN applications JSON NULL AFTER benefits,
    ADD COLUMN faq JSON NULL AFTER applications;
