-- Create the database
CREATE DATABASE job_portal;

-- Use the database
USE job_portal;

-- Create the users table
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(255) NOT NULL UNIQUE,
  email VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  user_type ENUM('candidate', 'employer') NOT NULL
);

-- Create the jobs table
CREATE TABLE jobs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  employer_id INT NOT NULL,
  title VARCHAR(255) NOT NULL,
  company VARCHAR(255) NOT NULL,
  location VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  salary VARCHAR(255) NOT NULL,
  requirements TEXT NOT NULL,
  featured TINYINT(1) DEFAULT 0,
  FOREIGN KEY (employer_id) REFERENCES users(id)
);

-- Create the job_applications table
CREATE TABLE job_applications (
  id INT AUTO_INCREMENT PRIMARY KEY,
  job_id INT NOT NULL,
  candidate_id INT NOT NULL,
  cover_letter TEXT NOT NULL,
  resume_content LONGBLOB,
  status ENUM('pending', 'accepted', 'rejected') DEFAULT 'pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (job_id) REFERENCES jobs(id),
  FOREIGN KEY (candidate_id) REFERENCES users(id)
);

-- Insert sample data into the users table (5 profiles)
INSERT INTO users (username, email, password, user_type)
VALUES
  ('john_doe', 'john@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'candidate'),
  ('jane_smith', 'jane@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'candidate'),
  ('tech_company', 'tech@company.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'employer'),
  ('marketing_agency', 'marketing@agency.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'employer'),
  ('finance_firm', 'finance@firm.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'employer');

-- Insert sample data into the jobs table (10 jobs)
INSERT INTO jobs (employer_id, title, company, location, description, salary, requirements, featured)
VALUES
  (3, 'Software Engineer', 'Tech Company', 'New York, NY', 'We are seeking a talented Software Engineer to join our team...', '$80,000 - $120,000', 'Bachelor''s degree in Computer Science or related field, proficient in Java and Python, experience with agile development methodologies.', 1),
  (3, 'Web Developer', 'Tech Company', 'San Francisco, CA', 'We are looking for a skilled Web Developer to join our dynamic team...', '$70,000 - $100,000', 'Bachelor''s degree or equivalent experience, expertise in HTML, CSS, JavaScript, and frameworks like React or Angular, familiarity with responsive design.', 0),
  (4, 'Digital Marketing Specialist', 'Marketing Agency', 'Chicago, IL', 'We are seeking a Digital Marketing Specialist to help us drive our clients'' online presence...', '$50,000 - $80,000', 'Bachelor''s degree in Marketing or related field, experience with SEO, SEM, social media marketing, and analytics tools, excellent communication skills.', 1),
  (4, 'Content Writer', 'Marketing Agency', 'Remote', 'We are hiring a talented Content Writer to create engaging and compelling content...', '$40,000 - $60,000', 'Bachelor''s degree in English, Journalism, or related field, exceptional writing and editing skills, experience with content management systems, familiarity with SEO best practices.', 0),
  (5, 'Financial Analyst', 'Finance Firm', 'Boston, MA', 'We are seeking a skilled Financial Analyst to join our team...', '$70,000 - $100,000', 'Bachelor''s degree in Finance, Accounting, or related field, proficiency in financial modeling and data analysis, strong analytical and problem-solving skills.', 1),
  (5, 'Accountant', 'Finance Firm', 'Miami, FL', 'We are looking for an experienced Accountant to handle financial reporting and analysis...', '$60,000 - $90,000', 'Bachelor''s degree in Accounting, CPA certification preferred, knowledge of accounting principles and tax regulations, excellent attention to detail.', 0),
  (3, 'Data Scientist', 'Tech Company', 'Seattle, WA', 'We are seeking a talented Data Scientist to join our team...', '$90,000 - $130,000', 'Master''s degree in Data Science, Statistics, or related field, proficiency in Python, R, and SQL, experience with machine learning algorithms and data visualization.', 1),
  (4, 'Graphic Designer', 'Marketing Agency', 'Los Angeles, CA', 'We are hiring a creative Graphic Designer to develop visually stunning designs...', '$50,000 - $80,000', 'Bachelor''s degree in Graphic Design or related field, proficiency in Adobe Creative Suite, experience with branding and marketing materials, strong portfolio.', 0),
  (5, 'Investment Banker', 'Finance Firm', 'New York, NY', 'We are seeking a highly motivated Investment Banker to join our team...', '$100,000 - $150,000', 'Bachelor''s degree in Finance, Economics, or related field, excellent analytical and quantitative skills, knowledge of financial markets and regulations, strong communication and negotiation abilities.', 1),
  (3, 'UI/UX Designer', 'Tech Company', 'San Francisco, CA', 'We are looking for a talented UI/UX Designer to create intuitive and engaging user experiences...', '$70,000 - $110,000', 'Bachelor''s degree in Design, Human-Computer Interaction, or related field, proficiency in design tools like Figma or Sketch, experience with user research and usability testing, strong portfolio.', 0);
