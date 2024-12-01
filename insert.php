<?php 
require_once 'core/handleForms.php';
require_once 'core/models.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- This is where the status and message of the insertion shown if it's successful or not -->
    <?php if (isset($_SESSION['message'])) { ?>
        <h2 style="color: red; text-align: center;">    
            <?php echo $_SESSION['message']; ?> (Status Code: <?php echo $_SESSION['statusCode']; ?>)
        </h2>
    <?php } unset($_SESSION['message']); unset($_SESSION['statusCode']); ?>

    <!-- Input form -->
    <h1>Insert new applicants!</h1>
    <form action="core/handleForms.php" method="POST">
        <p>
            <label for="Desired Job">Desired Job</label> 
            <input type="text" name="desired_job">
        </p>
        <p>
            <label for="firstName">Applicant First Name</label> 
            <input type="text" name="applicant_first_name">
        </p>
        <p>
            <label for="lastName">Applicant Last Name</label> 
            <input type="text" name="applicant_last_name">
        </p>
        <p>
            <label for="gender">Gender</label> 
            <input type="text" name="gender">
        </p>
        <p>
            <label for="address">Address</label> 
            <input type="text" name="address">
        </p>
        <p>
            <label for="email">Email</label> 
            <input type="text" name="email">
        </p>
        <p>
            <label for="nationality">Nationality</label> 
            <input type="text" name="nationality">
        </p>
        <p>
            <label for="additional_skills">Additional skills</label> 
            <input type="text" name="additional_skills">
            <input type="submit" name="insertBSApplicantBtn">
        </p>
    </form>
</body>
</html>