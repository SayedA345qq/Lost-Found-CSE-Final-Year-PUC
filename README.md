# Lost & Found - AI-Powered Platform

A modern web application built with Laravel that helps people find their lost items and report found belongings. Features AI-powered image search using OpenAI's CLIP model for visual similarity matching.

## Features

### Core Functionality
- **Post Lost/Found Items** - Create detailed posts with images, descriptions, categories, and location data
- **AI-Powered Image Search** - Upload photos to find visually similar items using OpenAI's CLIP model with customizable similarity thresholds
- **Advanced Search & Filtering** - Filter posts by type (lost/found), category, location, date range, and keywords
- **Smart Categorization** - Organize items by categories for better searchability and matching

### Communication & Claims
- **Secure Claim System** - Request to claim items with verification process and status tracking
- **Found Item Notifications** - Notify users when someone reports finding their lost item
- **Direct Messaging** - Private communication between users with conversation management
- **Comment System** - Public comments on posts for additional information and tips

### User Management & Safety
- **User Dashboard** - Comprehensive management of posts, claims, messages, and notifications
- **Post Status Management** - Mark items as active or resolved with bulk operations
- **Content Moderation** - Report inappropriate content with flagging system
- **Notification Center** - Real-time in app notifications for found & claims

### Community Features
- **Success Stories** - Showcase successful item reunions to inspire the community
- **User Feedback System** - Collect and manage user feedback for platform improvement

### Administrative Features
- **Flagged Content Management** - Review and restore flagged posts, comments, and messages
- **Email Notifications** - Automated email alerts for important events and matches

## Screenshots

### Landing Page
![Landing Page](screenshots/landing-page.png)
*Modern homepage with hero section and feature highlights*

### User Dashboard
![Dashboard](screenshots/dashboard.png)
*Personal dashboard for managing posts*

### Post Creation
![Create Post](screenshots/1.png)
*Intuitive form for creating lost/found item posts*

### Browse Posts
![Create Post](screenshots/2.png)
*Shows all user posts*

### AI Image Search
![AI Search](screenshots/3.png)
*AI-powered visual search interface*

### Search Results
![Search Results](screenshots/4.png)
*AI search results with similarity scores*

### Success Stories
![Success Stories](screenshots/5.png)
*Showcase of successful item reunions*

## Technology Stack

- **Backend**: Laravel 12.x, PHP 8.2+
- **Frontend**: Tailwind CSS, Alpine.js, Vite
- **Database**: SQLite (default)
- **AI**: Python 3.8+, OpenAI CLIP, PyTorch

## Requirements

- PHP 8.2+
- Composer
- Node.js 18+
- Python 3.8+
- Git

## Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd Final_Project
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   pip install -r requirements_local.txt
   ```

3. **Setup environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   touch database/database.sqlite
   ```

4. **Setup database**
   ```bash
   php artisan migrate
   php artisan storage:link
   ```

5. **Build assets**
   ```bash
   npm run build
   ```

## Running the Application

**Quick start (recommended):**
```bash
composer run dev
```

This starts the Laravel server, queue worker, and Vite dev server.

**Individual services:**
```bash
# Laravel server
php artisan serve

# Frontend development
npm run dev

# Background jobs
php artisan queue:work
```

Visit `http://localhost:8000` to access the application.

## AI Image Search Setup

1. **Test CLIP integration**
   ```bash
   php local_clip_api.php
   ```

2. **Generate embeddings for existing posts**
   ```bash
   php artisan posts:generate-embeddings
   ```

## Notification System

The platform features an intelligent notification system that automatically alerts users about potential matches:

### Email Notifications
- **Lost Item Matches** - Receive emails when someone posts a found item similar to your lost item
- **Found Item Matches** - Get notified when someone posts a lost item matching your found item
- **Claim Updates** - Email alerts for claim requests and status updates
- **Message Alerts** - Notifications for new messages from other users

### In-App Notifications
- **Real-time Alerts** - Instant notifications within the application
- **Dashboard Badges** - Visual indicators for new matches and messages
- **Notification History** - Track all past notifications and their status

### Smart Matching
- **AI-Powered Matching** - Uses image similarity and text analysis to find potential matches
- **Category-Based Alerts** - Notifications filtered by item categories and location
- **Customizable Settings** - Users can control notification frequency and types

## Usage

1. **Register/Login** - Create an account and set notification preferences
2. **Post Items** - Report lost or found items with photos and detailed descriptions
3. **Receive Alerts** - Get automatic notifications when potential matches are found
4. **Search** - Use text search or AI image search to find items manually
5. **Claim Items** - Contact owners through the secure claim system
6. **Manage** - Track your posts, notifications, and messages in the dashboard

## Configuration

Key settings in `.env`:
```env
APP_NAME="Lost & Found"
APP_URL=http://localhost:8000
DB_CONNECTION=sqlite
QUEUE_CONNECTION=database
```

## Troubleshooting

**Common issues:**

- **Python/AI errors**: Run `python --version` and `pip install -r requirements_local.txt`
- **Permission errors**: `chmod -R 775 storage bootstrap/cache`
- **Database issues**: `php artisan migrate:fresh`
- **Asset errors**: `npm cache clean --force && npm install`

## Team Members

This project was developed by students from the **Department of Computer Science & Engineering, Premier University Chattogram**:

- **Mohammed Sayed Anwar** - ID: 2147
- **Sakib Khan** - ID: 2107  
- **Abdullah Al Miraj** - ID: 2106

## Support

- Check `storage/logs/laravel.log` for errors
- Test AI with `php local_clip_api.php`
- Run `php artisan test` for system checks

---

Built with ❤️ by CSE students at Premier University Chattogram using Laravel, AI, and modern web technologies.
