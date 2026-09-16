ALTER TABLE service_categories
    ADD COLUMN capabilities JSON NULL AFTER description,
    ADD COLUMN benefits JSON NULL AFTER capabilities,
    ADD COLUMN applications JSON NULL AFTER benefits,
    ADD COLUMN faq JSON NULL AFTER applications;
