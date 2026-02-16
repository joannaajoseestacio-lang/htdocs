-- Add store information fields to users table
ALTER TABLE `users` 
ADD COLUMN `store_cover_image` VARCHAR(255) DEFAULT NULL,
ADD COLUMN `gcash_number` VARCHAR(20) DEFAULT NULL,
ADD COLUMN `store_description` TEXT DEFAULT NULL;
