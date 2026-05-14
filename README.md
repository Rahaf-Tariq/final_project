# ⌚ LUXÉ CHRONO

A full-featured luxury watch ecommerce web application built with Laravel 12, dual-guard authentication, and SQLite.

**Demo Video:**
https://drive.google.com/file/d/1eKxlgHpmZqeGIqRTNJtAQDTFCrEZzc1p/view?usp=sharing

**Repository:**
https://github.com/Rahaf-Tariq/final_project

---

## Tech Stack

| Layer          | Technology                            |
| -------------- | ------------------------------------- |
| Backend        | Laravel 12 (PHP 8.2+)                 |
| Frontend       | Blade Templates + Vite                |
| Authentication | Laravel Dual Guard (Customer + Admin) |
| Database       | SQLite                                |
| Admin Tables   | Yajra DataTables                      |
| Styling        | Bootstrap 5.3 + Font Awesome 6.4      |

---

## Features

### Customer Side

- Home page with 6 featured luxury watches
- Product listing with category, price & sort filters
- Product detail page with related products
- Shopping cart (session-based)
- Checkout & order placement (Cash on Delivery / Credit Card)
- Order success confirmation page
- Contact form
- User registration & login

### Admin Panel (`/admin`)

- Dashboard with total products, orders, revenue & users
- Product management — Create, Edit, Delete, image upload
- Order management — view & update order status
- User management — view users & order history
- Admin accounts management — full CRUD
- Contact messages — view submissions

---

## Installation

**1. Clone the repository**

```bash
git clone https://github.com/Rahaf-Tariq/final_project.git
cd final_project
```

**2. Install dependencies**

```bash
composer install
npm install
```

**3. Environment setup**

```bash
cp .env.example .env
php artisan key:generate
```

**4. Configure `.env`**

```env
APP_NAME="LUXE CHRONO"
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
```

**5. Create the SQLite database file**

```bash
touch database/database.sqlite
```

**6. Run migrations & seeders**

```bash
php artisan migrate --seed
```

**7. Storage link**

```bash
php artisan storage:link
```

**8. Build frontend & run**

```bash
npm run dev
php artisan serve
```

App will be available at: **http://localhost:8000**

---

## Database Tables

| Table         | Description                                |
| ------------- | ------------------------------------------ |
| `users`       | Registered customers                       |
| `admins`      | Admin accounts (separate table & guard)    |
| `products`    | Watch info, price, stock, image, slug      |
| `orders`      | Customer orders with shipping & status     |
| `order_items` | Individual items per order with unit price |
| `contacts`    | Messages submitted via contact form        |

---

## Admin Access

After seeding, login at `/admin/login` with:

```
Email:    admin@example.com
Password: password123
```

---

## Project Structure

```
final_project/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Admin panel controllers
│   │   │   ├── Auth/           # Login & Register controllers
│   │   │   ├── CartController.php
│   │   │   ├── CheckoutController.php
│   │   │   ├── HomeController.php
│   │   │   ├── ProductController.php
│   │   │   └── ContactController.php
│   │   └── Middleware/
│   │       └── IsAdmin.php     # Admin route guard
│   ├── DataTables/             # Yajra DataTable classes
│   └── Models/                 # Eloquent models
├── database/
│   ├── migrations/             # Table blueprints
│   ├── seeders/                # Test data seeders
│   ├── factories/              # Fake data factories
│   └── database.sqlite         # SQLite database file
├── resources/
│   └── views/
│       ├── layouts/            # Master layout files
│       ├── admin/              # Admin panel views
│       ├── products/
│       ├── cart/
│       └── checkout/
├── routes/
│   ├── web.php                 # All application routes
│   └── auth.php                # Auth routes
└── storage/
    └── app/public/products/    # Uploaded product images
```

---

## License

This project is open-source and available under the [MIT License](LICENSE).
