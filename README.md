# 🛠️ Allizo – Service Provider Platform API

Allizo is a powerful RESTful API built with Laravel that connects users with a variety of local services. The backend supports full user management, secure authentication, service booking, reviews, wishlist, carts, and role-based access control. Perfect for platforms offering appointment-based or freelance services.

---

## 🚀 Features

- 🔐 **User Authentication** (Login, Register, Logout)
- 👤 **User & Role Management** (Admin/User privileges)
- 🛠️ **Service CRUD** (Create, View, Update, Delete services)
- 🗂️ **Categories** to organize services
- 🗺️ **Location Management** for users/services
- ❤️ **Wishlist System** to save favorite services
- 🛒 **Cart System** for pre-booking services
- 📅 **Booking Management** with multiple services
- 📝 **Review System** for services
- 🔄 **Assign & Remove Roles** to/from users

---

## 📂 API Structure

```bash
# Auth
POST    /user/login
POST    /user/register
DELETE  /user/logout

# Users
GET     /allizo/users
POST    /allizo/users
...

# Roles
GET     /allizo/roles
POST    /allizo/users/{userId}/roles/{roleId}
...

# Services
GET     /allizo/services
POST    /allizo/services
...

# Carts
POST    /allizo/cart/{cartId}/service
DELETE  /allizo/cart/{cartId}/service

# Wishlists
POST    /allizo/wishlist/{wishlistId}/service
DELETE  /allizo/wishlist/{wishlistId}/service

# Bookings
POST    /allizo/booking/{bookingId}/service/{serviceId}
DELETE  /allizo/booking/{bookingId}/service/{serviceId}

# Reviews
GET     /allizo/services/{serviceId}/reviews
POST    /allizo/services/{serviceId}/reviews

🧰 Tech Stack

    Backend: Laravel 10+

    Authentication: Laravel Sanctum

    Database: MySQL / PostgreSQL

    Architecture: RESTful API

📦 Installation

git clone https://github.com/your-username/allizo-api.git
cd allizo-api
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve

🔐 Security

    Protected routes via auth:sanctum middleware.

    Role-based access using custom controllers.

🙌 Contributing

Pull requests are welcome! For major changes, please open an issue first to discuss what you would like to change.
📜 License

MIT
