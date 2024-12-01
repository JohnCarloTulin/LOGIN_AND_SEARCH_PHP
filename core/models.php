<?php

# Function for retrieving the record details of an applicant and setting of status and message.
function getAllApplicantRecord($pdo) {
    $sql = "SELECT * FROM bike_store_applicants ORDER BY applicant_first_name ASC";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute()) {
        return [
            'message' => 'Query executed successfully.',
            'statusCode' => 200,
            'querySet' => $stmt->fetchAll()
        ];
    } else {
        return [
            'message' => 'Failed to execute query.',
            'statusCode' => 400
        ];
    }
}

# Function for searching an applicant by their ID and setting of status and message.
function getApplicantRecordByID($pdo, $id) {
    $sql = "SELECT * FROM bike_store_applicants WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$id])) {
        return [
            'message' => 'Query executed successfully.',
            'statusCode' => 200,
            'querySet' => $stmt->fetch()
        ];
    } else {
        return [
            'message' => 'Failed to execute query.',
            'statusCode' => 400
        ];
    }
}

# Function for searching an applicant by their details.
function searchForAnApplicantRecord($pdo, $searchQuery) {
    $sql = "SELECT * FROM bike_store_applicants WHERE CONCAT(desired_job, applicant_first_name, applicant_last_name, gender, address, email, nationality, additional_skills, date_added, created_by) LIKE ?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute(["%" . $searchQuery . "%"])) {
        return [
            'message' => 'Query executed successfully.',
            'statusCode' => 200,
            'querySet' => $stmt->fetchAll()
        ];
    } else {
        return [
            'message' => 'Failed to execute query.',
            'statusCode' => 400
        ];
    }
}

# Function for insertion of applicant record to database and setting of status code and message.
function insertNewApplicantRecord($pdo, $desired_job, $first_name, $last_name, $gender, $address, $email, $nationality, $additional_skills) {
    $sql = "INSERT INTO bike_store_applicants (desired_job, applicant_first_name, applicant_last_name, gender, address, email, nationality, additional_skills, created_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$desired_job, $first_name, $last_name, $gender, $address, $email, $nationality, $additional_skills, $_SESSION['full_name']])) {
        return [
            'message' => 'The application have been inserted successfully.',
            'statusCode' => 200
        ];
    } else {
        return [
            'message' => 'Insertion of the application failed.',
            'statusCode' => 400
        ];
    }
}

# Function for editing of applicant record to database and setting of status code and message.
function editApplicantRecord($pdo, $desired_job, $first_name, $last_name, $gender, $address, $email, $nationality, $additional_skills, $id) {
    $sql = "UPDATE bike_store_applicants SET desired_job = ?, applicant_first_name = ?, applicant_last_name = ?, gender = ?, address = ?, email = ?, nationality = ?, additional_skills = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$desired_job, $first_name, $last_name, $gender, $address, $email, $nationality, $additional_skills, $id])) {
        return [
            'message' => 'The application have been updated successfully',
            'statusCode' => 200
        ];
    } else {
        return [
            'message' => 'Updating of the application failed.',
            'statusCode' => 400
        ];
    }
}

# Function for deleting applicant record to database and setting of status code and message.
function deleteApplicantRecord($pdo, $id) {
    $sql = "DELETE FROM bike_store_applicants WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$id])) {
        return [
            'message' => 'The application have been deleted successfully',
            'statusCode' => 200
        ];
    } else {
        return [
            'message' => 'Deleting of the application failed',
            'statusCode' => 400
        ];
    }
}

?>