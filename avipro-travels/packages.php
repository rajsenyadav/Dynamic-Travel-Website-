<?php
// File: packages.php - FIXED VERSION WITH IMAGE HANDLING
require_once 'config/config.php';
$page_title = 'Tour Packages';

// Handle search and filters
$where_clause = "WHERE status = 'active'";
$search_destination = isset($_GET['destination']) ? sanitize_input($_GET['destination']) : '';
$search_date = isset($_GET['date']) ? sanitize_input($_GET['date']) : '';

if (!empty($search_destination)) {
    $where_clause .= " AND (destination LIKE '%$search_destination%' OR package_name LIKE '%$search_destination%')";
}

// Fetch all packages
$packages_sql = "SELECT * FROM packages $where_clause ORDER BY featured DESC, created_at DESC";
$packages_result = $conn->query($packages_sql);
?>

<?php include 'includes/header.php'; ?>

<!-- Page Banner -->
<section class="page-banner" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); height: 300px;">
    <div class="banner-overlay"></div>
    <div class="container">
        <h1>Tour Packages</h1>
        <div class="breadcrumb">
            <a href="index.php">Home</a>
            <span>/</span>
            <span>Tour Packages</span>
        </div>
    </div>
</section>

<!-- Search & Filter Section -->
<section class="search-filter-section">
    <div class="container">
        <div class="search-box">
            <form action="packages.php" method="GET" class="search-form">
                <div class="search-input">
                    <i class="fas fa-map-marker-alt"></i>
                    <input type="text" name="destination" placeholder="Search destination..." value="<?php echo htmlspecialchars($search_destination); ?>">
                </div>
                <div class="search-input">
                    <i class="fas fa-calendar"></i>
                    <input type="date" name="date" value="<?php echo htmlspecialchars($search_date); ?>">
                </div>
                <div class="search-input">
                    <i class="fas fa-rupee-sign"></i>
                    <select name="price_range">
                        <option value="">Price Range</option>
                        <option value="0-15000">Under ₹15,000</option>
                        <option value="15000-25000">₹15,000 - ₹25,000</option>
                        <option value="25000-40000">₹25,000 - ₹40,000</option>
                        <option value="40000+">Above ₹40,000</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Search
                </button>
            </form>
        </div>
    </div>
</section>

<!-- Packages Listing Section -->
<section class="packages-listing-section">
    <div class="container">
        <?php if (!empty($search_destination)) { ?>
            <div class="search-results-info">
                <h3>Search Results for "<?php echo htmlspecialchars($search_destination); ?>"</h3>
                <a href="packages.php" class="btn-link">Clear Search</a>
            </div>
        <?php } ?>
        
        <div class="packages-grid">
            <?php
            if ($packages_result && $packages_result->num_rows > 0) {
                while($package = $packages_result->fetch_assoc()) {
                    // FIX: Handle image path
                    $image_path = $package['main_image'];
                    
                    // Check if path starts with http (external URL)
                    if (strpos($image_path, 'http') === 0) {
                        $full_image_path = $image_path;
                    } 
                    // Check if path starts with assets/
                    elseif (strpos($image_path, 'assets/') === 0) {
                        $full_image_path = SITE_URL . $image_path;
                    }
                    // Otherwise add the full path
                    else {
                        $full_image_path = SITE_URL . 'assets/images/packages/' . $image_path;
                    }
                    
                    // Check if file actually exists
                    $image_file = str_replace(SITE_URL, $_SERVER['DOCUMENT_ROOT'] . '/avipro-travels/', $full_image_path);
                    
                    // If image doesn't exist, use placeholder
                    if (!file_exists($image_file) || empty($image_path)) {
                        $full_image_path = 'https://via.placeholder.com/800x600/667eea/ffffff?text=' . urlencode($package['destination']);
                    }
            ?>
                <div class="package-card">
                    <div class="package-image">
                        <img src="<?php echo htmlspecialchars($full_image_path); ?>" 
                             alt="<?php echo htmlspecialchars($package['package_name']); ?>"
                             onerror="this.src='https://via.placeholder.com/800x600/667eea/ffffff?text=<?php echo urlencode($package['destination']); ?>'">
                        <?php if ($package['featured']): ?>
                            <div class="package-badge">Featured</div>
                        <?php endif; ?>
                        <div class="package-overlay">
                            <a href="package-details.php?id=<?php echo $package['id']; ?>" class="overlay-btn">View Details</a>
                        </div>
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
                                <span>(4.5)</span>
                            </div>
                        </div>
                        <div class="package-meta">
                            <span><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($package['destination']); ?></span>
                            <span><i class="fas fa-clock"></i> <?php echo htmlspecialchars($package['duration']); ?></span>
                        </div>
                        <p class="package-description">
                            <?php echo htmlspecialchars(substr($package['description'], 0, 120)) . '...'; ?>
                        </p>
                        <div class="package-features">
                            <span><i class="fas fa-utensils"></i> Meals</span>
                            <span><i class="fas fa-hotel"></i> Hotel</span>
                            <span><i class="fas fa-bus"></i> Transport</span>
                            <span><i class="fas fa-camera"></i> Sightseeing</span>
                        </div>
                        <div class="package-footer">
                            <div class="package-price">
                                <span class="price-label">Starting from</span>
                                <span class="price-amount">₹<?php echo number_format($package['price']); ?></span>
                                <span class="price-per">per person</span>
                            </div>
                            <div class="package-actions">
                                <a href="package-details.php?id=<?php echo $package['id']; ?>" class="btn btn-primary">View Details</a>
                                <a href="booking.php?package_id=<?php echo $package['id']; ?>" class="btn btn-outline" style="border: 2px solid #007bff; color: #007bff;">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                }
            } else {
            ?>
                <div class="no-results">
                    <i class="fas fa-search"></i>
                    <h3>No packages found</h3>
                    <p>Try adjusting your search criteria or browse all packages</p>
                    <a href="packages.php" class="btn btn-primary">View All Packages</a>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>

<!-- Popular Destinations Section -->
<section class="destinations-section">
    <div class="container">
        <div class="section-header">
            <h2>Popular Destinations</h2>
            <p>Explore our most sought-after travel destinations</p>
        </div>
        
        <div class="destinations-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
            <?php
            $destinations = [
                ['name' => 'Kashmir', 'tagline' => 'Paradise on Earth', 'image' => 'kashmir.jpg'],
                ['name' => 'Goa', 'tagline' => 'Beach Paradise', 'image' => 'goa.jpg'],
                ['name' => 'Rajasthan', 'tagline' => 'Royal Heritage', 'image' => 'rajasthan.jpg'],
                ['name' => 'Kerala', 'tagline' => 'God\'s Own Country', 'image' => 'kerala.jpg'],
                ['name' => 'Himachal', 'tagline' => 'Mountain Magic', 'image' => 'himachal.jpg'],
                ['name' => 'Uttarakhand', 'tagline' => 'Land of Gods', 'image' => 'uttarakhand.jpg']
            ];
            
            foreach ($destinations as $dest):
                // Check if destination image exists
                $dest_image = SITE_URL . 'assets/images/destinations/' . $dest['image'];
                $dest_file = $_SERVER['DOCUMENT_ROOT'] . '/avipro-travels/assets/images/destinations/' . $dest['image'];
                
                // Use placeholder if image doesn't exist
                if (!file_exists($dest_file)) {
                    $dest_image = 'https://via.placeholder.com/600x400/764ba2/ffffff?text=' . urlencode($dest['name']);
                }
            ?>
            <div class="destination-card" style="position: relative; height: 300px; border-radius: 15px; overflow: hidden; cursor: pointer;">
                <img src="<?php echo $dest_image; ?>" 
                     alt="<?php echo $dest['name']; ?>"
                     style="width: 100%; height: 100%; object-fit: cover;"
                     onerror="this.src='https://via.placeholder.com/600x400/764ba2/ffffff?text=<?php echo urlencode($dest['name']); ?>'">
                <div class="destination-overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(to bottom, transparent, rgba(0,0,0,0.8)); display: flex; flex-direction: column; justify-content: flex-end; padding: 30px; color: white;">
                    <h3 style="font-size: 28px; margin-bottom: 5px;"><?php echo $dest['name']; ?></h3>
                    <p style="margin-bottom: 15px; opacity: 0.9;"><?php echo $dest['tagline']; ?></p>
                    <a href="packages.php?destination=<?php echo $dest['name']; ?>" class="btn btn-outline">Explore</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 80px 0; text-align: center; color: white;">
    <div class="container">
        <div class="cta-content">
            <h2 style="font-size: 36px; margin-bottom: 15px;">Can't Find What You're Looking For?</h2>
            <p style="font-size: 18px; margin-bottom: 30px;">Contact us for customized tour packages tailored to your preferences</p>
            <a href="contact.php" class="btn btn-primary btn-lg" style="background: white; color: #667eea;">Get Custom Package</a>
        </div>
    </div>
</section>

<style>
.package-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s;
}

.package-card:hover .package-overlay {
    opacity: 1;
}

.overlay-btn {
    background: white;
    color: #007bff;
    padding: 12px 30px;
    border-radius: 50px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s;
}

.overlay-btn:hover {
    background: #007bff;
    color: white;
    transform: scale(1.05);
}

.package-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.package-features {
    display: flex;
    gap: 15px;
    margin-bottom: 20px;
    flex-wrap: wrap;
    font-size: 14px;
    color: #6c757d;
}

.search-results-info {
    background: #e7f3ff;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.btn-link {
    color: #007bff;
    text-decoration: underline;
}
</style>

<?php include 'includes/footer.php'; ?>