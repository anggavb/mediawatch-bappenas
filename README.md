# MediaWatch Bappenas

A comprehensive media monitoring and news analytics platform for Bappenas (Badan Perencanaan Pembangunan Nasional / National Development Planning Agency).

## 📋 Project Description

MediaWatch Bappenas is a full-stack web application designed to monitor, analyze, and manage media coverage and news articles related to Bappenas activities and national development programs. The system provides powerful tools for media management, sentiment analysis, speaker tracking, and advanced full-text search capabilities.

Key capabilities include:
- Media outlet management with categorization and grouping
- News monitoring (Medmon) with sentiment analysis
- Advanced PostgreSQL full-text search for rapid content discovery
- Data import/export functionality (Excel)
- RESTful API with authentication
- Modern, responsive Vue.js interface

## ✨ Features

### 🗞️ Media Management
- **Media Hub**: Centralized management of media outlets
- **Categories**: Organize media by type (TV, Radio, Online, Print, etc.)
- **Media Groups**: Group related media outlets for better organization
- **Unknown Media Detection**: Identify and assign unrecognized media sources
- **Bulk Import**: Import media data from Excel files

### 📰 Media Monitoring (Medmon)
- **News Tracking**: Monitor and catalog news articles and media coverage
- **Sentiment Analysis**: Analyze sentiment of news content (positive, neutral, negative)
- **Speaker Tracking**: Track speakers and sources mentioned in news
- **Category Grouping**: Group and analyze news by category
- **Full-Text Search**: Advanced search with PostgreSQL FTS
  - Multi-keyword search support
  - Relevance ranking
  - Text highlighting and snippets
  - GIN indexing for high performance
  - Support for 50-500+ articles with 2,000-5,000 character content

### 🔐 Authentication & Authorization
- User registration and login
- JWT-based authentication via Laravel Sanctum
- Role-based access control
- Rate limiting on authentication endpoints

### 📊 Analytics & Reporting
- News analytics dashboard
- Category-based statistics
- Media coverage reports
- Data export functionality

### 🔄 Data Management
- Excel import for media and news data
- Sample data generation for testing
- Database seeding and factories
- Policy-based authorization

## 🛠️ Tech Stack

### Backend
- **Framework**: Laravel 12.x
- **PHP**: 8.2+
- **Database**: PostgreSQL (with Full-Text Search)
- **Authentication**: Laravel Sanctum
- **Excel Processing**: Maatwebsite Excel 3.x
- **Document Generation**: PHPOffice PHPWord

### Frontend
- **Framework**: Vue.js 3.5
- **UI Library**: Vuetify 3.11
- **State Management**: Pinia 3.x
- **Router**: Vue Router 4.x
- **HTTP Client**: Axios
- **Build Tool**: Vite 7.x
- **Icons**: Material Design Icons (MDI)
- **Fonts**: Roboto

### Development Tools
- **Laravel Pint**: Code style fixer
- **PHPUnit**: Testing framework
- **Laravel Sail**: Docker development environment
- **Concurrently**: Run multiple dev servers

## 📦 Installation Instructions

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js 18+ and npm
- PostgreSQL 14+
- Git

### Step 1: Clone the Repository
```bash
git clone https://github.com/anggavb/mediawatch-bappenas.git
cd mediawatch-bappenas
```

### Step 2: Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### Step 3: Environment Configuration
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Step 4: Configure Database
Edit your `.env` file with PostgreSQL credentials:
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=mediawatch_bappenas
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Step 5: Run Migrations and Seeders
```bash
# Run migrations
php artisan migrate

# Seed the database with sample data
php artisan db:seed
```

### Step 6: Build Frontend Assets
```bash
# Development build
npm run dev

# Production build
npm run build
```

### Step 7: Start the Application
```bash
# Start Laravel development server
php artisan serve

# In another terminal, start Vite dev server (for development)
npm run dev
```

The application will be available at `http://localhost:8000`

### Quick Setup (Alternative)
You can use the composer setup script for a faster installation:
```bash
composer run setup
```

## 📖 Usage Guide

### Authentication
1. **Register a new account**:
   - Navigate to `/register`
   - Fill in your details
   - Submit the registration form

2. **Login**:
   - Navigate to `/login`
   - Enter your credentials
   - Note: Login has rate limiting (5 attempts per minute)

### Media Management
1. **Add Media Outlet**:
   - Go to Media Hub
   - Click "Add New Media"
   - Select category and group
   - Enter media details
   - Save

2. **Import Media from Excel**:
   - Prepare your Excel file (see sample format)
   - Navigate to Media Import
   - Upload your file
   - Review and confirm import

### News Monitoring
1. **Add News Article**:
   - Navigate to Medmon section
   - Click "Add News"
   - Select media outlet
   - Enter news content, title, and details
   - Select sentiment and speaker
   - Save

2. **Search News**:
   - Use the search bar in Medmon
   - Enter multiple keywords
   - View ranked results with highlights
   - Filter by category, date, or sentiment

3. **Import News Data**:
   - Prepare Excel file with news data
   - Navigate to Medmon Import
   - Upload and process

### API Usage
All API endpoints require authentication except for registration and login.

**Authentication**:
```bash
# Login
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"user@example.com","password":"password"}'

# Use the token in subsequent requests
curl -X GET http://localhost:8000/api/auth/user \
  -H "Authorization: Bearer YOUR_TOKEN"
```

**Media Endpoints**:
- `GET /api/media` - List all media
- `POST /api/media` - Create new media
- `GET /api/media/{id}` - Get specific media
- `PUT /api/media/{id}` - Update media
- `DELETE /api/media/{id}` - Delete media
- `POST /api/media/import` - Import from Excel
- `GET /api/media/show-unknown` - Show unassigned media

**Medmon Endpoints**:
- `GET /api/medmon` - List all news
- `POST /api/medmon` - Create news article
- `POST /api/medmon/search` - Full-text search
- `GET /api/medmon/group-by-category` - Group by category
- `POST /api/medmon/import` - Import news data

For detailed API documentation, see [FTS-system.md](FTS-system.md) for search implementation details.

## 🧪 Testing
```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --testsuite=Feature

# Run with coverage
php artisan test --coverage
```

## 🔧 Development
```bash
# Run code style fixer
./vendor/bin/pint

# Watch for frontend changes
npm run dev

# Run both Laravel and Vite concurrently
npm run dev & php artisan serve
```

## 👥 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
