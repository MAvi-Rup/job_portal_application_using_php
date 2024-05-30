<?php
include '../includes/database.php';
include '../includes/functions.php';
include '../templates/header.php';
?>

<main>
  <h1>Welcome to Job Portal</h1>
  <p>Find your dream job or hire talented professionals.</p>
  <div>
    <a href="register.php">Register</a>
    <a href="login.php">Login</a>
  </div>
  <h2>Featured Jobs</h2>
  <?php
  // Retrieve featured job listings from the database
  $featuredJobs = getFeaturedJobs($conn);

  if ($featuredJobs) {
    foreach ($featuredJobs as $job) {
      echo "<div class='job-listing'>";
      echo "<h3>" . $job['title'] . "</h3>";
      echo "<p>Company: " . $job['company'] . "</p>";
      echo "<p>Location: " . $job['location'] . "</p>";
      echo "<a href='job-details.php?id=" . $job['id'] . "'>View Details</a>";
      echo "</div>";
    }
  } else {
    echo "<p>No featured jobs available.</p>";
  }
  ?>
</main>

<?php include '../templates/footer.php'; ?>