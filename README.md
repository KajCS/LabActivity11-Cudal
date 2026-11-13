# Barangay Bulletin – Purok Cudal

Barangay Bulletin is a small Laravel website for Barangay Emilio Jacinto, where barangay officials can post announcements like clean-up drives, health schedules and ayuda updates. Residents can browse the posts, search by title, filter by category, and open each post to read the full details.

**Lab Activity 10 – Eloquent, Migrations & Seeding**
<br>Ken Andrew Cudal · 4-334 Full-Stack Web Development

## Personalized details

- **Posts per page:** 6. My last name, Cudal, only has 5 letters, and the lab says to use 6 if the last name is shorter than 6 letters, so I used `paginate(6)`.
- **Custom category:** Livelihood. I picked this because barangays often post about livelihood programs and trainings for residents, like skills seminars or small business assistance.
- **Birthday post date:** March 15, 2026, used as the `published_at` of the pinned post "Purok Cudal Clean-up Drive".
- **Kagawad author:** Kagawad Ken Cudal (kagawad.cudal@bulletin.test)

## How to run

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
npm install
npm run dev
php artisan serve
```

Then open http://127.0.0.1:8000.