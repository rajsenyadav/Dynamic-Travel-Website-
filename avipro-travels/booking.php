<?php
// File: booking.php
require_once 'config/config.php';
$page_title = 'Book Your Trip';

// Get package details if coming from package page
$package_id = isset($_GET['package_id']) ? intval($_GET['package_id']) : 0;
$selected_package = '';
$travel_date = isset($_GET['date']) ? $_GET['date'] : '';
$num_persons = isset($_GET['persons']) ? $_GET['persons'] : '2';

if ($package_id > 0) {
    $package_sql = "SELECT package_name, destination FROM packages WHERE id = $package_id";
    $package_result = $conn->query($package_sql);
    if ($package_result && $package_result->num_rows > 0) {
        $package_data = $package_result->fetch_assoc();
        $selected_package = $package_data['package_name'];
    }
}

// Fetch all active packages for dropdown
$all_packages_sql = "SELECT id, package_name, destination FROM packages WHERE status = 'active' ORDER BY package_name ASC";
$all_packages_result = $conn->query($all_packages_sql);
?>

<?php include 'includes/header.php'; ?>

<!-- Page Banner -->
<!-- ADD BANNER IMAGE: assets/images/banners/booking-banner.jpg -->
<section class="page-banner" style="background-image: url('assets/images/banners/booking-banner.jpg');">
    <div class="banner-overlay"></div>
    <div class="container">
        <h1>Book Your Dream Trip</h1>
        <div class="breadcrumb">
            <a href="index.php">Home</a>
            <span>/</span>
            <span>Booking</span>
        </div>
    </div>
</section>

<!-- Booking Form Section -->
<section class="booking-form-section">
    <div class="container">
        <div class="booking-wrapper">
            <!-- Booking Form -->
            <div class="booking-form-container">
                <div class="form-header">
                    <h2>Fill in Your Details</h2>
                    <p>Complete the form below and our travel expert will contact you shortly</p>
                </div>
                
                <div id="formMessage"></div>
                
                <form id="bookingForm" class="booking-form" novalidate>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Full Name <span class="required">*</span></label>
                            <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                            <span class="error-message"></span>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email Address <span class="required">*</span></label>
                            <input type="email" id="email" name="email" placeholder="your.email@example.com" required>
                            <span class="error-message"></span>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone">Phone Number <span class="required">*</span></label>
                            <input type="tel" id="phone" name="phone" placeholder="+91 9876543210" required>
                            <span class="error-message"></span>
                        </div>
                        
                        <div class="form-group">
                            <label for="destination">Select Package/Destination <span class="required">*</span></label>
                            <select id="destination" name="destination" required>
                                <option value="">Choose a package...</option>
                                <?php
                                if ($all_packages_result && $all_packages_result->num_rows > 0) {
                                    while($pkg = $all_packages_result->fetch_assoc()) {
                                        $selected = ($pkg['id'] == $package_id) ? 'selected' : '';
                                        echo '<option value="' . htmlspecialchars($pkg['package_name']) . '" data-id="' . $pkg['id'] . '" ' . $selected . '>';
                                        echo htmlspecialchars($pkg['package_name']) . ' (' . htmlspecialchars($pkg['destination']) . ')';
                                        echo '</option>';
                                    }
                                }
                                ?>
                                <option value="Custom Package">Custom Package (I'll specify in message)</option>
                            </select>
                            <span class="error-message"></span>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="travel_date">Preferred Travel Date <span class="required">*</span></label>
                            <input type="date" id="travel_date" name="travel_date" value="<?php echo htmlspecialchars($travel_date); ?>" required min="<?php echo date('Y-m-d'); ?>">
                            <span class="error-message"></span>
                        </div>
                        
                        <div class="form-group">
                            <label for="num_persons">Number of Persons <span class="required">*</span></label>
                            <input type="number" id="num_persons" name="num_persons" value="<?php echo htmlspecialchars($num_persons); ?>" min="1" max="50" placeholder="2" required>
                            <span class="error-message"></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Additional Requirements/Message</label>
                        <textarea id="message" name="message" rows="5" placeholder="Tell us about your preferences, special requirements, or any questions you have..."></textarea>
                        <span class="error-message"></span>
                    </div>
                    
                    <div class="form-group checkbox-group">
                        <label class="checkbox-label">
                            <input type="checkbox" id="terms" name="terms" required>
                            <span>I agree to the <a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy</a></span>
                        </label>
                        <span class="error-message"></span>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-lg btn-block" id="submitBtn">
                        <i class="fas fa-paper-plane"></i> Submit Booking Request
                    </button>
                </form>
            </div>
            
            <!-- Info Sidebar -->
            <div class="booking-info-sidebar">
                <!-- Contact Info Card -->
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3>Need Assistance?</h3>
                    <p>Our travel experts are available 24/7 to help you plan the perfect trip</p>
                    <div class="contact-details">
                        <a href="tel:<?php echo get_setting('contact_phone'); ?>">
                            <i class="fas fa-phone"></i> <?php echo get_setting('contact_phone'); ?>
                        </a>
                        <a href="mailto:<?php echo get_setting('contact_email'); ?>">
                            <i class="fas fa-envelope"></i> <?php echo get_setting('contact_email'); ?>
                        </a>
                    </div>
                </div>
                
                <!-- Why Book With Us -->
                <div class="info-card">
                    <h3>Why Book With Us?</h3>
                    <ul class="benefits-list">
                        <li><i class="fas fa-check-circle"></i> Best Price Guarantee</li>
                        <li><i class="fas fa-check-circle"></i> Free Cancellation</li>
                        <li><i class="fas fa-check-circle"></i> 24/7 Customer Support</li>
                        <li><i class="fas fa-check-circle"></i> Secure Payment</li>
                        <li><i class="fas fa-check-circle"></i> Instant Confirmation</li>
                        <li><i class="fas fa-check-circle"></i> Expert Local Guides</li>
                    </ul>
                </div>
                
                <!-- Booking Process -->
                <div class="info-card">
                    <h3>Booking Process</h3>
                    <div class="process-steps">
                        <div class="step">
                            <div class="step-number">1</div>
                            <div class="step-content">
                                <h4>Submit Request</h4>
                                <p>Fill in the booking form</p>
                            </div>
                        </div>
                        <div class="step">
                            <div class="step-number">2</div>
                            <div class="step-content">
                                <h4>Get Quote</h4>
                                <p>Receive detailed quote via email</p>
                            </div>
                        </div>
                        <div class="step">
                            <div class="step-number">3</div>
                            <div class="step-content">
                                <h4>Confirm Booking</h4>
                                <p>Review and confirm your trip</p>
                            </div>
                        </div>
                        <div class="step">
                            <div class="step-number">4</div>
                            <div class="step-content">
                                <h4>Enjoy Travel</h4>
                                <p>Pack bags and start your journey</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Testimonial -->
                <!-- ADD TESTIMONIAL IMAGE: assets/images/testimonials/booking-testimonial.jpg -->
                <div class="info-card testimonial-card">
                    <div class="testimonial-quote">
                        <i class="fas fa-quote-left"></i>
                    </div>
                    <p>"Avipro Travels made our Kashmir trip absolutely wonderful. The booking process was smooth and hassle-free. Highly recommended!"</p>
                    <div class="testimonial-author">
                        <img src="assets/images/testimonials/booking-testimonial.jpg" alt="Customer">
                        <div>
                            <h4>Amit & Family</h4>
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo SITE_URL; ?>assets/js/booking.js"></script>

<?php include 'includes/footer.php'; ?>