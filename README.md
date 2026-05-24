# Portfolio Website Setup Guide

## Project Structure

```text
new-portfolio/
├── config/
│   └── database.php          # Database configuration and connection
├── public/
│   ├── js/
│   │   └── script.js         # JavaScript functionality
│   └── uploads/              # Uploaded portfolio images
├── routes/
│   └── web.php               # Route definitions
├── views/
│   ├── layouts/
│   │   ├── app.php           # Main layout template
│   │   ├── header.php        # Header component
│   │   └── footer.php        # Footer component
│   └── pages/
│       ├── landing.php       # Landing/Home page
│       ├── about.php         # About Me page
│       ├── services.php      # Services page
│       ├── my-work.php       # My Work page
│       ├── projects.php      # Projects page
│       ├── contact.php       # Contact page
│       └── admin/            # Admin pages
├── src/
│   ├── helpers.php           # Application helpers
│   └── Router.php            # Router class for file-based routing
├── index.php                 # Main entry point
├── schema.sql                # Database schema
└── .gitignore                # Git ignore file
```

## Setup Instructions

### 1. Database Setup

```bash
mysql -u root < schema.sql
```

You can also execute `schema.sql` manually in phpMyAdmin.

### 2. Update Configuration

Create `.env` from `.env.example`, then update your database credentials and URLs:

- DB_HOST: localhost
- DB_USER: root
- DB_PASS: your password
- DB_NAME: portfolio_db
- SITE_URL: your local or production site URL
- DEVELOPER_EMAIL, DEVELOPER_PHONE, and social links

### 3. Start the Development Server

```bash
# XAMPP Apache
# Visit the SITE_URL configured in .env

# PHP built-in server
php -S localhost:8000
```

## Features

- File-based routing system
- Responsive design using inline Tailwind utility classes
- MySQL database integration
- Contact form with database storage
- Mobile-friendly navigation
- Custom color theme in the Tailwind CDN config
- Public pages for Landing, About, Services, Works, Projects, and Contact
- Admin panel for projects, services, works, skills, and messages
- PHP-only app with no npm build step required

## Admin Panel

Visit `{SITE_URL}/admin/login` after importing `schema.sql`.

Default login:

- Username: `admin`
- Password: `admin123`

Change the default password before using the site in production. The password hash is stored in the `admin_users` table.

## Customization

### Colors

Edit the Tailwind CDN config in `views/layouts/app.php`. The current theme exposes `primary` and `accent` colors for utilities like `bg-primary`, `text-primary`, `bg-accent`, and `text-accent`.

### Content

- Edit page files in `views/pages/` to update page content
- Edit header/footer in `views/layouts/` for navigation and footer changes
- Update database records via the admin panel or direct MySQL queries

### Images

- Uploaded images are stored in `public/uploads/`
- Existing page image paths can be updated in the relevant page files

## Troubleshooting

### Database Connection Error

- Verify MySQL is running
- Check database credentials in `config/database.php`
- Ensure the database exists by running `schema.sql`

### Tailwind CSS Not Loading

- Check the browser console for Tailwind CDN loading errors
- Verify `views/layouts/app.php` still includes the Tailwind CDN script
- Try clearing browser cache with Ctrl+Shift+R

### Routing Issues

- Ensure `.htaccess` is properly configured
- Check that PHP is handling requests correctly
- Verify `index.php` is in the root directory

## Production Deployment

Before deploying to production:

1. Update database credentials in `config/database.php`
2. Ensure Apache mod_rewrite is enabled
3. Set proper file permissions, such as 644 for files and 755 for directories
4. Use HTTPS for secure connections
5. Set up automated database backups
6. Test all forms and database operations
7. Consider compiling Tailwind locally if you do not want to rely on the CDN in production

## License

MIT License
