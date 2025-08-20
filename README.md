# E-Learning Platform

A comprehensive Laravel-based e-learning platform that enables teachers to create and manage courses, students to enroll and learn, and administrators to oversee the entire system.

[Demo_Video](https://drive.google.com/file/d/1LLXIaIbgjrwiEZAA4oihKrRXkRhsJAy3/view?usp=drive_link)
[Report](https://drive.google.com/file/d/1qrQa6t42v2X_8_nxL81JGoP3bLVAanZ3/view?usp=drive_link)

## 🚀 Features

### For Students
- **Course Discovery**: Browse and search through available courses
- **Course Enrollment**: Enroll in courses and track progress
- **Video Learning**: Watch course videos with progress tracking
- **Course Reviews**: Rate and review completed courses
- **Teacher Following**: Follow favorite teachers and get updates
- **Blog Reading**: Read educational blog posts from teachers
- **Progress Tracking**: Monitor learning progress and completion

### For Teachers
- **Course Creation**: Create comprehensive courses with modules and videos
- **Content Management**: Upload videos, create quizzes, and assignments
- **Student Management**: Track student enrollments and progress
- **Blog Publishing**: Write and publish educational blog posts
- **Analytics**: View course performance and student engagement
- **Revenue Tracking**: Monitor earnings from course sales

### For Administrators
- **User Management**: Manage students, teachers, and admin accounts
- **Course Oversight**: Review and approve courses
- **Complaint Handling**: Address user complaints and issues
- **Platform Analytics**: Monitor overall platform performance
- **System Management**: Manage categories and platform settings

## 🛠️ Technology Stack

- **Backend**: Laravel 11 (PHP 8.2+)
- **Frontend**: Bootstrap 5, Blade Templates
- **Database**: MySQL/PostgreSQL
- **Authentication**: Laravel Sanctum
- **File Storage**: Laravel Storage (Local/Cloud)
- **Icons**: Font Awesome 6

## 📋 Requirements

- PHP 8.2 or higher
- Composer
- MySQL 8.0+ or PostgreSQL 13+
- Node.js & NPM (for asset compilation)
- Web server (Apache/Nginx)

## 🚀 Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd e-learning-platform
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database**
   Edit `.env` file with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=elearning_platform
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed the database**
   ```bash
   php artisan db:seed
   ```

8. **Create storage link**
   ```bash
   php artisan storage:link
   ```

9. **Compile assets**
   ```bash
   npm run build
   ```

10. **Start the development server**
    ```bash
    php artisan serve
    ```

## 👥 Default Users

After running the seeders, you'll have these default accounts:

### Admin
- Email: `admin@elearn.com`
- Password: `password`

### Teachers
- Email: `john@teacher.com`
- Password: `password`
- Email: `sarah@teacher.com`
- Password: `password`

### Students
- Email: `mike@student.com`
- Password: `password`
- Email: `emily@student.com`
- Password: `password`

## 📁 Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/          # Admin controllers
│   │   ├── Student/        # Student controllers
│   │   ├── Teacher/        # Teacher controllers
│   │   └── AuthController.php
│   ├── Middleware/         # Custom middleware
│   └── Requests/           # Form requests
├── Models/                 # Eloquent models
└── Providers/             # Service providers

resources/
├── views/
│   ├── admin/             # Admin views
│   ├── student/           # Student views
│   ├── teacher/           # Teacher views
│   ├── blog/              # Blog views
│   ├── courses/           # Course views
│   ├── auth/              # Authentication views
│   └── layouts/           # Layout templates
├── css/                   # Custom styles
└── js/                    # JavaScript files

database/
├── migrations/            # Database migrations
└── seeders/              # Database seeders
```

## 🔐 Authentication & Authorization

The platform uses role-based access control with three main roles:

- **Student**: Can enroll in courses, watch videos, submit reviews
- **Teacher**: Can create courses, manage content, write blog posts
- **Admin**: Can manage users, courses, and platform settings

## 🎯 Key Features Implementation

### Course Management
- Multi-module course structure
- Video upload and streaming
- Quiz and assignment creation
- Progress tracking
- Enrollment management

### Blog System
- Rich text blog posts
- Comments and likes
- Teacher authoring
- Public reading

### User Management
- Role-based access control
- Profile management
- Teacher following system
- User status management

### Payment System (Ready for Integration)
- Course pricing
- Revenue tracking
- Payment gateway ready

## 🎨 UI/UX Features

- **Responsive Design**: Works on all devices
- **Modern Interface**: Clean, professional design
- **Interactive Elements**: Hover effects, animations
- **Progress Indicators**: Visual progress tracking
- **Search & Filter**: Easy course discovery

## 🔧 Configuration

### File Upload
Configure file upload settings in `config/filesystems.php`:
```php
'disks' => [
    'public' => [
        'driver' => 'local',
        'root' => storage_path('app/public'),
        'url' => env('APP_URL').'/storage',
        'visibility' => 'public',
    ],
],
```

### Email Configuration
Set up email settings in `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"
```

## 🚀 Deployment

### Production Setup
1. Set `APP_ENV=production` in `.env`
2. Configure your web server (Apache/Nginx)
3. Set up SSL certificate
4. Configure database for production
5. Set up file storage (consider using S3 or similar)
6. Configure caching (Redis recommended)

### Web Server Configuration
Example Nginx configuration:
```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /path/to/your/project/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

## 🧪 Testing

Run the test suite:
```bash
php artisan test
```

## 📝 API Documentation

The platform includes API endpoints for:
- User authentication
- Course management
- Blog operations
- Progress tracking

API documentation can be generated using tools like Postman or Swagger.

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🆘 Support

For support and questions:
- Create an issue in the repository
- Contact the development team
- Check the documentation

## 🔮 Future Enhancements

- **Live Streaming**: Real-time video streaming capabilities
- **Mobile App**: Native mobile applications
- **AI Integration**: Personalized learning recommendations
- **Advanced Analytics**: Detailed learning analytics
- **Multi-language**: Internationalization support
- **Payment Integration**: Stripe, PayPal integration
- **Certificate Generation**: Automated certificate creation
- **Discussion Forums**: Course-specific discussion boards

## 🎉 Acknowledgments

- Laravel team for the amazing framework
- Bootstrap team for the UI framework
- Font Awesome for the icons
- All contributors and users

---

**Built with ❤️ using Laravel**
