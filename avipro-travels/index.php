<?php
// File: index.php
require_once 'config/config.php';
$page_title = 'Home';

// Fetch featured packages
$featured_sql = "SELECT * FROM packages WHERE featured = 1 AND status = 'active' LIMIT 6";
$featured_result = $conn->query($featured_sql);
?>

<?php include 'includes/header.php'; ?>

<!-- Hero Section with Video Background -->
<!-- ADD YOUR HERO VIDEO HERE: assets/videos/hero-banner.mp4 -->
<!-- Recommended: 1920x1080, MP4 format, 10-20 seconds loop -->
<section class="hero-section">
    <div class="hero-video-container">
        <video autoplay muted loop playsinline class="hero-video">
            <source src="assets/videos/hero-banner.mp4" type="video/mp4">
            <!-- Fallback image if video doesn't load -->
            Your browser does not support the video tag.
        </video>
        <div class="hero-overlay"></div>
    </div>
    
    <div class="hero-content">
        <div class="container">
            <h1 class="hero-title">Discover Your Next Adventure</h1>
            <p class="hero-subtitle">Explore the world with Avipro Travels - Your Journey, Our Passion</p>
            <div class="hero-buttons">
                <a href="packages.php" class="btn btn-primary">Explore Packages</a>
                <a href="booking.php" class="btn btn-outline">Book Now</a>
            </div>
        </div>
    </div>
    
    <!-- Scroll Down Indicator -->
    <div class="scroll-indicator">
        <i class="fas fa-chevron-down"></i>
    </div>
</section>

<!-- Search Section -->
<section class="search-section">
    <div class="container">
        <div class="search-box">
            <form action="packages.php" method="GET" class="search-form">
                <div class="search-input">
                    <i class="fas fa-map-marker-alt"></i>
                    <input type="text" name="destination" placeholder="Where do you want to go?">
                </div>
                <div class="search-input">
                    <i class="fas fa-calendar"></i>
                    <input type="date" name="date" placeholder="Travel Date">
                </div>
                <div class="search-input">
                    <i class="fas fa-users"></i>
                    <select name="persons">
                        <option value="">Number of Persons</option>
                        <option value="1">1 Person</option>
                        <option value="2">2 Persons</option>
                        <option value="3-5">3-5 Persons</option>
                        <option value="6+">6+ Persons</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Search
                </button>
            </form>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="features-section">
    <div class="container">
        <div class="section-header">
            <h2>Why Choose Avipro Travels?</h2>
            <p>We make your travel dreams come true with our exceptional services</p>
        </div>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-globe-asia"></i>
                </div>
                <h3>Best Destinations</h3>
                <p>Curated selection of breathtaking destinations across India and beyond</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>
                <h3>Affordable Prices</h3>
                <p>Competitive pricing with no hidden costs. Best value for your money</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3>Expert Guides</h3>
                <p>Professional and experienced tour guides for memorable experiences</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h3>24/7 Support</h3>
                <p>Round-the-clock customer support for your peace of mind</p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Packages Section -->
<section class="packages-section">
    <div class="container">
        <div class="section-header">
            <h2>Featured Tour Packages</h2>
            <p>Discover our most popular and exciting travel packages</p>
        </div>
        
        <div class="packages-grid">
            <?php
            if ($featured_result && $featured_result->num_rows > 0) {
                while($package = $featured_result->fetch_assoc()) {
            ?>
                <!-- ADD PACKAGE IMAGES: assets/images/packages/[package-name].jpg -->
                <!-- Recommended: 800x600, high quality, showing destination highlights -->
                <div class="package-card">
                    <div class="package-image">
                        <img src="<?php echo $package['main_image']; ?>" alt="<?php echo htmlspecialchars($package['package_name']); ?>">
                        <div class="package-badge">Featured</div>
                    </div>
                    <div class="package-content">
                        <div class="package-header">
                            <h3><?php echo htmlspecialchars($package['package_name']); ?></h3>
                            <div class="package-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                        <div class="package-meta">
                            <span><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($package['destination']); ?></span>
                            <span><i class="fas fa-clock"></i> <?php echo htmlspecialchars($package['duration']); ?></span>
                        </div>
                        <p class="package-description">
                            <?php echo htmlspecialchars(substr($package['description'], 0, 120)) . '...'; ?>
                        </p>
                        <div class="package-footer">
                            <div class="package-price">
                                <span class="price-label">Starting from</span>
                                <span class="price-amount">₹<?php echo number_format($package['price']); ?></span>
                            </div>
                            <a href="package-details.php?id=<?php echo $package['id']; ?>" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            <?php
                }
            } else {
            ?>
                <p class="no-packages">No featured packages available at the moment.</p>
            <?php
            }
            ?>
        </div>
        
        <div class="section-footer">
            <a href="packages.php" class="btn btn-outline">View All Packages</a>
        </div>
    </div>
</section>

<!-- Video Gallery Section -->
<!-- ADD PROMOTIONAL VIDEOS: assets/videos/destination-[name].mp4 -->
<!-- Recommended: Multiple 1280x720 videos showcasing different destinations -->
<section class="video-gallery-section">
    <div class="container">
        <div class="section-header">
            <h2>Experience the Beauty</h2>
            <p>Watch our destination highlights and customer experiences</p>
        </div>
        
        <div class="video-grid">
            <div class="video-item">
                <video controls poster="assets/images/video-thumbs/kashmir-thumb.jpg">
                    <source src="assets/videos/kashmir-highlight.mp4" type="video/mp4">
                </video>
                <h3>Kashmir Valley</h3>
            </div>
            
            <div class="video-item">
                <video controls poster="assets/images/video-thumbs/goa-thumb.jpg">
                    <source src="assets/videos/goa-beaches.mp4" type="video/mp4">
                </video>
                <h3>Goa Beaches</h3>
            </div>
            
            <div class="video-item">
                <video controls poster="assets/images/video-thumbs/rajasthan-thumb.jpg">
                    <source src="assets/videos/rajasthan-heritage.mp4" type="video/mp4">
                </video>
                <h3>Rajasthan Heritage</h3>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<!-- ADD CUSTOMER PHOTOS: assets/images/testimonials/customer-[number].jpg -->
<section class="testimonials-section">
    <div class="container">
        <div class="section-header">
            <h2>What Our Travelers Say</h2>
            <p>Read reviews from our happy customers</p>
        </div>
        
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div class="testimonial-header">
                    <img src="assets/images/testimonials/customer-1.jpg" alt="Customer">
                    <div>
                        <h4>Priya Sharma</h4>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                <p>"Amazing experience with Avipro Travels! The Kashmir tour was perfectly organized. Every detail was taken care of. Highly recommended!"</p>
            </div>
            
            <div class="testimonial-card">
                <div class="testimonial-header">
                    <img src="assets/images/testimonials/customer-2.jpg" alt="Customer">
                    <div>
                        <h4>Rajesh Kumar</h4>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                <p>"Best travel agency in Patna! Professional service, great prices, and wonderful destinations. Our Goa trip was unforgettable!"</p>
            </div>
            
            <div class="testimonial-card">
                <div class="testimonial-header">
                    <img src="assets/images/testimonials/customer-3.jpg" alt="Customer">
                    <div>
                        <h4>Anjali Singh</h4>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
                <p>"Excellent tour packages and customer service. The team was very responsive and made our Rajasthan trip smooth and enjoyable!"</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2>Ready to Start Your Journey?</h2>
            <p>Book your dream vacation today and create memories that last a lifetime</p>
            <a href="booking.php" class="btn btn-primary btn-lg">Book Your Trip Now</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>