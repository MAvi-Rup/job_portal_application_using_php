<?php
// Include necessary files
require_once '../includes/database.php';
require_once '../includes/functions.php';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $userType = $_POST['user_type'];

    // Validate form data
    if ($password !== $confirmPassword) {
        $error = "Passwords do not match";
    } else {
        // Register the new user
        $success = registerUser($conn, $username, $email, $password, $userType);
        if ($success) {
            // Redirect to login page on successful registration
            header('Location: login.php');
            exit;
        } else {
            $error = "Registration failed. Please try again.";
        }
    }
}
?>

<?php include '../templates/header.php'; ?>

<main>
    <h1 style="text-align: center;">Register Here!</h1>
    <?php if (isset($error)) : ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="register.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <select name="user_type">
            <option value="candidate">Candidate</option>
            <option value="employer">Employer</option>
        </select>
        <button type="submit">Register</button>
    </form>
</main>

<?php include '../templates/footer.php'; ?>