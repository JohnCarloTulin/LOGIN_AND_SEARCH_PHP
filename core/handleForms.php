<?php require_once 'dbConfig.php'; ?>
<?php require_once 'functions.php'; ?>
<?php require_once 'models.php'; ?>
<?php require_once 'validate.php'; ?>

<?php  
session_start();

# Implementation for the registration button
if (isset($_POST['regBtn'])) {
	$username = sanitizeInput($_POST['username']);
	$password = $_POST['password'];
    $first_name = sanitizeInput($_POST['first_name']);
    $last_name = sanitizeInput($_POST['last_name']);

	if(empty($username) || empty($password) || empty($first_name) || empty($last_name)) {
		$_SESSION['message'] = "Please make sure the input fields are not empty for registration!";
		header('Location: ../register.php');
	}
	
	else {
		if (validatePassword($password)){
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
			if(addUser($pdo, $username, $password, $first_name, $last_name)) {
				header('Location: ../login.php');
			}

			else {
				header('Location: ../register.php');
				}
			}
			
		else {
			$_SESSION['message'] = "Password should be more than 8 characters and should contain both uppercase, lowercase, and numbers";
			header("Location: ../register.php");
		}
	}
}

# Implementation for the login button
if (isset($_POST['loginBtn'])) {
	$username = sanitizeInput($_POST['username']);
	$password = $_POST['password'];

	if(empty($username) && empty($password)) {
		echo "<script>
		alert('Input fields are empty!');
		window.location.href='../login.php'
		</script>";
	} 

	else {
		if(login($pdo, $username, $password)) {
			header('Location: ../index.php');
		}
		else {
			header('Location: ../login.php');
		}
	}
	
}

// Handle forms for insert button
if (isset($_POST['insertBSApplicantBtn'])) {
    // Verify whether any input fields are blank
    if (empty($_POST['desired_job']) || empty($_POST['applicant_first_name']) || empty($_POST['applicant_last_name']) || empty($_POST['gender']) || empty($_POST['address']) || empty($_POST['email']) || empty($_POST['nationality']) || empty($_POST['additional_skills'])) {
        $_SESSION['message'] = 'Insertion of the application failed.';
        $_SESSION['statusCode'] = 400;
        header("Location: ../insert.php");
        exit();
    }
    
    $response = insertNewApplicantRecord($pdo, $_POST['desired_job'], $_POST['applicant_first_name'], $_POST['applicant_last_name'], $_POST['gender'], $_POST['address'], $_POST['email'], $_POST['nationality'], $_POST['additional_skills']);

    $_SESSION['message'] = $response['message'];
    $_SESSION['statusCode'] = $response['statusCode'];
    header("Location: ../index.php");
    exit();
}

// Handle forms for edit button
if (isset($_POST['editBSApplicantBtn'])) {
    // Verify whether any input fields are blank
    if (empty($_POST['desired_job']) || empty($_POST['applicant_first_name']) || empty($_POST['applicant_last_name']) || empty($_POST['gender']) || empty($_POST['address']) || empty($_POST['email']) || empty($_POST['nationality']) || empty($_POST['additional_skills'])) {
        $_SESSION['message'] = "Updating of the application failed.";
        $_SESSION['statusCode'] = 400;
        header("Location: ../edit.php?id=" . $_GET['id']);
        exit();
    }
    
    $response = editApplicantRecord($pdo, $_POST['desired_job'], $_POST['applicant_first_name'], $_POST['applicant_last_name'], $_POST['gender'], $_POST['address'], $_POST['email'], $_POST['nationality'], $_POST['additional_skills'], $_GET['id']);

    $_SESSION['message'] = $response['message'];
    header("Location: ../index.php");
    exit();
}

// Handle forms for delete button
if (isset($_POST['deleteBSApplicantBtn'])) {
    $response = deleteApplicantRecord($pdo, $_GET['id']);

    $_SESSION['message'] = $response['message'];
    header("Location: ../index.php");
    exit();
}
?>
