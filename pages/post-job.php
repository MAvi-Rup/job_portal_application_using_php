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

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $employerId = $_SESSION['user_id'];
    $title = $_POST['title'];
    $company = $_POST['company'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $salary = $_POST['salary'];
    $requirements = $_POST['requirements'];

    // Post the job listing
    $success = postJobListing($conn, $employerId, $title, $company, $location, $description, $salary, $requirements);
    if ($success) {
        $message = "Job listing posted successfully.";
    } else {
        $error = "Failed to post the job listing. Please try again.";
    }
}
?>

<?php include '../templates/header.php'; ?>

<main>
    <h1>Post a New Job</h1>
    <?php if (isset($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <?php if (isset($error)) : ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="post-job.php" method="post">
        <input type="text" name="title" placeholder="Job Title" required>
        <input type="text" name="company" placeholder="Company Name" required>
        <input type="text" name="location" placeholder="Location" required>
        <textarea name="description" placeholder="Job Description" required></textarea>
        <input type="text" name="salary" placeholder="Salary" required>
        <textarea name="requirements" placeholder="Job Requirements" required></textarea>
        <button type="submit">Post Job</button>
    </form>
</main>

<?php include '../templates/footer.php'; ?>