<?php
// File: package-details.php
require_once 'config/config.php';

// Get package ID
$package_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch package details
$package_sql = "SELECT * FROM packages WHERE id = $package_id AND status = 'active'";
$package_result = $conn->query($package_sql);

if (!$package_result || $package_result->num_rows == 0) {
    header("Location: packages.php");
    exit();
}

$package = $package_result->fetch_assoc();
$page_title = $package['package_name'];

// Fetch package images
$images_sql = "SELECT * FROM package_images WHERE package_id = $package_id ORDER BY image_order ASC";
$images_result = $conn->query($images_sql);
?>

<?php include 'includes/header.php'; ?>

<!-- Package Details Section -->
<section class="package-details-section">
    <div class="container">
        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="index.php">Home</a>
            <span>/</span>
            <a href="packages.php">Packages</a>
            <span>/</span>
            <span><?php echo htmlspecialchars($package['package_name']); ?></span>
        </div>
        
        <div class="package-details-wrapper">
            <!-- Left Content -->
            <div class="package-main-content">
                <!-- Package Header -->
                <div class="package-detail-header">
                    <h1><?php echo htmlspecialchars($package['package_name']); ?></h1>
                    <div class="package-meta-info">
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span>4.5 (120 Reviews)</span>
                        </div>
                        <div class="location">
                            <i class="fas fa-map-marker-alt"></i>
                            <?php echo htmlspecialchars($package['destination']); ?>
                        </div>
                    </div>
                </div>
                
                <!-- Main Image Gallery -->
                <!-- ADD MULTIPLE HIGH-QUALITY IMAGES: assets/images/packages/[package-name]/[1-10].jpg -->
                <div class="package-gallery">
                    <div class="main-image">
                        <img src="<?php echo htmlspecialchars($package['main_image']); ?>" alt="<?php echo htmlspecialchars($package['package_name']); ?>" id="mainImage">
                    </div>
                    <div class="thumbnail-images">
                        <img src="<?php echo htmlspecialchars($package['main_image']); ?>" alt="Thumbnail" class="thumbnail active" onclick="changeImage(this)">
                        <?php
                        if ($images_result && $images_result->num_rows > 0) {
                            while($image = $images_result->fetch_assoc()) {
                                echo '<img src="' . htmlspecialchars($image['image_path']) . '" alt="Thumbnail" class="thumbnail" onclick="changeImage(this)">';
                            }
                        }
                        ?>
                    </div>
                </div>
                
                <!-- Package Overview -->
                <div class="package-section">
                    <h2><i class="fas fa-info-circle"></i> Package Overview</h2>
                    <div class="overview-grid">
                        <div class="overview-item">
                            <i class="fas fa-clock"></i>
                            <div>
                                <h4>Duration</h4>
                                <p><?php echo htmlspecialchars($package['duration']); ?></p>
                            </div>
                        </div>
                        <div class="overview-item">
                            <i class="fas fa-users"></i>
                            <div>
                                <h4>Group Size</h4>
                                <p>10-15 People</p>
                            </div>
                        </div>
                        <div class="overview-item">
                            <i class="fas fa-language"></i>
                            <div>
                                <h4>Languages</h4>
                                <p>English, Hindi</p>
                            </div>
                        </div>
                        <div class="overview-item">
                            <i class="fas fa-calendar"></i>
                            <div>
                                <h4>Available</h4>
                                <p>Year Round</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Description -->
                <div class="package-section">
                    <h2><i class="fas fa-align-left"></i> Description</h2>
                    <p><?php echo nl2br(htmlspecialchars($package['description'])); ?></p>
                </div>
                
                <!-- Itinerary -->
                <?php if (!empty($package['itinerary'])) { ?>
                <div class="package-section">
                    <h2><i class="fas fa-route"></i> Tour Itinerary</h2>
                    <div class="itinerary-list">
                        <?php
                        $itinerary_items = explode("\n", $package['itinerary']);
                        foreach($itinerary_items as $index => $item) {
                            if (trim($item)) {
                                echo '<div class="itinerary-item">';
                                echo '<div class="itinerary-number">' . ($index + 1) . '</div>';
                                echo '<div class="itinerary-content">';
                                echo '<h4>' . htmlspecialchars($item) . '</h4>';
                                echo '</div>';
                                echo '</div>';
                            }
                        }
                        ?>
                    </div>
                </div>
                <?php } ?>
                
                <!-- Inclusions & Exclusions -->
                <div class="package-section">
                    <div class="inclusions-grid">
                        <?php if (!empty($package['inclusions'])) { ?>
                        <div class="inclusions-col">
                            <h2><i class="fas fa-check-circle"></i> Inclusions</h2>
                            <ul class="inclusions-list">
                                <?php
                                $inclusions = explode(',', $package['inclusions']);
                                foreach($inclusions as $inclusion) {
                                    echo '<li><i class="fas fa-check"></i> ' . htmlspecialchars(trim($inclusion)) . '</li>';
                                }
                                ?>
                            </ul>
                        </div>
                        <?php } ?>
                        
                        <?php if (!empty($package['exclusions'])) { ?>
                        <div class="exclusions-col">
                            <h2><i class="fas fa-times-circle"></i> Exclusions</h2>
                            <ul class="exclusions-list">
                                <?php
                                $exclusions = explode(',', $package['exclusions']);
                                foreach($exclusions as $exclusion) {
                                    echo '<li><i class="fas fa-times"></i> ' . htmlspecialchars(trim($exclusion)) . '</li>';
                                }
                                ?>
                            </ul>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                
                <!-- Video Section (if available) -->
                <!-- ADD PACKAGE VIDEO: assets/videos/packages/[package-name]-tour.mp4 -->
                <div class="package-section">
                    <h2><i class="fas fa-play-circle"></i> Tour Video</h2>
                    <div class="package-video">
                        <video controls poster="assets/images/video-thumbs/<?php echo $package['id']; ?>-thumb.jpg">
                            <source src="assets/videos/packages/package-<?php echo $package['id']; ?>.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
                
                <!-- Reviews Section -->
                <div class="package-section">
                    <h2><i class="fas fa-star"></i> Customer Reviews</h2>
                    <div class="reviews-summary">
                        <div class="rating-score">
                            <h3>4.5</h3>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <p>Based on 120 reviews</p>
                        </div>
                    </div>
                    
                    <!-- ADD CUSTOMER PHOTOS: assets/images/reviews/customer-[number].jpg -->
                    <div class="reviews-list">
                        <div class="review-item">
                            <div class="reviewer-info">
                                <img src="assets/images/reviews/customer-1.jpg" alt="Reviewer">
                                <div>
                                    <h4>Rajesh Kumar</h4>
                                    <div class="review-rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <span class="review-date">2 weeks ago</span>
                                </div>
                            </div>
                            <p>"Amazing experience! Everything was perfectly organized. Highly recommended!"</p>
                        </div>
                        
                        <div class="review-item">
                            <div class="reviewer-info">
                                <img src="assets/images/reviews/customer-2.jpg" alt="Reviewer">
                                <div>
                                    <h4>Priya Sharma</h4>
                                    <div class="review-rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <span class="review-date">1 month ago</span>
                                </div>
                            </div>
                            <p>"Great tour package! The guide was knowledgeable and the accommodations were excellent."</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Sidebar -->
            <div class="package-sidebar">
                <!-- Booking Card -->
                <div class="booking-card">
                    <div class="price-section">
                        <h3>₹<?php echo number_format($package['price']); ?></h3>
                        <span>per person</span>
                    </div>
                    
                    <form action="booking.php" method="GET" class="quick-booking-form">
                        <input type="hidden" name="package_id" value="<?php echo $package['id']; ?>">
                        <input type="hidden" name="package_name" value="<?php echo htmlspecialchars($package['package_name']); ?>">
                        
                        <div class="form-group">
                            <label><i class="fas fa-calendar"></i> Travel Date</label>
                            <input type="date" name="date" required min="<?php echo date('Y-m-d'); ?>">
                        </div>
                        
                        <div class="form-group">
                            <label><i class="fas fa-users"></i> Number of Persons</label>
                            <input type="number" name="persons" min="1" max="50" value="2" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-block">Book Now</button>
                    </form>
                    
                    <div class="booking-features">
                        <div class="feature"><i class="fas fa-check"></i> Free Cancellation</div>
                        <div class="feature"><i class="fas fa-check"></i> Reserve Now, Pay Later</div>
                        <div class="feature"><i class="fas fa-check"></i> Best Price Guarantee</div>
                    </div>
                </div>
                
                <!-- Need Help Card -->
                <div class="help-card">
                    <h3>Need Help?</h3>
                    <p>Our travel experts are here to assist you</p>
                    <a href="tel:<?php echo get_setting('contact_phone'); ?>" class="contact-btn">
                        <i class="fas fa-phone"></i> Call Us
                    </a>
                    <a href="contact.php" class="contact-btn">
                        <i class="fas fa-envelope"></i> Send Enquiry
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function changeImage(element) {
    document.getElementById('mainImage').src = element.src;
    document.querySelectorAll('.thumbnail').forEach(thumb => thumb.classList.remove('active'));
    element.classList.add('active');
}
</script>

<?php include 'includes/footer.php'; ?>