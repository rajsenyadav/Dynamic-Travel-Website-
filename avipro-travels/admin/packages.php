<?php
// File: admin/packages.php
require_once '../config/config.php';

if (!is_admin_logged_in()) {
    redirect(ADMIN_URL . 'index.php');
}

$page_title = 'Manage Packages';

// Handle delete
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $delete_sql = "DELETE FROM packages WHERE id = $id";
    if ($conn->query($delete_sql)) {
        $_SESSION['success_message'] = 'Package deleted successfully!';
    } else {
        $_SESSION['error_message'] = 'Error deleting package: ' . $conn->error;
    }
    redirect(ADMIN_URL . 'packages.php');
}

// Handle status toggle
if (isset($_GET['action']) && $_GET['action'] == 'toggle_status' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $toggle_sql = "UPDATE packages SET status = IF(status='active', 'inactive', 'active') WHERE id = $id";
    if ($conn->query($toggle_sql)) {
        $_SESSION['success_message'] = 'Package status updated!';
    }
    redirect(ADMIN_URL . 'packages.php');
}

// Fetch all packages
$packages_sql = "SELECT * FROM packages ORDER BY created_at DESC";
$packages_result = $conn->query($packages_sql);

include 'includes/header.php';
?>

<div class="dashboard-content">
    <div class="page-header">
        <h1>Manage Packages</h1>
        <a href="add-package.php" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Package
        </a>
    </div>
    
    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <?php 
                echo $_SESSION['success_message']; 
                unset($_SESSION['success_message']);
            ?>
        </div>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <?php 
                echo $_SESSION['error_message']; 
                unset($_SESSION['error_message']);
            ?>
        </div>
    <?php endif; ?>
    
    <div class="content-card">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Package Name</th>
                        <th>Destination</th>
                        <th>Duration</th>
                        <th>Price</th>
                        <th>Featured</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($packages_result && $packages_result->num_rows > 0) {
                        while($package = $packages_result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td>#<?php echo $package['id']; ?></td>
                            <td>
                                <img src="<?php echo SITE_URL . $package['main_image']; ?>" alt="Package" class="table-image">
                            </td>
                            <td><strong><?php echo htmlspecialchars($package['package_name']); ?></strong></td>
                            <td><?php echo htmlspecialchars($package['destination']); ?></td>
                            <td><?php echo htmlspecialchars($package['duration']); ?></td>
                            <td>₹<?php echo number_format($package['price']); ?></td>
                            <td>
                                <?php if ($package['featured']): ?>
                                    <span class="badge badge-warning">Featured</span>
                                <?php else: ?>
                                    <span class="badge badge-secondary">No</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="badge badge-<?php echo $package['status'] == 'active' ? 'success' : 'danger'; ?>">
                                    <?php echo ucfirst($package['status']); ?>
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="edit-package.php?id=<?php echo $package['id']; ?>" class="btn-action btn-edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="?action=toggle_status&id=<?php echo $package['id']; ?>" class="btn-action btn-toggle" title="Toggle Status">
                                        <i class="fas fa-toggle-on"></i>
                                    </a>
                                    <a href="?action=delete&id=<?php echo $package['id']; ?>" class="btn-action btn-delete" title="Delete" onclick="return confirm('Are you sure you want to delete this package?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="9" class="text-center">No packages found. <a href="add-package.php">Add your first package</a></td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>