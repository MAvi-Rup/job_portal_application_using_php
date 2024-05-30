<?php
// Include necessary files
require_once '../includes/database.php';
require_once '../includes/functions.php';
require_once '../includes/session.php';

// Check if the user is an employer
if ($_SESSION['user_type'] !== 'employer') {
    header('Location: job-listings.php');
    exit;
}

// Retrieve the employer's job listings from the database
$employerJobs = getEmployerJobs($conn, $_SESSION['user_id']);
?>

<?php include '../templates/header.php'; ?>

<main>
    <h1>Employer Dashboard</h1>
    <a href="post-job.php">Post a New Job</a>
    <h2>Your Job Listings</h2>
    <?php if ($employerJobs) : ?>
        <?php foreach ($employerJobs as $job) : ?>
            <div class="job-listing">
                <h3><?php echo $job['title']; ?></h3>
                <p>Company: <?php echo $job['company']; ?></p>
                <p>Location: <?php echo $job['location']; ?></p>
                <a href="job-details.php?id=<?php echo $job['id']; ?>">View Details</a>
                <!-- Add links or buttons for editing and deleting the job listing -->
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>You haven't posted any job listings yet.</p>
    <?php endif; ?>
</main>

<?php include '../templates/footer.php'; ?>