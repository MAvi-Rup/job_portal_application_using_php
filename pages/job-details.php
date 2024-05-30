<?php
// Include necessary files
require_once '../includes/database.php';
require_once '../includes/functions.php';
require_once '../includes/session.php';

// Get the job ID from the URL parameter
$jobId = $_GET['id'];

// Retrieve job details from the database
$jobDetails = getJobDetails($conn, $jobId);
?>

<?php include '../templates/header.php'; ?>

<main>
    <?php if ($jobDetails) : ?>
        <h1><?php echo $jobDetails['title']; ?></h1>
        <p>Company: <?php echo $jobDetails['company']; ?></p>
        <p>Location: <?php echo $jobDetails['location']; ?></p>
        <p>Description: <?php echo $jobDetails['description']; ?></p>
        <p>Salary: <?php echo $jobDetails['salary']; ?></p>
        <p>Requirements: <?php echo $jobDetails['requirements']; ?></p>
        <?php if (isUserType('candidate')) : ?>
            <a href="apply-job.php?id=<?php echo $jobId; ?>">Apply for this job</a>
        <?php endif; ?>
    <?php else : ?>
        <p>Job details not found.</p>
    <?php endif; ?>
</main>

<?php include '../templates/footer.php'; ?>