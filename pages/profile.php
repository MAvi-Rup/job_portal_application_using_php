<?php
// Include necessary files
require_once '../includes/database.php';
require_once '../includes/functions.php';
require_once '../includes/session.php';

// Retrieve user profile data from the database
$userProfile = getUserProfile($conn, $_SESSION['user_id']);

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validate form data
    if ($password !== $confirmPassword) {
        $error = "Passwords do not match";
    } else {
        // Update user profile
        $success = updateUserProfile($conn, $_SESSION['user_id'], $username, $email, $password);
        if ($success) {
            $message = "Profile updated successfully.";
        } else {
            $error = "Failed to update profile. Please try again.";
        }
    }
}
?>

<?php include '../templates/header.php'; ?>

<main>
    <h1>User Profile</h1>
    <?php if (isset($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <?php if (isset($error)) : ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="profile.php" method="post">
        <input type="text" name="username" placeholder="Username" value="<?php echo $userProfile['username']; ?>" required>
        <input type="email" name="email" placeholder="Email" value="<?php echo $userProfile['email']; ?>" required>
        <input type="password" name="password" placeholder="New Password (leave blank to keep current password)">
        <input type="password" name="confirm_password" placeholder="Confirm New Password">
        <button type="submit">Update Profile</button>
    </form>
</main>

<?php include '../templates/footer.php'; ?>