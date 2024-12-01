<?php 
require_once 'core/models.php'; 
require_once 'core/dbConfig.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Are you sure you want to delete this user?</h1>
    <?php 
    $response = getApplicantRecordByID($pdo, $_GET['id']);
    if ($response['statusCode'] === 200) {
        $getApplicantRecordByID = $response['querySet'];
    ?>

    <!-- Display the existing details of applicant's record-->
    <div class="container" style="border-style: solid; height: 500px;">
        <h2>Desired Job: <?php echo $getApplicantRecordByID['desired_job']; ?></h2>
        <h2>First Name: <?php echo $getApplicantRecordByID['applicant_first_name']; ?></h2>
        <h2>Last Name: <?php echo $getApplicantRecordByID['applicant_last_name']; ?></h2>
        <h2>Gender: <?php echo $getApplicantRecordByID['gender']; ?></h2>
        <h2>Address: <?php echo $getApplicantRecordByID['address']; ?></h2>
        <h2>Email: <?php echo $getApplicantRecordByID['email']; ?></h2>
        <h2>Nationality: <?php echo $getApplicantRecordByID['nationality']; ?></h2>
        <h2>Additional Skills: <?php echo $getApplicantRecordByID['additional_skills']; ?></h2>

        <div class="deleteBtn" style="float: right; margin-right: 10px;">
            <form action="core/handleForms.php?id=<?php echo $_GET['id']; ?>" method="POST">
                <input type="submit" name="deleteBSApplicantBtn" value="Delete">
            </form>         
        </div>  
    </div>
    
    <?php 
    } else {
        echo "<p>Error: " . $response['message'] . "</p>";
    }
    ?>
</body>
</html>