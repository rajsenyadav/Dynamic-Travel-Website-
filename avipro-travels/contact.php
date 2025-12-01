<?php
// File: contact.php
require_once 'config/config.php';
$page_title = 'Contact Us';
?>

<?php include 'includes/header.php'; ?>

<!-- Page Banner -->
<!-- ADD BANNER IMAGE: assets/images/banners/contact-banner.jpg -->
<section class="page-banner" style="background-image: url('assets/images/banners/contact-banner.jpg');">
    <div class="banner-overlay"></div>
    <div class="container">
        <h1>Contact Us</h1>
        <div class="breadcrumb">
            <a href="index.php">Home</a>
            <span>/</span>
            <span>Contact</span>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section">
    <div class="container">
        <div class="contact-wrapper">
            <!-- Contact Form -->
            <div class="contact-form-container">
                <div class="section-header">
                    <h2>Get In Touch</h2>
                    <p>Have questions? We'd love to hear from you. Send us a message!</p>
                </div>
                
                <div id="contactMessage"></div>
                
                <form id="contactForm" class="contact-form">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="contact_name">Your Name <span class="required">*</span></label>
                            <input type="text" id="contact_name" name="name" placeholder="John Doe" required>
                            <span class="error-message"></span>
                        </div>
                        
                        <div class="form-group">
                            <label for="contact_email">Your Email <span class="required">*</span></label>
                            <input type="email" id="contact_email" name="email" placeholder="john@example.com" required>
                            <span class="error-message"></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact_subject">Subject <span class="required">*</span></label>
                        <input type="text" id="contact_subject" name="subject" placeholder="What's your query about?" required>
                        <span class="error-message"></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact_message">Your Message <span class="required">*</span></label>
                        <textarea id="contact_message" name="message" rows="6" placeholder="Write your message here..." required></textarea>
                        <span class="error-message"></span>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-lg" id="contactSubmitBtn">
                        <i class="fas fa-paper-plane"></i> Send Message
                    </button>
                </form>
            </div>
            
            <!-- Contact Info -->
            <div class="contact-info-container">
                <div class="contact-info-card">
                    <div class="info-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h3>Visit Us</h3>
                    <p><?php echo nl2br(htmlspecialchars(get_setting('contact_address'))); ?></p>
                </div>
                
                <div class="contact-info-card">
                    <div class="info-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <h3>Call Us</h3>
                    <p><?php echo htmlspecialchars(get_setting('contact_phone')); ?></p>
                    <p>Mon - Sat: 9:00 AM - 6:00 PM</p>
                </div>
                
                <div class="contact-info-card">
                    <div class="info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h3>Email Us</h3>
                    <p><?php echo htmlspecialchars(get_setting('contact_email')); ?></p>
                    <p>We'll respond within 24 hours</p>
                </div>
                
                <div class="contact-info-card">
                    <div class="info-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3>Working Hours</h3>
                    <p>Monday - Saturday</p>
                    <p>9:00 AM - 6:00 PM</p>
                    <p class="closed">Sunday: Closed</p>
                </div>
                
                <div class="social-connect">
                    <h3>Connect With Us</h3>
                    <div class="social-links-large">
                        <a href="#" class="social-link facebook">
                            <i class="fab fa-facebook-f"></i>
                            <span>Facebook</span>
                        </a>
                        <a href="#" class="social-link instagram">
                            <i class="fab fa-instagram"></i>
                            <span>Instagram</span>
                        </a>
                        <a href="#" class="social-link twitter">
                            <i class="fab fa-twitter"></i>
                            <span>Twitter</span>
                        </a>
                        <a href="#" class="social-link youtube">
                            <i class="fab fa-youtube"></i>
                            <span>YouTube</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="map-section">
    <div class="container">
        <div class="section-header">
            <h2>Find Us On Map</h2>
            <p>Visit our office or reach out online</p>
        </div>
    </div>
    <!-- ADD YOUR GOOGLE MAPS EMBED CODE HERE -->
    <!-- Go to Google Maps, search your location, click Share > Embed a map -->
    <div class="map-container">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d115681.42169249728!2d85.06491494335938!3d25.594095!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f29937c52d4f05%3A0x831a0e05f607b270!2sPatna%2C%20Bihar!5e0!3m2!1sen!2sin!4v1234567890123" 
            width="100%" 
            height="450" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section">
    <div class="container">
        <div class="section-header">
            <h2>Frequently Asked Questions</h2>
            <p>Quick answers to questions you may have</p>
        </div>
        
        <div class="faq-list">
            <div class="faq-item">
                <div class="faq-question">
                    <h3>How do I book a tour package?</h3>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>You can book a tour package by visiting our Packages page, selecting your preferred destination, and filling out the booking form. Our team will contact you within 24 hours with a detailed quote.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h3>What is included in the tour packages?</h3>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Our packages typically include accommodation, meals (as specified), transportation, sightseeing tours, and a professional guide. Specific inclusions vary by package and are clearly listed on each package details page.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h3>Can I customize my tour package?</h3>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Absolutely! We offer customized tour packages tailored to your preferences, budget, and schedule. Contact us with your requirements, and we'll create a personalized itinerary for you.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h3>What is your cancellation policy?</h3>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>We offer free cancellation up to 15 days before the travel date. Cancellations made 7-14 days before travel incur a 25% charge, and within 7 days, a 50% charge applies. No refunds for cancellations within 48 hours of travel.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h3>Do you provide travel insurance?</h3>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Yes, we can arrange comprehensive travel insurance for your trip. It's highly recommended for international travel and optional for domestic tours. Discuss this with our team when booking.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo SITE_URL; ?>assets/js/contact.js"></script>

<?php include 'includes/footer.php'; ?>