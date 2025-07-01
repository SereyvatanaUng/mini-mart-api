# Mini Mart API

A comprehensive REST API for Point of Sale (POS) system built with Laravel. This API provides complete functionality for managing a mini mart including user management, inventory control, sales processing, and analytics.

## 🚀 Features

- **User Management**: Shop owner and cashier roles with proper access control
- **Product Management**: Complete CRUD operations with categories, sections, and shelf organization
- **Sales Processing**: Full POS functionality with multiple payment methods
- **Inventory Control**: Stock management with low-stock alerts and barcode scanning
- **Store Layout**: Organize products by sections and shelves
- **Analytics**: Sales reports and dashboard with insights
- **Authentication**: Secure login with password reset via OTP

## 📋 Requirements

- PHP 8.1 or higher
- Composer
- Laravel 12.x
- Database (PostgreSQL)
- Mail service (for OTP functionality)

## 🛠️ Installation

### 1. Clone the Repository

```bash
git clone <your-repository-url>
cd mini-mart-api
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Environment Configuration

Copy the environment file and configure your settings:

```bash
cp .env.example .env
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Database Configuration

Edit your `.env` file with your database credentials:

#### For PostgreSQL:
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=mini_mart_api
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 6. Email Configuration

Configure your email settings for OTP functionality:

#### Gmail (Recommended for development):
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="Mini Mart"
```

#### Other Email Services:

**Mailgun:**
```env
MAIL_MAILER=mailgun
MAILGUN_DOMAIN=your-domain.mailgun.org
MAILGUN_SECRET=your-secret-key
```

**SendGrid:**
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your-sendgrid-api-key
MAIL_ENCRYPTION=tls
```

**Local Development (Log only):**
```env
MAIL_MAILER=log
```

### 7. Additional Configuration

```env
# Application Settings
APP_NAME="Mini Mart API"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Cache & Session
CACHE_DRIVER=file
SESSION_DRIVER=file
SESSION_LIFETIME=120

# Queue (for background jobs)
QUEUE_CONNECTION=sync
```

### 8. Database Setup

Run migrations and seed the database:

```bash
# Run migrations
php artisan migrate

# Seed with sample data
php artisan db:seed

# Or do both at once
php artisan migrate:fresh --seed
```

### 9. Storage Link

Create symbolic link for file uploads:

```bash
php artisan storage:link
```

## 🏃‍♂️ Running the Application

### Development Server

```bash
php artisan serve
```

The API will be available at: `http://localhost:8000`

### Production Deployment

For production deployment, configure your web server (Apache/Nginx) to point to the `public` directory.

## 📚 API Documentation

### Access API Documentation

Once your application is running, access the interactive API documentation at:

**🔗 [http://127.0.0.1:8000/api-docs](http://127.0.0.1:8000/api-docs)**

The documentation includes:
- All available endpoints (44 total)
- Request/response examples
- Authentication requirements
- Parameter descriptions
- Sample API calls

### Quick API Overview

| Category | Endpoints | Description |
|----------|-----------|-------------|
| **Authentication** | 7 | Login, logout, password reset |
| **Cashier Management** | 5 | CRUD operations for cashiers |
| **Product Management** | 7 | Products, barcode scanning, stock alerts |
| **Sales & POS** | 4 | Sales processing and summaries |
| **Store Management** | 15 | Categories, sections, shelves |
| **Dashboard** | 3 | Analytics and reports |
| **Helpers** | 3 | Dropdown data for forms |

## 🔐 Default Login Credentials

After seeding the database, use these credentials to test the API:

### Shop Owner:
- **Email**: `owner@minimart.com`
- **Password**: `password123`
- **Role**: Can manage everything

### Cashiers:
- **Email**: `sarah@minimart.com` | **Password**: `password123`
- **Email**: `mike@minimart.com` | **Password**: `password123`
- **Role**: Can process sales only

## 🧪 Testing the API

### 1. Login to Get Token

```bash
curl -X POST http://localhost:8000/api/v1/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "owner@minimart.com",
    "password": "password123"
  }'
```

### 2. Use Token for Authenticated Requests

```bash
curl -X GET http://localhost:8000/api/v1/products \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

### 3. Create a Sale

```bash
curl -X POST http://localhost:8000/api/v1/sales \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Content-Type: application/json" \
  -d '{
    "items": [
      {"product_id": 1, "quantity": 2},
      {"product_id": 2, "quantity": 1}
    ],
    "payment_method": "cash"
  }'
```

## 📊 Sample Data

The seeder creates:

- **1 Shop Owner**: John Smith
- **2 Cashiers**: Sarah Johnson, Mike Wilson
- **8 Categories**: Beverages, Snacks, Dairy, etc.
- **5 Sections**: Front A, Middle B, Back C, Cold D, Counter E
- **20 Shelves**: 4 levels per section
- **22+ Products**: Realistic items with barcodes and prices
- **Sample Sales**: Historical sales data for testing

## 🔧 Configuration Options

### API Rate Limiting

Configure in `config/sanctum.php`:

```php
'expiration' => 60 * 24, // Token expires in 24 hours
```

### File Upload Limits

Configure in `config/app.php`:

```php
'upload_max_filesize' => '5M',
'post_max_size' => '10M',
```

### Pagination

Default pagination is 15 items per page. Customize in controllers or set globally.

## 🐛 Troubleshooting

### Common Issues

**Database Connection Error:**
- Check database credentials in `.env`
- Ensure database server is running
- Verify database exists

**Migration Errors:**
- Check database permissions
- Ensure proper PHP extensions (pdo_pgsql)
- Clear config cache: `php artisan config:clear`

**Email/OTP Not Working:**
- Verify email configuration in `.env`
- Check spam folder
- For Gmail, use App Password instead of regular password
- Test with log driver first: `MAIL_MAILER=log`

**Token Errors:**
- Ensure `laravel/sanctum` is properly installed
- Run: `php artisan migrate` (for personal_access_tokens table)
- Check token in Authorization header: `Bearer YOUR_TOKEN`

**Permission Errors:**
- Set proper permissions: `chmod -R 755 storage bootstrap/cache`
- Ensure web server can write to storage and bootstrap/cache

### Debug Mode

For debugging, set in `.env`:
```env
APP_DEBUG=true
LOG_LEVEL=debug
```

## 📱 Frontend Integration

This API is designed to work with Flutter, React, Vue, or any frontend framework that can consume REST APIs.

### Key Integration Points:

1. **Authentication Flow**: Login → Store token → Use in headers
2. **Role-based UI**: Different interfaces for shop owners vs cashiers
3. **Real-time Updates**: Consider implementing WebSockets for live updates
4. **Barcode Scanning**: Mobile camera integration for product scanning
5. **Offline Support**: Local storage for offline sales processing

## 🚀 Production Checklist

Before deploying to production:

- [ ] Set `APP_ENV=production` in `.env`
- [ ] Set `APP_DEBUG=false` in `.env`
- [ ] Configure proper database credentials
- [ ] Set up SSL/HTTPS
- [ ] Configure email service (not log driver)
- [ ] Set up backup strategy
- [ ] Configure queue worker for background jobs
- [ ] Set up monitoring and logging
- [ ] Configure rate limiting
- [ ] Set proper file permissions

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## 📞 Support

For support and questions:
- Check the API documentation: [http://127.0.0.1:8000/api-docs](http://127.0.0.1:8000/api-docs)
- Review this README for configuration help
- Check Laravel documentation for framework-specific issues

---

**Happy coding! 🎉**