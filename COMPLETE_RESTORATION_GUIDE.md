# Complete WordPress Site Restoration Guide

This repository contains 100% of everything needed to restore polaris-launchpad.com from scratch.

## Backup Contents

### 1. WordPress Files (`wordpress-complete-backup-20251006.tar.gz`)
- Complete WordPress installation
- All themes, plugins, uploads
- wp-config.php with database settings
- All custom blocks and PHP files

### 2. Database (`polaris-wordpress-database-backup-20251006.sql`)
- Complete MySQL database dump
- All posts, pages, users, settings
- Plugin configurations
- OAuth tokens sanitized for security

### 3. Server Configuration (`server-config-backup-20251006.tar.gz`)
- Nginx configuration files
- Apache configuration files
- SSL certificates (/etc/ssl/, /etc/letsencrypt/)
- System hosts file
- Cron jobs and scheduled tasks

### 4. Environment Documentation
- `software-versions.txt` - PHP, Nginx, MySQL versions
- `active-services-20251006.txt` - Running services
- `dns-records-20251006.txt` - DNS configuration

## Complete Restoration Procedure

### Step 1: Server Setup
```bash
# Install required software (versions from software-versions.txt)
apt update && apt install nginx mysql-server php-fpm php-mysql

# Extract and restore server configurations
tar -xzf server-config-backup-20251006.tar.gz -C /
systemctl reload nginx
```

### Step 2: Database Restoration
```bash
# Create database and user
mysql -u root -p
CREATE DATABASE polaris_launchpad;
CREATE USER 'your_user'@'localhost' IDENTIFIED BY 'your_password';
GRANT ALL PRIVILEGES ON polaris_launchpad.* TO 'your_user'@'localhost';

# Restore database
mysql -u root -p polaris_launchpad < polaris-wordpress-database-backup-20251006.sql
```

### Step 3: WordPress Files
```bash
# Extract WordPress files to web directory
tar -xzf wordpress-complete-backup-20251006.tar.gz -C /var/www/
chown -R www-data:www-data /var/www/wordpress/
chmod -R 755 /var/www/wordpress/
```

### Step 4: DNS and SSL
```bash
# Configure DNS records (see dns-records-20251006.txt)
# Restore SSL certificates from /etc/letsencrypt/
# Or regenerate with: certbot --nginx -d polaris-launchpad.com
```

### Step 5: Services
```bash
# Start required services (see active-services-20251006.txt)
systemctl start nginx mysql php8.1-fpm
systemctl enable nginx mysql php8.1-fpm
```

## Verification
1. Visit https://polaris-launchpad.com
2. Check WordPress admin panel
3. Verify all plugins and themes work
4. Test database connectivity
5. Check SSL certificate validity

## Notes
- Update wp-config.php database credentials if changed
- Regenerate OAuth tokens if needed (sanitized in backup)
- Update file permissions as needed
- Configure firewall and security settings

**Backup Created:** October 6, 2025
**Server IP:** 159.69.15.0
**Domain:** polaris-launchpad.com