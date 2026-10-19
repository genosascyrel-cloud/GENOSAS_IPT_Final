# Pet Clinic Management System (Laravel Final Project)

Manage pet owners, their pets, veterinarians, appointments and the treatments given during each visit.

## Database (exactly 5 tables)
| Table | Key columns | Relationships |
|---|---|---|
| `owners` | first_name, last_name, email (unique), phone, address | hasMany pets |
| `veterinarians` | name, specialization, license_number (unique), phone, email | hasMany appointments |
| `pets` | owner_id, name, species, breed, sex, birth_date, weight_kg | belongsTo owner; hasMany appointments |
| `appointments` | pet_id, veterinarian_id, appointment_date, reason, status, notes | belongsTo pet & veterinarian; hasMany treatments |
| `treatments` | appointment_id, name, notes, cost | belongsTo appointment |

Data integrity
- Owner with pets and veterinarian with appointments cannot be deleted (restrict FK + friendly error message).
- Deleting a pet cascades to its appointments and their treatments; deleting an appointment cascades to its treatments.
- A veterinarian cannot be double-booked at the same date/time (validation); new bookings must be in the future.

## Setup (PHP 8.2+, Composer, MySQL / XAMPP)
```bash
composer create-project laravel/laravel pet-clinic
# copy EVERYTHING from this folder into pet-clinic/ and MERGE/overwrite (do not replace whole folders!)
cd pet-clinic
php install.php                 # sets .env for MySQL, removes default migrations/User model
# create an empty MySQL database named: pet_clinic   (phpMyAdmin)
composer dump-autoload
php artisan migrate:fresh --seed
php artisan serve               # http://127.0.0.1:8000
```

## GitHub + CASTLY
```bash
git init
git add .
git commit -m "Pet Clinic Management System - Laravel final project"
git branch -M main
git remote add origin https://github.com/<your-username>/pet-clinic.git
git push -u origin main
```
Then paste the repository URL into the CASTLY submission field. `.env` stays out of Git; `.env.example` is committed.

## Where things are
Migrations `database/migrations` · Models `app/Models` · Controllers `app/Http/Controllers` · Routes `routes/web.php`
Views `resources/views` (layout + components + 5 modules) · Factories `database/factories` · Seeders `database/seeders`
