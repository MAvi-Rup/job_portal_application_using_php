<?php
// Include the database connection file
require_once 'database.php';

// Function to retrieve featured job listings
function getFeaturedJobs($conn) {
    $sql = "SELECT * FROM jobs WHERE featured = 1 LIMIT 5";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $featuredJobs = array();
        while ($row = $result->fetch_assoc()) {
            $featuredJobs[] = $row;
        }
        return $featuredJobs;
    }

    return false;
}

// Function to register a new user
function registerUser($conn, $username, $email, $password, $userType) {
    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the SQL query to insert the new user
    $sql = "INSERT INTO users (username, email, password, user_type) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $email, $hashedPassword, $userType);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}
// Function to authenticate a user
function authenticateUser($conn, $username, $password) {
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            return $user;
        }
    }

    return false;
}

// Function to retrieve all job listings
function getJobListings($conn) {
    $sql = "SELECT * FROM jobs";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $jobListings = array();
        while ($row = $result->fetch_assoc()) {
            $jobListings[] = $row;
        }
        return $jobListings;
    }

    return false;
}

// Function to retrieve job details
function getJobDetails($conn, $jobId) {
    $sql = "SELECT * FROM jobs WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $jobId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }

    return false;
}

// Function to apply for a job
function applyForJob($conn, $jobId, $candidateId, $coverLetter) {
    $sql = "INSERT INTO job_applications (job_id, candidate_id, cover_letter) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $jobId, $candidateId, $coverLetter);

    if ($stmt->execute()) {
        return true;
    }

    return false;
}

// Function to retrieve an employer's job listings
function getEmployerJobs($conn, $employerId) {
    $sql = "SELECT * FROM jobs WHERE employer_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $employerId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $employerJobs = array();
        while ($row = $result->fetch_assoc()) {
            $employerJobs[] = $row;
        }
        return $employerJobs;
    }

    return false;
}

// Function to post a new job listing
function postJobListing($conn, $employerId, $title, $company, $location, $description, $salary, $requirements) {
    $sql = "INSERT INTO jobs (employer_id, title, company, location, description, salary, requirements) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssss", $employerId, $title, $company, $location, $description, $salary, $requirements);

    if ($stmt->execute()) {
        return true;
    }

    return false;
}

// Function to retrieve user profile data
function getUserProfile($conn, $userId) {
    $sql = "SELECT username, email FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }

    return false;
}

// Function to update user profile
function updateUserProfile($conn, $userId, $username, $email, $password) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $username, $email, $hashedPassword, $userId);

    if ($stmt->execute()) {
        return true;
    }

    return false;
}