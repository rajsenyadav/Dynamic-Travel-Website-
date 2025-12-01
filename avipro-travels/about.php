<?php
// File: about.php
require_once 'config/config.php';
$page_title = 'About Us';
?>

<?php include 'includes/header.php'; ?>

<!-- Page Banner -->
<!-- ADD BANNER IMAGE: assets/images/banners/about-banner.jpg -->
<!-- Recommended: 1920x500, showing team or travel scenes -->
<section class="page-banner" style="background-image: url('assets/images/banners/about-banner.jpg');">
    <div class="banner-overlay"></div>
    <div class="container">
        <h1>About Avipro Travels</h1>
        <div class="breadcrumb">
            <a href="index.php">Home</a>
            <span>/</span>
            <span>About Us</span>
        </div>
    </div>
</section>

<!-- About Content Section -->
<section class="about-content-section">
    <div class="container">
        <div class="about-intro">
            <div class="about-text">
                <h2>Your Trusted Travel Partner</h2>
                <p><?php echo nl2br(htmlspecialchars(get_setting('about_content'))); ?></p>
                <p>At Avipro Travels, we believe that travel is more than just visiting new places – it's about creating unforgettable experiences, discovering diverse cultures, and making memories that last a lifetime. Founded with a passion for exploration and a commitment to excellence, we have been helping travelers discover the beauty of India and beyond.</p>
                <p>Our team of experienced travel professionals works tirelessly to curate the perfect itineraries, ensuring that every journey with us is seamless, enjoyable, and enriching. From pristine beaches to majestic mountains, from vibrant cities to serene countryside, we offer a diverse range of tour packages tailored to your preferences.</p>
            </div>
            <div class="about-image">
                <!-- ADD ABOUT IMAGE: assets/images/about/team-photo.jpg -->
                <!-- Recommended: 800x600, showing your team or office -->
                <img src="assets/images/about/team-photo.jpg" alt="Avipro Travels Team">
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision Section -->
<section class="mission-vision-section">
    <div class="container">
        <div class="mv-grid">
            <div class="mv-card">
                <div class="mv-icon">
                    <i class="fas fa-bullseye"></i>
                </div>
                <h3>Our Mission</h3>
                <p>To provide exceptional travel experiences that exceed expectations, combining quality service, competitive pricing, and unforgettable adventures. We strive to make travel accessible, enjoyable, and meaningful for all our clients.</p>
            </div>
            
            <div class="mv-card">
                <div class="mv-icon">
                    <i class="fas fa-eye"></i>
                </div>
                <h3>Our Vision</h3>
                <p>To become the most trusted and preferred travel agency in India, known for our commitment to customer satisfaction, innovative tour packages, and sustainable tourism practices that benefit local communities.</p>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="why-choose-section">
    <div class="container">
        <div class="section-header">
            <h2>Why Travelers Choose Us</h2>
            <p>Discover what makes Avipro Travels stand out from the rest</p>
        </div>
        
        <div class="choose-grid">
            <div class="choose-item">
                <div class="choose-icon">
                    <i class="fas fa-award"></i>
                </div>
                <h3>10+ Years Experience</h3>
                <p>Over a decade of expertise in crafting memorable travel experiences</p>
            </div>
            
            <div class="choose-item">
                <div class="choose-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3>Expert Team</h3>
                <p>Professional and passionate travel experts at your service</p>
            </div>
            
            <div class="choose-item">
                <div class="choose-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>100% Safe & Secure</h3>
                <p>Your safety and security are our top priorities</p>
            </div>
            
            <div class="choose-item">
                <div class="choose-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h3>24/7 Support</h3>
                <p>Round-the-clock assistance for any travel queries</p>
            </div>
            
            <div class="choose-item">
                <div class="choose-icon">
                    <i class="fas fa-tags"></i>
                </div>
                <h3>Best Prices</h3>
                <p>Competitive rates with no hidden charges</p>
            </div>
            
            <div class="choose-item">
                <div class="choose-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <h3>Customer First</h3>
                <p>Your satisfaction is our success</p>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item">
                <i class="fas fa-users"></i>
                <h3 class="counter">5000+</h3>
                <p>Happy Travelers</p>
            </div>
            
            <div class="stat-item">
                <i class="fas fa-map-marked-alt"></i>
                <h3 class="counter">150+</h3>
                <p>Tour Packages</p>
            </div>
            
            <div class="stat-item">
                <i class="fas fa-globe-asia"></i>
                <h3 class="counter">50+</h3>
                <p>Destinations</p>
            </div>
            
            <div class="stat-item">
                <i class="fas fa-trophy"></i>
                <h3 class="counter">25+</h3>
                <p>Awards Won</p>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<!-- ADD TEAM PHOTOS: assets/images/team/member-[number].jpg -->
<!-- Recommended: 400x400, professional headshots -->
<section class="team-section">
    <div class="container">
        <div class="section-header">
            <h2>Meet Our Team</h2>
            <p>The passionate people behind your perfect journey</p>
        </div>
        
        <div class="team-grid">
            <div class="team-member">
                <div class="member-image">
                    <img src="assets/images/team/member-1.jpg" alt="Team Member">
                    <div class="member-social">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <h3>Amit Kumar</h3>
                <p>Founder & CEO</p>
            </div>
            
            <div class="team-member">
                <div class="member-image">
                    <img src="assets/images/team/member-2.jpg" alt="Team Member">
                    <div class="member-social">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <h3>Priya Sharma</h3>
                <p>Operations Manager</p>
            </div>
            
            <div class="team-member">
                <div class="member-image">
                    <img src="assets/images/team/member-3.jpg" alt="Team Member">
                    <div class="member-social">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <h3>Rahul Singh</h3>
                <p>Tour Coordinator</p>
            </div>
            
            <div class="team-member">
                <div class="member-image">
                    <img src="assets/images/team/member-4.jpg" alt="Team Member">
                    <div class="member-social">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <h3>Neha Gupta</h3>
                <p>Customer Relations</p>
            </div>
        </div>
    </div>
</section>

<!-- Video Section -->
<!-- ADD COMPANY VIDEO: assets/videos/company-intro.mp4 -->
<!-- Recommended: 1920x1080, 1-2 minutes showcasing your services -->
<section class="about-video-section">
    <div class="container">
        <div class="section-header">
            <h2>Watch Our Story</h2>
            <p>Learn more about what drives us</p>
        </div>
        
        <div class="video-container">
            <video controls poster="assets/images/video-thumbs/company-thumb.jpg">
                <source src="assets/videos/company-intro.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2>Ready to Explore with Us?</h2>
            <p>Let's plan your next adventure together</p>
            <div class="cta-buttons">
                <a href="packages.php" class="btn btn-primary">View Packages</a>
                <a href="contact.php" class="btn btn-outline">Contact Us</a>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>