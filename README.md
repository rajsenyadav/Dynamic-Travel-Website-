# 🌍 Avipro Travels

> A dynamic CMS-based travel package booking website built with HTML , CSS ,PHP, MySQL, and JavaScript.


## 🚀 Quick Start

```bash
# 1. Clone repository
git clone https://github.com/yourusername/avipro-travels.git
cd avipro-travels

# 2. Move to XAMPP htdocs
# Windows: C:\xampp\htdocs\
# Mac: /Applications/MAMP/htdocs/

# 3. Start Apache & MySQL in XAMPP

# 4. Create database
# Go to http://localhost/phpmyadmin
# Create database: avipro_travels
# Import: database.sql

# 5. Configure
# Edit config/config.php with your database credentials

# 6. Access
# Frontend: http://localhost/avipro-travels/
# Admin: http://localhost/avipro-travels/admin/
# Login: admin / admin123
```

---

## ✨ Features

- 🎯 **Browse Packages** - Search & filter travel destinations
- 📝 **AJAX Booking** - Submit requests without page reload
- 🔐 **Admin Panel** - Manage packages, bookings, and settings
- 📱 **Responsive** - Works on all devices
- 🛡️ **Secure** - Password hashing, SQL injection prevention, XSS protection

---

## 🛠️ Tech Stack

**Backend:** PHP 7.4+ • MySQL 5.7+  
**Frontend:** HTML5 • CSS3 • JavaScript (Vanilla)  
**Server:** Apache  
**Tools:** XAMPP • FileZilla • phpMyAdmin

---

## 📁 Structure

```
avipro-travels/
├── admin/              # Admin panel & dashboard
├── assets/             # CSS, JS, images, videos
│   ├── css/
│   ├── js/
│   └── images/
├── config/             # Database configuration
├── includes/           # Reusable components (header, footer)
├── *.php              # Frontend pages
└── database.sql       # Database schema
```

---

## ⚙️ Configuration

Edit `config/config.php`:

```php
// Local Development
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'avipro_travels');
define('SITE_URL', 'http://localhost/avipro-travels/');

// Production (after deployment)
define('DB_HOST', 'sql123.infinityfree.com');
define('DB_USER', 'epiz_12345678');
define('DB_PASS', 'your_password');
define('DB_NAME', 'epiz_12345678_avipro');
define('SITE_URL', 'http://your-site.infinityfreeapp.com/');
```

---

## 🗄️ Database

**Tables:** 6 main tables
- `admin_users` - Admin authentication
- `packages` - Tour packages
- `bookings` - Customer bookings
- `site_settings` - Site configuration
- `contact_messages` - Inquiries
- `package_images` - Package gallery

**Sample Data Included:**
- 3 tour packages (Kashmir, Goa, Rajasthan)
- 1 admin user (admin/admin123)
- Site settings

---

## 🌐 Deploy to Free Hosting

### InfinityFree (Recommended)

```bash
# 1. Sign up at infinityfree.net
# 2. Create hosting account
# 3. Update config.php with hosting credentials
# 4. Upload files via FTP to /htdocs/
# 5. Import database via phpMyAdmin
# 6. Done! 🎉
```

**Detailed Guide:** See [DEPLOYMENT_GUIDE.txt](DEPLOYMENT_GUIDE.txt)

**Free Hosting Options:**
- [InfinityFree](https://infinityfree.net) - Unlimited storage
- [000WebHost](https://www.000webhost.com) - 300MB storage
- [FreeHosting.com](https://www.freehosting.com) - 10GB storage

---

## 📸 Screenshots

<details>
<summary>Click to expand</summary>

### Homepage
![Homepage](docs/screenshots/home.png)

### Package Details
![Details](docs/screenshots/details.png)

### Admin Dashboard
![Admin](docs/screenshots/admin.png)

</details>

---

## 🔐 Admin Panel

**URL:** `/admin/`  
**Default Login:** `admin` / `admin123`  
⚠️ **Change password after first login!**

**Features:**
- Dashboard with statistics
- Add/Edit/Delete packages
- View bookings and update status
- Manage site settings
- View contact messages

---

## 🧪 Testing

```bash
# Test booking form
1. Go to packages page
2. Click "Book Now"
3. Fill form and submit
4. Check admin panel for booking

# Test admin panel
1. Go to /admin/
2. Login with credentials
3. Try adding a package
4. Verify it appears on frontend
```

---

## 🐛 Common Issues

<details>
<summary>Click for solutions</summary>

**CSS not loading?**
```bash
# Clear browser cache
Ctrl + F5 (Windows) or Cmd + Shift + R (Mac)
# Or open in Incognito mode
```

**Database connection error?**
```php
// Check config.php has correct credentials
// Verify MySQL is running in XAMPP
// Ensure database 'avipro_travels' exists
```

**Images not showing?**
```bash
# Check database paths: assets/images/packages/name.jpg
# Or use placeholder images (already in code)
```

</details>


## 🤝 Contributing

Contributions welcome! 

```bash
# Fork the repo
# Create feature branch: git checkout -b feature/YourFeature
# Commit changes: git commit -m 'Add YourFeature'
# Push: git push origin feature/YourFeature
# Open Pull Request
```

---

## 👥 Authors
Raj Sen 
Student at VIT BHOPAL UNIVERSITY

---

## 📄 License

MIT License - see [LICENSE](LICENSE) file


## 📞 Support

- **Issues:** [GitHub Issues](../../issues)
- **Email:** mrrajsen2july@gmail.com
- **Docs:** [https://docs.google.com/document/d/1QeIII_V2Z-3qffPIzOWl1OyWhPJQINun6Bz7I_JjZuw/edit?usp=sharing](docs/)

---

## ⭐ Star Us!

If this project helped you, give it a ⭐️

---

## 🗺️ Roadmap

- [ ] Payment gateway integration
- [ ] Email notifications
- [ ] User registration
- [ ] Package reviews
- [ ] Multi-language support

---

**Made with ❤️ by Avipro Travels Team**

*Last Updated: December 2024 • Version 1.0.0*
