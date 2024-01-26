<?php
//JSON
header("Content-Type: application/json");
//connection file
include "../config/conn.php";
//action 
$action = $_POST['action'];
//register user expense
function registerExpense($conn)
{
    extract($_POST);
    $data = array();

    $query = "CALL register_expense_sp('','$amount','$type','$description','us1')";
    $result = $conn->query($query);
    if ($result) {
        $row = $result->fetch_assoc();
        if ($row['Message'] == 'deny') {
            $data = array("status" => false, "data" => "Insufficienty balance😒😒.");
        } else if ($row['Message'] == 'Registered') {
            $data = array("status" => true, "data" => "Registered Successfull.");
        }
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}
//read all user expense
function readAllExpense($conn)
{
    $data = array();
    $message = array();
    $query = ("SELECT `id`, `amount`, `type`, `description` FROM `expense` ");
    $result = $conn->query($query);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $message = array("status" => true, "data" => $data);
    } else {
        $message = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($message);
}
function getUserStatement($conn)
{
    $data = array();
    $message = array();
    extract($_POST);
    $query = ("call get_user_statement_sp('US1','$from','$to')");
    $result = $conn->query($query);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $message = array("status" => true, "data" => $data);
    } else {
        $message = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($message);
}
//read specific user expense
function readExpense($conn)
{
    $data = array();
    $message = array();
    extract($_POST);
    $query = ("SELECT * FROM expense where id ='$id'");
    $result = $conn->query($query);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $message = array("status" => true, "data" => $data);
    } else {
        $message = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($message);
}
//Update function
function updateExpense($conn)
{
    extract($_POST);
    $data = array();

    $query = "CALL register_expense_sp('$id','$amount','$type','$description','us1')";
    $result = $conn->query($query);
    if ($result) {
        $row = $result->fetch_assoc();
        if ($row['Message'] == 'Update') {
            $data = array("status" => true, "data" => "Updated Successfull.");
        }
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}
///delete function
function deleteExpense($conn)
{
    extract($_POST);
    $data = array();

    $query = "Delete from expense where id='$id'";
    $result = $conn->query($query);
    if ($result) {
        $data = array("status" => true, "data" => "Deleted Successfull.");
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}










if (isset($action)) {
    $action($conn);
} else {
    echo json_encode(array("status" => false, "date" => "Action is required"));
}
