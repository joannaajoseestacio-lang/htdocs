# FoodApp (Vanilla PHP)

A simple e-commerce-style application built with **vanilla PHP**, TailwindCSS, and MySQL.
No frameworks, no Composer dependencies required.

## Setup

1. **Copy project to XAMPP**
   - Place the `foodapp` folder inside `xampp\htdocs`.
   - Ensure Apache & MySQL are running.

2. **Database**
   - Use phpMyAdmin or CLI to create a database named `foodapp`.
   - Run the SQL in `migrations/20260216_create_users_table.sql` to create the `users` table.
- (Optional) run `migrations/20260216_create_products_table.sql` to add a `products` table for staff operations.

3. **Environment variables (optional)**
   - Create a `.env` file based on `.env.example` at the root.
   - PHP will read it automatically if present.

6. **Staff area**
   - Users with the `staff` role can manage products after the
     `products` table has been created. They may create, edit, and delete
     items via the staff panel.
   - Product entries support an optional image. Uploaded files are stored in
     `/uploads` and the relative path is saved to the database.
     Ensure the `uploads` directory exists and is writable by PHP.
   - After adding products table, run `migrations/20260216_add_product_image_column.sql`
     if you need image support in an existing database.

7. **User profiles**
   - Registration now collects first name, last name, phone number, and
     photo instead of a single full name field.
   - The `users` table can be altered with
     `migrations/20260216_add_user_profile_columns.sql` to add these
     columns (photo optional).
   - Existing `name` column is no longer used; new installs may ignore it.
   - Staff and other users can update their profile on the **Account** page.

4. **Access the app**
   - Browse to: `http://localhost/foodapp/public/`

5. **Register / Login**
   - You can create users with roles: `student`, `staff`, or `admin`.

## File structure

- `public/` - front controller and public assets
- `src/functions.php` - database and authentication helpers
- `src/views/` - HTML templates with Tailwind
- `migrations/` - SQL file for table creation

## Notes

- No Composer; all code is loaded via `require_once`.
- Tailwind is pulled from CDN in each view.
- Role-based access handled by simple PHP functions.

Feel free to expand with products, cart, etc.!