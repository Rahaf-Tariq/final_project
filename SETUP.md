# ShopHub E-Commerce Platform - Setup Guide

## Project Overview

ShopHub is a complete, fully functional e-commerce website built with Laravel 11, Bootstrap 5, Blade templates, MySQL, and Yajra DataTables. This platform includes a public storefront with product browsing, shopping cart, checkout, and a comprehensive admin panel for managing products, orders, users, and administrators.

## Key Features

### 🛍️ Public Features
- **Home Page**: Featured products showcase with hero banner
- **Products Page**: Advanced filtering (category, price range), sorting, and pagination (12 items per page)
- **Single Product Page**: Detailed product view with related products
- **Shopping Cart**: Session-based cart with add/remove/update functionality
- **Checkout**: Complete order form with shipping details and payment method selection
- **Contact Page**: Contact form with embedded Google Maps
- **User Authentication**: Registration and login system

### 👨‍💼 Admin Features
- **Dashboard**: Real-time statistics (products, orders, revenue, users)
- **Products Management**: Full CRUD with image upload and featured status
- **Orders Management**: View and update order status with order details
- **Order Items**: Detailed view of all order items
- **Users Management**: View user details and associated orders
- **Admins Management**: Add, edit, and delete admin accounts

### 📊 Technical Features
- **Multi-Guard Authentication**: Separate user and admin authentication
- **Yajra DataTables**: Server-side data processing with search, sort, pagination, and export (CSV, Excel, PDF)
- **Responsive Design**: Mobile-first Bootstrap 5 styling
- **Session-Based Cart**: Lightweight shopping cart using Laravel sessions
- **Database Relationships**: Proper Laravel ORM with eager loading

---

## Installation & Setup

### Prerequisites
- PHP 8.1+
- Laravel 11
- MySQL 5.7+
- Composer
- Node.js (for asset compilation)

### Step 1: Install Dependencies

```bash
composer install
npm install
```

### Step 2: Environment Configuration

The `.env` file is pre-configured. Key settings:

```env
APP_NAME=ShopHub
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=shophub
DB_USERNAME=root
DB_PASSWORD=

# Mail Configuration
MAIL_MAILER=log
MAIL_FROM_ADDRESS=hello@example.com
MAIL_FROM_NAME=ShopHub
```

### Step 3: Generate Application Key

```bash
php artisan key:generate
```

### Step 4: Run Migrations

```bash
php artisan migrate
```

This creates all necessary tables:
- `users` - Customer accounts
- `products` - Product catalog
- `orders` - Customer orders
- `order_items` - Order line items
- `contacts` - Contact form submissions
- `admins` - Admin accounts

### Step 5: Seed Database

```bash
php artisan db:seed
```

This populates:
- 10 sample products with varied prices and categories
- 2 admin accounts for testing
- 10 sample user accounts

### Step 6: Compile Assets

```bash
npm run dev
# or for production:
npm run build
```

### Step 7: Start Development Server

```bash
php artisan serve
```

Access the application at: `http://localhost:8000`

---

## Admin Dashboard Access

### Login Credentials

**Admin Account 1:**
- Email: `admin@example.com`
- Password: `password123`

**Admin Account 2:**
- Email: `superadmin@example.com`
- Password: `password123`

**Admin Login URL:** `http://localhost:8000/admin/login`

---

## Database Schema

### Users Table
```
- id (PK)
- name
- email (unique)
- password (hashed)
- role (user/admin)
- phone
- address
- timestamps
```

### Products Table
```
- id (PK)
- name
- slug (unique, URL-friendly)
- description
- price (decimal)
- sale_price (nullable decimal)
- stock (integer)
- category
- image (path to image file)
- is_featured (boolean)
- timestamps
```

### Orders Table
```
- id (PK)
- user_id (FK → users)
- total_amount (decimal)
- status (pending/processing/shipped/delivered/cancelled)
- payment_method (cod/credit_card)
- shipping_address
- timestamps
```

### Order_Items Table
```
- id (PK)
- order_id (FK → orders)
- product_id (FK → products)
- quantity (integer)
- unit_price (decimal - price at time of purchase)
- timestamps
```

### Contacts Table
```
- id (PK)
- name
- email
- subject
- message
- timestamps
```

### Admins Table
```
- id (PK)
- name
- email (unique)
- password (hashed)
- role
- remember_token
- timestamps
```

---

## Project Structure

```
final_project/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   ├── AuthenticatedSessionController.php
│   │   │   │   └── RegisteredUserController.php
│   │   │   ├── Admin/
│   │   │   │   ├── ProductController.php
│   │   │   │   ├── OrderController.php
│   │   │   │   ├── OrderItemController.php
│   │   │   │   ├── UserController.php
│   │   │   │   └── AdminController.php
│   │   │   ├── HomeController.php
│   │   │   ├── ProductController.php
│   │   │   ├── CartController.php
│   │   │   ├── CheckoutController.php
│   │   │   ├── ContactController.php
│   │   │   └── AdminLoginController.php
│   │   ├── Middleware/
│   │   │   └── IsAdmin.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Product.php
│   │   ├── Order.php
│   │   ├── OrderItem.php
│   │   ├── Contact.php
│   │   └── Admin.php
│   ├── DataTables/
│   │   ├── ProductDataTable.php
│   │   ├── OrderDataTable.php
│   │   ├── OrderItemDataTable.php
│   │   ├── UserDataTable.php
│   │   └── AdminDataTable.php
├── database/
│   ├── migrations/ (6 migration files)
│   ├── factories/
│   │   ├── UserFactory.php
│   │   └── ProductFactory.php
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/
│   ├── views/
│   │   ├── auth/
│   │   │   ├── login.blade.php
│   │   │   └── register.blade.php
│   │   ├── admin/
│   │   │   ├── login.blade.php
│   │   │   ├── dashboard.blade.php
│   │   │   ├── products/
│   │   │   ├── orders/
│   │   │   ├── order-items/
│   │   │   ├── users/
│   │   │   └── admins/
│   │   ├── checkout/
│   │   │   ├── index.blade.php
│   │   │   └── success.blade.php
│   │   ├── cart/
│   │   │   └── index.blade.php
│   │   ├── products/
│   │   │   ├── index.blade.php
│   │   │   └── show.blade.php
│   │   ├── contact/
│   │   │   └── index.blade.php
│   │   ├── profile/
│   │   │   └── edit.blade.php
│   │   ├── layouts/
│   │   │   ├── app.blade.php (public layout)
│   │   │   └── admin.blade.php (admin layout)
│   │   └── home.blade.php
│   └── css/
│       └── app.css
├── routes/
│   ├── web.php (main routes)
│   └── auth.php (auth routes)
├── public/
│   └── storage/ (for uploaded product images)
└── .env
```

---

## API Routes

### Public Routes

| Method | Route | Controller | Description |
|--------|-------|-----------|-------------|
| GET | / | HomeController@index | Home page with featured products |
| GET | /products | ProductController@index | Product listing with filters |
| GET | /products/{slug} | ProductController@show | Single product details |
| GET | /cart | CartController@index | View shopping cart |
| POST | /cart/add | CartController@add | Add item to cart |
| POST | /cart/remove | CartController@remove | Remove item from cart |
| POST | /cart/update | CartController@update | Update cart item quantity |
| POST | /cart/clear | CartController@clear | Clear entire cart |
| GET | /cart/badge | CartController (badge count) | Get cart item count |
| GET | /contact | ContactController@index | Contact form page |
| POST | /contact | ContactController@store | Submit contact form |

### Auth Routes (require login)

| Method | Route | Controller | Description |
|--------|-------|-----------|-------------|
| GET | /checkout | CheckoutController@index | Checkout page |
| POST | /checkout | CheckoutController@store | Process order |
| GET | /order-success/{id} | CheckoutController@success | Order confirmation page |

### Admin Routes (require admin authentication)

| Method | Route | Controller | Description |
|--------|-------|-----------|-------------|
| GET | /admin/login | AdminLoginController@showLoginForm | Admin login page |
| POST | /admin/login | AdminLoginController@login | Process admin login |
| POST | /admin/logout | AdminLoginController@logout | Admin logout |
| GET | /admin/dashboard | AdminDashboardController@index | Admin dashboard |
| GET/POST | /admin/products* | AdminProductController | Product CRUD |
| GET/POST | /admin/orders* | OrderController | Order management |
| GET | /admin/order-items | OrderItemController@index | View order items |
| GET/POST | /admin/users* | UserController | User management |
| GET/POST | /admin/admins* | AdminController | Admin management |

---

## Authentication System

### Multi-Guard Configuration

The application uses Laravel's multi-guard authentication system with two separate guards:

1. **Web Guard** - For customer users
   - Guard name: `web` (default)
   - Model: `App\Models\User`
   - Routes: `/login`, `/register`

2. **Admin Guard** - For administrators
   - Guard name: `admin`
   - Model: `App\Models\Admin`
   - Routes: `/admin/login`

### Usage in Controllers

```php
// Check authenticated user (web guard)
if (auth()->check()) { }

// Check authenticated admin
if (auth('admin')->check()) { }

// Get current user
auth()->user();

// Get current admin
auth('admin')->user();

// Login user
auth()->login($user);

// Login admin
auth('admin')->login($admin);
```

---

## Shopping Cart System

The shopping cart is stored in the Laravel session and persists across requests:

```php
// Cart Structure
session()->get('cart', [])
// Returns: [
//     product_id => [
//         'name' => 'Product Name',
//         'price' => 29.99,
//         'quantity' => 2,
//         'image' => 'path/to/image.jpg',
//         'slug' => 'product-slug'
//     ]
// ]
```

### Cart Operations

1. **Add to Cart**: POST `/cart/add` with `product_id` and `quantity`
2. **Remove from Cart**: POST `/cart/remove` with `product_id`
3. **Update Quantity**: POST `/cart/update` with `product_id` and `quantity`
4. **Clear Cart**: POST `/cart/clear`

---

## Admin DataTables

All admin tables use Yajra DataTables with the following features:

### Features
- ✅ Server-side processing (efficient for large datasets)
- ✅ Global search across all columns
- ✅ Individual column sorting
- ✅ Pagination (customizable per page)
- ✅ Export to CSV, Excel, PDF
- ✅ Print functionality
- ✅ Column visibility toggle

### DataTable Classes

Located in `app/DataTables/`:
- `ProductDataTable.php` - Products management
- `OrderDataTable.php` - Orders management
- `OrderItemDataTable.php` - Order items view
- `UserDataTable.php` - Users management
- `AdminDataTable.php` - Admins management

---

## Styling & Design

### Color Scheme
- **Primary Color**: #6C63FF (Purple)
- **Sidebar Background**: #1e1e2e (Dark)
- **Success**: #198754 (Green)
- **Warning**: #ffc107 (Yellow)
- **Danger**: #dc3545 (Red)
- **Info**: #0dcaf0 (Cyan)

### CSS Framework
- **Bootstrap 5.3**: Responsive grid and components
- **FontAwesome 6.4**: Icon library
- **Custom CSS**: In `resources/css/app.css`

### Responsive Breakpoints
- Mobile (xs): < 576px
- Tablet (md): ≥ 768px
- Desktop (lg): ≥ 992px
- Wide (xl): ≥ 1200px

---

## Payments & Order Processing

### Payment Methods (Currently Static)
1. **Cash on Delivery (COD)** - Default option
2. **Credit Card** - Coming soon (placeholder)

### Order Workflow
1. Customer adds items to cart
2. Proceeds to checkout
3. Fills in shipping details
4. Selects payment method
5. Submits order
6. System creates:
   - Order record with status: `pending`
   - OrderItem records for each cart item
   - Decrements product stock
   - Clears shopping cart
7. Customer sees success page

### Order Status Flow
- `pending` → `processing` → `shipped` → `delivered`
- Can be cancelled at any point

---

## Email Configuration

To enable email notifications, update `.env`:

```env
# For Gmail
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_ENCRYPTION=tls

# For other SMTP providers
MAIL_MAILER=smtp
MAIL_HOST=mail.example.com
MAIL_PORT=587
MAIL_USERNAME=your-username
MAIL_PASSWORD=your-password
MAIL_FROM_ADDRESS=hello@example.com
MAIL_ENCRYPTION=tls
```

---

## File Uploads

### Product Images
- **Storage Location**: `storage/app/public/products/`
- **Acceptable Formats**: JPEG, PNG, JPG, GIF
- **Max File Size**: 2MB
- **Access URL**: `/storage/products/filename.jpg`

### Enabling Public Storage
```bash
php artisan storage:link
```

---

## Common Tasks

### Add a New Admin User
1. Go to `/admin/dashboard`
2. Click "Add Admin" button
3. Fill in details and submit
4. New admin can login with provided credentials

### Feature a Product
1. Go to `/admin/products`
2. Edit desired product
3. Check "Mark as Featured" checkbox
4. Save

### Update Order Status
1. Go to `/admin/orders`
2. Click "View" on order
3. Change status in dropdown
4. Status updates automatically

### Export Data
1. Open any admin DataTable
2. Click export button (CSV, Excel, PDF, or Print)
3. File downloads automatically

---

## Troubleshooting

### Issue: Migrations Fail
**Solution:**
```bash
php artisan migrate:fresh --seed
```

### Issue: Storage Folder Not Found
**Solution:**
```bash
php artisan storage:link
```

### Issue: Admin Can't Login
**Solution:**
- Verify admin credentials in `admins` table
- Check if admin guard is properly configured in `config/auth.php`

### Issue: Cart Items Not Persisting
**Solution:**
- Check if session driver is configured correctly
- Verify SESSION_DRIVER=file or database in `.env`

### Issue: Products Images Not Showing
**Solution:**
```bash
php artisan storage:link
# Check if image paths are correctly stored in products table
```

---

## Performance Optimization

### Implemented
✅ Server-side DataTables processing
✅ Eager loading relationships
✅ Database indexing on foreign keys
✅ Pagination (12 products per page)
✅ Asset minification

### Recommendations for Production
- Use CDN for static assets
- Enable query caching
- Implement product image optimization
- Use Redis for session/cache
- Enable database query caching
- Set up proper logging
- Enable GZIP compression

---

## Security Best Practices

### Implemented
✅ CSRF protection on all forms
✅ Password hashing with bcrypt
✅ Multi-guard authentication
✅ Admin middleware authorization
✅ Validation on all inputs
✅ SQL injection prevention (Eloquent ORM)

### Additional Measures for Production
- Use HTTPS only
- Enable rate limiting
- Implement API token authentication
- Add 2FA for admin accounts
- Regular security audits
- Keep dependencies updated

---

## Contact & Support

For issues or feature requests, contact the development team.

---

## License

This project is provided as-is for educational and commercial purposes.

**Version**: 1.0.0  
**Last Updated**: May 3, 2026
