<?php
// Include necessary files
require_once '../includes/database.php';
require_once '../includes/functions.php';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Authenticate the user
    $user = authenticateUser($conn, $username, $password);
    if ($user) {
        // Start the session and store user data
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_type'] = $user['user_type'];

        // Redirect to the appropriate page based on user type
        if ($user['user_type'] === 'candidate') {
            header('Location: job-listings.php');
        } else {
            header('Location: dashboard.php');
        }
        exit;
    } else {
        $error = "Invalid username or password";
    }
}
?>

<?php include '../templates/header.php'; ?>

<main>
    <h1 style="text-align: center;">Login</h1>
    <?php if (isset($error)) : ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="login.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</main>

<?php include '../templates/footer.php'; ?>