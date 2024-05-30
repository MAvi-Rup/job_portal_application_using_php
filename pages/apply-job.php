<?php
// Include necessary files
require_once '../includes/database.php';
require_once '../includes/functions.php';
require_once '../includes/session.php';

// Get the job ID from the URL parameter
$jobId = $_GET['id'];

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $candidateId = $_SESSION['user_id'];
    $coverLetter = $_POST['cover_letter'];

    // Apply for the job
    $success = applyForJob($conn, $jobId, $candidateId, $coverLetter);
    if ($success) {
        $message = "Your application has been submitted successfully.";
    } else {
        $error = "Failed to submit your application. Please try again.";
    }
}

// Retrieve job details from the database
$jobDetails = getJobDetails($conn, $jobId);
?>

<?php include '../templates/header.php'; ?>

<main>
    <?php if ($jobDetails) : ?>
        <h1>Apply for: <?php echo $jobDetails['title']; ?></h1>
        <?php if (isset($message)) : ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
        <?php if (isset($error)) : ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="apply-job.php?id=<?php echo $jobId; ?>" method="post">
            <textarea name="cover_letter" placeholder="Write your cover letter" required></textarea>
            <button type="submit">Submit Application</button>
        </form>
    <?php else : ?>
        <p>Job details not found.</p>
    <?php endif; ?>
</main>

<?php include '../templates/footer.php'; ?>