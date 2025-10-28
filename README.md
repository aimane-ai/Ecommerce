# 🛒 Laravel E-commerce - Giftos

A modern e-commerce website developed with Laravel, Bootstrap, and Stripe for payments.

## 📋 Table of Contents

- [Features](#-features)
- [Technologies Used](#-technologies-used)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Project Structure](#-project-structure)
- [Usage](#-usage)
- [API Routes](#-api-routes)
- [Database](#-database)
- [Stripe Payments](#-stripe-payments)
- [Contributors](#-contributors)

## ✨ Features

### 🛍️ **Product Management**
- ✅ Product display with images
- ✅ Product categorization
- ✅ Stock management
- ✅ Search and filtering
- ✅ Product details

### 👤 **User Authentication**
- ✅ Registration/Login
- ✅ User dashboard
- ✅ User profile
- ✅ Role management (Admin/User)

### 🛒 **Shopping Cart**
- ✅ Add/Remove products
- ✅ Cart display
- ✅ Total calculation
- ✅ Quantity management

### 💳 **Payment System**
- ✅ Stripe integration
- ✅ Secure card payments
- ✅ Complete payment form (CVC, Expiry Date)
- ✅ Payment error handling

### 📝 **Comments and Likes System**
- ✅ Product comments
- ✅ Product likes system
- ✅ Comment deletion by author
- ✅ Intuitive user interface

### 📦 **Order Management**
- ✅ Order history
- ✅ Order statuses
- ✅ Order confirmation
- ✅ Admin interface for management

### 🎨 **User Interface**
- ✅ Responsive design with Bootstrap
- ✅ Modern and professional theme
- ✅ Intuitive navigation
- ✅ Pages: Home, Products, Contact, Testimonials, About

## 🛠️ Technologies Used

- **Backend**: Laravel 12.x
- **Frontend**: Bootstrap 5, HTML5, CSS3, JavaScript
- **Database**: SQLite
- **Payments**: Stripe API
- **Authentication**: Laravel Breeze
- **PDF**: Laravel DomPDF
- **Testing**: Pest PHP

## 🚀 Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js and NPM
- Stripe API Key

### Installation Steps

1. **Clone the project**
```bash
git clone [repo-url]
cd Ecommerce
```

2. **Install PHP dependencies**
```bash
composer install
```

3. **Install Node.js dependencies**
```bash
npm install
```

4. **Environment configuration**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Database configuration**
```bash
# Create SQLite database
touch database/database.sqlite
```

6. **Migration and seeders**
```bash
php artisan migrate
php artisan db:seed
```

7. **Build assets**
```bash
npm run build
# or for development
npm run dev
```

8. **Start the server**
```bash
php artisan serve
```

## ⚙️ Configuration

### Environment Variables (.env)

```env
# Database
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sqlite

# Stripe
STRIPE_KEY=pk_test_your_public_key_here
STRIPE_SECRET=sk_test_your_secret_key_here

# Google Maps API
GOOGLE_MAPS_API_KEY=your_google_maps_api_key_here

# Mail (optional)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
```

### Stripe Configuration

1. Create an account on [Stripe](https://stripe.com)
2. Get your API keys from the dashboard
3. Add them to your `.env` file

### Google Maps Configuration

1. Create an account on [Google Cloud Console](https://console.cloud.google.com/)
2. Enable the Maps Embed API
3. Create an API key
4. Add it to your `.env` file as `GOOGLE_MAPS_API_KEY`

## 📁 Project Structure

```
Ecommerce/
├── app/
│   ├── Http/Controllers/     # Controllers
│   ├── Models/              # Eloquent Models
│   └── ...
├── database/
│   ├── migrations/          # Migrations
│   └── seeders/            # Seeders
├── public/
│   ├── front_end/          # Frontend assets
│   ├── admin/              # Admin interface
│   └── storage/            # Uploaded files
├── resources/
│   ├── views/              # Blade views
│   └── ...
├── routes/
│   └── web.php             # Web routes
└── ...
```

## 🎯 Usage

### Main Pages

- **Home** (`/`): Homepage with featured products
- **Products** (`/allproducts`): Complete product catalog
- **Product Details** (`/product/{id}`): Product detail page
- **Cart** (`/cardproduct`): Shopping cart management
- **Payment** (`/stripe/{price}`): Stripe payment page
- **Orders** (`/my_orders`): Order history
- **Contact** (`/contact`): Contact page
- **Testimonials** (`/testimonials`): Customer reviews

### Admin Features

- **Dashboard** (`/dashboard`): Administrator dashboard
- **Product Management**: Add/modify/delete products
- **Order Management**: Track orders
- **User Management**: Manage user accounts

## 🛣️ API Routes

### Main Routes
```php
// Public pages
GET  /                    # Homepage
GET  /allproducts         # All products
GET  /product/{id}        # Product details
GET  /contact             # Contact
GET  /testimonials        # Testimonials

// Authentication
GET  /login               # Login
GET  /register            # Registration
POST /logout              # Logout

// Cart and orders
GET  /cardproduct         # Cart
POST /add_to_card/{id}    # Add to cart
DELETE /delete_card/{id}  # Remove from cart
POST /confirm_order       # Confirm order

// Payment
GET  /stripe/{price}      # Payment page
POST /stripe_post         # Process payment

// Comments and likes
POST /products/{product}/comment    # Add comment
POST /like_product/{product}        # Like product
DELETE /delete_comment_product/{comment} # Delete comment
```

## 🗄️ Database

### Main Models

#### User
- `id`, `name`, `email`, `password`, `user_role`

#### Product
- `id`, `name`, `description`, `prix`, `quantite`, `image`, `category`

#### Card (Cart)
- `id`, `user_id`, `product_id`

#### Order
- `id`, `user_id`, `product_id`, `name`, `address`, `telephone`, `status`

#### Comment
- `id`, `user_id`, `product_id`, `comment`

#### Like
- `id`, `user_id`, `product_id`

## 💳 Stripe Payments

### Configuration
```php
// config/services.php
'stripe' => [
    'secret' => env('STRIPE_SECRET'),
    'key' => env('STRIPE_KEY'),
],
```

### Usage
1. Customer enters card information
2. Stripe validates the data
3. PaymentMethod creation
4. Payment processing
5. Confirmation and order creation

### Security
- ✅ Client and server-side validation
- ✅ Error handling
- ✅ Secure tokens
- ✅ CSRF protection

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Tests with coverage
php artisan test --coverage
```

## 🚀 Deployment

### Production
1. Configure web server (Apache/Nginx)
2. Install dependencies: `composer install --optimize-autoloader --no-dev`
3. Build assets: `npm run build`
4. Configure database
5. Migrate: `php artisan migrate --force`

### Docker (optional)
```bash
# With Laravel Sail
./vendor/bin/sail up -d
```

## 📱 Responsive Design

The website is fully responsive and adapts to all screen sizes:
- 📱 Mobile (< 768px)
- 📱 Tablet (768px - 1024px)
- 💻 Desktop (> 1024px)

## 🔧 Maintenance

### Logs
```bash
# View logs
php artisan pail

# Real-time logs
tail -f storage/logs/laravel.log
```

### Cache
```bash
# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## 🤝 Contributors

- **Development**: [Your Name]
- **Design**: Bootstrap + Custom CSS
- **Payments**: Stripe Integration

## 📄 License

This project is licensed under the MIT License. See the `LICENSE` file for more details.

## 🆘 Support

For any questions or issues:
1. Check Laravel documentation
2. Check GitHub issues
3. Contact the development team

---

**Version**: 1.0.0  
**Last Updated**: December 2024  
**Laravel**: 12.x  
**PHP**: 8.2+