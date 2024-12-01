<?php
require_once 'core/models.php';
require_once 'core/dbConfig.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- This is where the message and statuscode appears if the updating of record details is successful or failed -->
    <?php if (isset($_SESSION['message'])) { ?>
        <h2 style="color: red; text-align: center;">
            <?php echo $_SESSION['message']; ?> (Status Code: <?php echo $_SESSION['statusCode']; ?>)
        </h2>
    <?php } unset($_SESSION['message']); unset($_SESSION['statusCode']); ?>
    
    <!-- If successful, it will process the details by updating it.-->
    <?php 
    $response = getApplicantRecordByID($pdo, $_GET['id']);
    if ($response['statusCode'] === 200) {
        $getApplicantRecordByID = $response['querySet'];
    ?>
    <h1>Edit the user!</h1>

    <!-- Input form -->
    <form action="core/handleForms.php?id=<?php echo $_GET['id']; ?>" method="POST">
        <p>
            <label for="desiredJob">Desired Job</label> 
            <input type="text" name="desired_job" value="<?php echo $getApplicantRecordByID['desired_job']; ?>">
        </p>
        <p>
            <label for="firstName">Applicant's First Name</label> 
            <input type="text" name="applicant_first_name" value="<?php echo $getApplicantRecordByID['applicant_first_name']; ?>">
        </p>
        <p>
            <label for="lastName">Applicant's Last Name</label> 
            <input type="text" name="applicant_last_name" value="<?php echo $getApplicantRecordByID['applicant_last_name']; ?>">
        </p>
        <p>
            <label for="gender">Gender</label> 
            <input type="text" name="gender" value="<?php echo $getApplicantRecordByID['gender']; ?>">
        </p>
        <p>
            <label for="address">Address</label> 
            <input type="text" name="address" value="<?php echo $getApplicantRecordByID['address']; ?>">
        </p>
        <p>
            <label for="email">Email</label> 
            <input type="text" name="email" value="<?php echo $getApplicantRecordByID['email']; ?>">
        </p>
        <p>
            <label for="nationality">Nationality</label> 
            <input type="text" name="nationality" value="<?php echo $getApplicantRecordByID['nationality']; ?>">
        </p>
        <p>
            <label for="addtlSkills">Additional Skills</label> 
            <input type="text" name="additional_skills" value="<?php echo $getApplicantRecordByID['additional_skills']; ?>">
            <input type="submit" value="Save" name="editBSApplicantBtn">
        </p>
    </form>
    <?php 

    // This the message when error exists.
    } else {
        echo "<p>Error: " . $response['message'] . "</p>";
    }
    ?>
</body>
</html>