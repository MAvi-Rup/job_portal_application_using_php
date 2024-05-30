// Client-side form validation
function validateForm(form) {
    // Get all form fields
    const fields = form.querySelectorAll('input, select, textarea');
  
    // Loop through each field and perform validation
    for (let i = 0; i < fields.length; i++) {
      const field = fields[i];
  
      // Check if the field is required and has a value
      if (field.required && field.value.trim() === '') {
        alert(`Please fill in the ${field.name} field.`);
        field.focus();
        return false;
      }
  
      // Validate email format
      if (field.type === 'email') {
        const emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
        if (!emailRegex.test(field.value)) {
          alert('Please enter a valid email address.');
          field.focus();
          return false;
        }
      }
  
      // Validate password strength (minimum 8 characters, at least one uppercase, one lowercase, one number, and one special character)
      if (field.type === 'password') {
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        if (!passwordRegex.test(field.value)) {
          alert('Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.');
          field.focus();
          return false;
        }
      }
    }
  
    // If all validations pass, return true to allow form submission
    return true;
  }