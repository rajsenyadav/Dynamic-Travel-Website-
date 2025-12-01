<?php
// File: includes/header.php
// COMPLETE SITE HEADER WITH CSS FIX

if (!isset($page_title)) {
    $page_title = 'Avipro Travels';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - Avipro Travels</title>
    
    <!-- CSS Files - MULTIPLE METHODS TO ENSURE LOADING -->
    
    <!-- Method 1: Using SITE_URL constant -->
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/css/style.css">
    
    <!-- Method 2: Absolute path (uncomment if Method 1 doesn't work) -->
    <!-- <link rel="stylesheet" href="/avipro-travels/assets/css/style.css"> -->
    
    <!-- Method 3: Relative path (uncomment if above don't work) -->
    <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Inline Critical CSS (loads immediately) -->
    <style>
        /* Emergency CSS if external file doesn't load */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Poppins', Arial, sans-serif; 
            line-height: 1.6;
        }
        .container { 
            max-width: 1200px; 
            margin: 0 auto; 
            padding: 0 20px; 
        }
    </style>
</head>
<body>
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="top-bar-content">
                <div class="contact-info">
                    <span><i class="fas fa-phone"></i> <?php echo get_setting('contact_phone'); ?></span>
                    <span><i class="fas fa-envelope"></i> <?php echo get_setting('contact_email'); ?></span>
                </div>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <div class="nav-wrapper">
                <div class="logo">
                    <a href="<?php echo SITE_URL; ?>index.php">
                        <i class="fas fa-plane-departure"></i>
                        <span>Avipro Travels</span>
                    </a>
                </div>
                
                <div class="nav-toggle" id="navToggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>

                <ul class="nav-menu" id="navMenu">
                    <li><a href="<?php echo SITE_URL; ?>index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">Home</a></li>
                    <li><a href="<?php echo SITE_URL; ?>about.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?>">About Us</a></li>
                    <li><a href="<?php echo SITE_URL; ?>packages.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'packages.php' ? 'active' : ''; ?>">Tour Packages</a></li>
                    <li><a href="<?php echo SITE_URL; ?>booking.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'booking.php' ? 'active' : ''; ?>">Book Now</a></li>
                    <li><a href="<?php echo SITE_URL; ?>contact.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>