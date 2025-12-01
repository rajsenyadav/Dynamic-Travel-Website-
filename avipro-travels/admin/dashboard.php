<?php
// File: admin/dashboard.php
require_once '../config/config.php';

// Check if admin is logged in
if (!is_admin_logged_in()) {
    redirect(ADMIN_URL . 'index.php');
}

$page_title = 'Dashboard';

// Fetch statistics
$stats = [];

// Total packages
$packages_sql = "SELECT COUNT(*) as total FROM packages";
$result = $conn->query($packages_sql);
$stats['total_packages'] = $result->fetch_assoc()['total'];

// Active packages
$active_sql = "SELECT COUNT(*) as total FROM packages WHERE status = 'active'";
$result = $conn->query($active_sql);
$stats['active_packages'] = $result->fetch_assoc()['total'];

// Total bookings
$bookings_sql = "SELECT COUNT(*) as total FROM bookings";
$result = $conn->query($bookings_sql);
$stats['total_bookings'] = $result->fetch_assoc()['total'];

// Pending bookings
$pending_sql = "SELECT COUNT(*) as total FROM bookings WHERE status = 'pending'";
$result = $conn->query($pending_sql);
$stats['pending_bookings'] = $result->fetch_assoc()['total'];

// Recent bookings
$recent_bookings_sql = "SELECT * FROM bookings ORDER BY created_at DESC LIMIT 5";
$recent_bookings = $conn->query($recent_bookings_sql);

include 'includes/header.php';
?>

<div class="dashboard-content">
    <div class="page-header">
        <h1>Dashboard</h1>
        <p>Welcome back, <?php echo htmlspecialchars($_SESSION['admin_name']); ?>!</p>
    </div>
    
    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card blue">
            <div class="stat-icon">
                <i class="fas fa-box"></i>
            </div>
            <div class="stat-info">
                <h3><?php echo $stats['total_packages']; ?></h3>
                <p>Total Packages</p>
            </div>
        </div>
        
        <div class="stat-card green">
            <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-info">
                <h3><?php echo $stats['active_packages']; ?></h3>
                <p>Active Packages</p>
            </div>
        </div>
        
        <div class="stat-card orange">
            <div class="stat-icon">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div class="stat-info">
                <h3><?php echo $stats['total_bookings']; ?></h3>
                <p>Total Bookings</p>
            </div>
        </div>
        
        <div class="stat-card red">
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-info">
                <h3><?php echo $stats['pending_bookings']; ?></h3>
                <p>Pending Bookings</p>
            </div>
        </div>
    </div>
    
    <!-- Recent Bookings -->
    <div class="content-card">
        <div class="card-header">
            <h2>Recent Bookings</h2>
            <a href="bookings.php" class="btn btn-primary btn-sm">View All</a>
        </div>
        
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Destination</th>
                        <th>Travel Date</th>
                        <th>Persons</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($recent_bookings && $recent_bookings->num_rows > 0) {
                        while($booking = $recent_bookings->fetch_assoc()) {
                            $status_class = $booking['status'] == 'pending' ? 'warning' : 
                                          ($booking['status'] == 'confirmed' ? 'success' : 'danger');
                    ?>
                        <tr>
                            <td>#<?php echo $booking['id']; ?></td>
                            <td><?php echo htmlspecialchars($booking['name']); ?></td>
                            <td><?php echo htmlspecialchars($booking['email']); ?></td>
                            <td><?php echo htmlspecialchars($booking['destination']); ?></td>
                            <td><?php echo date('d M Y', strtotime($booking['travel_date'])); ?></td>
                            <td><?php echo $booking['num_persons']; ?></td>
                            <td><span class="badge badge-<?php echo $status_class; ?>"><?php echo ucfirst($booking['status']); ?></span></td>
                            <td><?php echo date('d M Y', strtotime($booking['created_at'])); ?></td>
                            <td>
                                <a href="view-booking.php?id=<?php echo $booking['id']; ?>" class="btn-action" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="9" class="text-center">No bookings found</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="quick-actions">
        <h2>Quick Actions</h2>
        <div class="actions-grid">
            <a href="add-package.php" class="action-card">
                <i class="fas fa-plus-circle"></i>
                <span>Add New Package</span>
            </a>
            <a href="packages.php" class="action-card">
                <i class="fas fa-box"></i>
                <span>Manage Packages</span>
            </a>
            <a href="bookings.php" class="action-card">
                <i class="fas fa-calendar-check"></i>
                <span>View Bookings</span>
            </a>
            <a href="settings.php" class="action-card">
                <i class="fas fa-cog"></i>
                <span>Site Settings</span>
            </a>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>