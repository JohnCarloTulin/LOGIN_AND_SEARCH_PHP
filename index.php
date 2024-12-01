<?php
require_once 'core/dbConfig.php';
require_once 'core/models.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Tulin Bike Store Job Application System</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1 style="text-align: center;">Welcome to Tulin Bike Store Job Application System</h1>

    <?php if (isset($_SESSION['message'])) { ?>
        <h2 style="color: green; text-align: center;">    
            <?php echo $_SESSION['message']; ?>
        </h2>
    <?php } unset($_SESSION['message']); ?>

    <!-- Users can input a search query in this HTML form and use the GET technique to submit it to the same page.
     The form data is delivered as a query parameter that can be read using $_GET['searchInput'],
     and the action element uses PHP to securely manage the form submission.-->
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="GET">
        <input type="text" name="searchInput" placeholder="Search here">
        <br><br>
        <input type="submit" name="searchBtn">
    </form>

    <!-- Options for clearing the search query and adding records for applicant -->
    <p><a href="index.php">Clear Search Query</a></p>
    <p><a href="insert.php">Insert New Applicants</a></p>
    <a href="logout.php">Logout</a>

    <!-- Contents of the table -->
    <table style="width:100%; margin-top: 20px;">
        <tr>
            <th>Desired Job</th>
            <th>Applicant's First Name</th>
            <th>Applicant's Last Name</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Email</th>
            <th>Nationality</th>
            <th>Additional skills</th>
            <th>Date of Application</th>
            <th>Created By</th>
            <th>Action</th>
        </tr>

        <!-- Display the applicant record details -->
        <?php if (!isset($_GET['searchInput'])) { ?>
            <?php
            $response = getAllApplicantRecord($pdo);
            if ($response['statusCode'] === 200) {
                $getAllApplicantRecord = $response['querySet'];
                foreach ($getAllApplicantRecord as $row) { ?>
                    <tr>
                        <td><?php echo $row['desired_job']; ?></td>
                        <td><?php echo $row['applicant_first_name']; ?></td>
                        <td><?php echo $row['applicant_last_name']; ?></td>
                        <td><?php echo $row['gender']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['nationality']; ?></td>
                        <td><?php echo $row['additional_skills']; ?></td>
                        <td><?php echo $row['date_added']; ?></td>
                        <td><?php echo $row['created_by']; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                            <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php } 
            } else {
                echo "<tr><td colspan='10'>" . $response['message'] . "</td></tr>";
            }
            ?>
        <?php } else { ?>
            <?php
            
            // Fetch an applicant details based on search query
            $response = searchForAnApplicantRecord($pdo, $_GET['searchInput']);
            if ($response['statusCode'] === 200) {
                $searchForAnApplicantRecord = $response['querySet'];
                foreach ($searchForAnApplicantRecord as $row) { ?>
                    <tr>
                        <td><?php echo $row['desired_job']; ?></td>
                        <td><?php echo $row['applicant_first_name']; ?></td>
                        <td><?php echo $row['applicant_last_name']; ?></td>
                        <td><?php echo $row['gender']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['nationality']; ?></td>
                        <td><?php echo $row['additional_skills']; ?></td>
                        <td><?php echo $row['date_added']; ?></td>
                        <td><?php echo $row['created_by']; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                            <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php } 
            } else {
                echo "<tr><td colspan='10'>" . $response['message'] . "</td></tr>";
            }
            ?>
        <?php } ?>
    </table>
</body>
</html>