<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Portal</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
</head>
<body>
    <header>
        <div class="logo">
            <a href="index.php">
                <img src="../assets/images/logo.png" alt="Job Portal Logo" width="50">
            </a>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <?php if (isUserType('candidate')) : ?>
                        <li><a href="candidate-dashboard.php">Dashboard</a></li>
                        <li><a href="job-listings.php">Job Listings</a></li>
                    <?php else : ?>
                        <li><a href="employer-dashboard.php">Dashboard</a></li>
                        <li><a href="post-job.php">Post Job</a></li>
                    <?php endif; ?>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php else : ?>
                    <li><a href="register.php">Register</a></li>
                    <li><a href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>