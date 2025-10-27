# PlumeWallet

A comprehensive personal finance management application built with Laravel 12, Livewire 3, and Tailwind CSS. PlumeWallet emerges as a response to the complexity of personal financial management, offering a complete and intuitive solution that integrates naturally into users' daily lives.

Developed as part of the Specialist Technician in Information Systems Technologies and Programming course, this web platform provides a detailed view of finances with interactive charts, automatic categorization, and management of multiple financial spaces (teams). The system features a granular authorization system and responsive interface with multi-language support, designed to be accessible to diverse audiences - from young students to elderly people with little technological familiarity.

The development followed agile Scrum methodology, successfully implementing essential MVP functionalities including secure authentication with 2FA, account and category management, transaction recording, financial teams/spaces system, and complete administrative backoffice.

## 🚀 Features

### Core Financial Management
- **Multi-Account Support**: Manage checking, savings, cash, credit cards, and lines of credit
- **Transaction Tracking**: Record and categorize income and expenses
- **Account Reconciliation**: Mark transactions as cleared and reconciled
- **Payee Management**: Track and categorize payees for better transaction organization
- **Budget Management**: Visual budget tracking and analysis

### User Management & Security
- **Multi-Role System**: Separate interfaces for clients and staff
- **Team Management**: Multi-user team support with invitations
- **Two-Factor Authentication**: Enhanced security with 2FA support
- **Role-Based Permissions**: Granular access control using Spatie Laravel Permission
- **Email Verification**: Secure account activation process

### Content Management
- **Blog System**: Create and manage blog posts with categories and tags
- **FAQ Management**: Comprehensive FAQ system for user support
- **Contact Forms**: Handle user inquiries with status tracking
- **Multi-language Support**: English, French, and Portuguese language support

### Administrative Features
- **User Management**: Complete user administration for staff
- **System Logging**: Comprehensive activity and error logging
- **Login Attempt Monitoring**: Track and manage login attempts
- **Contact Form Management**: Handle and respond to user inquiries

## 🛠️ Technology Stack

This project was developed using modern web technologies following agile Scrum methodology, ensuring both academic rigor and practical implementation.

### Backend
- **Laravel 12**: PHP framework providing robust foundation for financial management
- **Livewire 3**: Full-stack framework for dynamic UIs, enabling real-time financial data updates
- **Laravel Jetstream**: Authentication scaffolding with team management capabilities
- **Laravel Fortify**: Authentication backend with 2FA support
- **Laravel Sanctum**: API authentication for secure data access
- **Spatie Laravel Permission**: Granular role and permission management system

### Frontend
- **Tailwind CSS**: Utility-first CSS framework for responsive, accessible design
- **Alpine.js**: Lightweight JavaScript framework for enhanced user interactions
- **Vite**: Modern build tool for optimized asset compilation
- **Tabler Icons**: Comprehensive icon library for intuitive user interface

### Database
- **MySQL**: Primary database for production financial data storage
- **Eloquent ORM**: Database abstraction layer ensuring data integrity

### Development & Testing
- **Pest**: Modern testing framework for comprehensive test coverage
- **Laravel Pint**: Code style fixer maintaining consistent code quality
- **Laravel Sail**: Docker development environment for consistent development setup

## 📋 Requirements

- PHP 8.2 or higher
- Composer
- Node.js 18+ and npm
- MySQL 8.0+ / PostgreSQL 13+ / SQLite 3.8.8+

## 🚀 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/plumewallet.git
   cd plumewallet
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

5. **Database configuration**
   - Update your `.env` file with database credentials
   - Run migrations and seeders:
   ```bash
   php artisan migrate --seed
   ```

6. **Build assets**
   ```bash
   npm run build
   ```

7. **Start the development server**
   ```bash
   php artisan serve
   ```

## 🔧 Development

### Running the Development Environment
```bash
# Start all development services (Laravel, Queue, Vite)
composer run dev

# Or run individually:
php artisan serve          # Laravel server
php artisan queue:listen   # Queue worker
npm run dev               # Vite dev server
```

### Testing
```bash
# Run all tests
composer run test

# Or run with Pest directly
./vendor/bin/pest
```

### Code Style
```bash
# Fix code style issues
./vendor/bin/pint
```

## 📁 Project Structure

```
plumewallet/
├── app/
│   ├── Actions/          # Fortify and Jetstream actions
│   ├── Enums/           # Application enums
│   ├── Http/            # Controllers and middleware
│   ├── Livewire/        # Livewire components
│   │   ├── App/         # Client-facing components
│   │   ├── Backoffice/  # Staff/admin components
│   │   ├── Guest/       # Public components
│   │   └── Shared/      # Shared components
│   ├── Models/          # Eloquent models
│   ├── Services/        # Business logic services
│   └── Traits/          # Reusable traits
├── database/
│   ├── factories/       # Model factories
│   ├── migrations/      # Database migrations
│   └── seeders/         # Database seeders
├── resources/
│   ├── css/            # Stylesheets
│   ├── js/             # JavaScript files
│   └── views/          # Blade templates
└── tests/              # Test files
```

## 🎯 Key Models

### Financial Models
- **Account**: Financial accounts (checking, savings, credit cards, etc.)
- **Transaction**: Financial transactions with categorization
- **Payee**: Transaction payees for better organization
- **TransactionCategory**: Transaction categorization system

### User Management
- **User**: Application users with role-based access
- **Team**: Multi-user team management
- **TeamInvitation**: Team invitation system

### Content Management
- **Post**: Blog posts with categories and tags
- **Faq**: Frequently asked questions
- **ContactForm**: User contact form submissions

## 🔐 User Roles

### Client Users
- Access to personal dashboard
- Manage their own accounts and transactions
- View and manage beneficiaries
- Update personal profile

### Staff Users
- Access to backoffice dashboard
- Manage all users and teams
- Handle blog content and FAQs
- Monitor system logs and contact forms
- Manage login attempts

## 🌐 Multi-language Support

The application supports three languages:
- English (en)
- French (fr)
- Portuguese (pt)

Language files are located in the `lang/` directory and can be easily extended.

## 📊 Database Schema

The application uses a comprehensive database schema with:
- User management and authentication tables
- Financial account and transaction tables
- Content management tables (blog, FAQ)
- System logging and monitoring tables
- Team and permission management tables

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🆘 Support

For support and questions:
- Create an issue in the GitHub repository
- Contact the development team
- Check the FAQ section in the application

## 🔄 Changelog

### Version 1.0.0
- Initial release
- Core financial management features
- Multi-role user system
- Blog and FAQ management
- Multi-language support
- Comprehensive admin panel

---

**PlumeWallet** - Your personal finance companion built with modern web technologies.