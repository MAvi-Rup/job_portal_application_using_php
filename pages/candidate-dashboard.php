<?php
// Include necessary files
require_once '../includes/database.php';
require_once '../includes/functions.php';
require_once '../includes/session.php';

// Check if the user is a candidate
if ($_SESSION['user_type'] !== 'candidate') {
    header('Location: job-listings.php');
    exit;
}

// Retrieve the candidate's job applications from the database
$candidateApplications = getCandidateApplications($conn, $_SESSION['user_id']);
?>

<?php include '../templates/header.php'; ?>

<main>
    <h1>Candidate Dashboard</h1>
    <h2>Your Job Applications</h2>
    <?php if ($candidateApplications) : ?>
        <?php foreach ($candidateApplications as $application) : ?>
            <div class="job-application">
                <h3><?php echo $application['job_title']; ?></h3>
                <p>Company: <?php echo $application['company']; ?></p>
                <p>Status: <?php echo $application['status']; ?></p>
                <a href="job-details.php?id=<?php echo $application['job_id']; ?>">View Job Details</a>
                <!-- Add links or buttons for viewing or updating the application details -->
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>You haven't applied for any jobs yet.</p>
    <?php endif; ?>
    <a href="job-listings.php">Browse Job Listings</a>
</main>

<?php include '../templates/footer.php'; ?>