<?php
// Include necessary files
require_once '../includes/database.php';
require_once '../includes/functions.php';
require_once '../includes/session.php';

// Retrieve job listings from the database
$jobListings = getJobListings($conn);
?>

<?php include '../templates/header.php'; ?>

<main>
    <h1>Job Listings</h1>
    <?php if ($jobListings) : ?>
        <?php foreach ($jobListings as $job) : ?>
            <div class="job-listing">
                <h3><?php echo $job['title']; ?></h3>
                <p>Company: <?php echo $job['company']; ?></p>
                <p>Location: <?php echo $job['location']; ?></p>
                <a href="job-details.php?id=<?php echo $job['id']; ?>">View Details</a>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No job listings available.</p>
    <?php endif; ?>
</main>

<?php include '../templates/footer.php'; ?>