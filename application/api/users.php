<?php
//JSON
header("Content-Type: application/json");
//connection file
include "../config/conn.php";
//action 
$action = $_POST['action'];

//Registered Users
function register_user($conn)
{
    extract($_POST);

    $data = array();

    $new_id = generate_id($conn);

    $saved_name = $new_id . ".png";

    //files
    $file_name = $_FILES['image']['name'];
    $file_type = $_FILES['image']['type'];
    $file_size = $_FILES['image']['size'];

    $allowed_type = ["image/jpeg", "image/jpg", "image/png"];

    $max_size = 5 * 1024 * 1024;

    $error_message = array();

    if (in_array($file_type, $allowed_type)) {
        if (
            $file_size > $max_size
        ) {
            $error_message[] = $file_size / 1024 / 1024 . " MB Must be Less Than " . $max_size / 1024 / 1024 . " MB.";
        }
    } else {
        $error_message[] = "This File Is Not Allowed " . $file_type;
    }


    if (count($error_message) <= 0) {
        $query = "INSERT INTO users (id,username,password,image)
        VALUES('$new_id','$username','$password','$saved_name')";
        $result = $conn->query($query);

        if ($result) {
            move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/" . $saved_name);
            $data = array("status" => true, "data" => "Successfully Registered.✔");
        } else {
            $data = array("status" => false, "data" => $conn->error);
        }
    } else {
        $data = array("status" => false, "data" => $error_message);
    }
    echo json_encode($data);
}
//update users
function update_user($conn)
{
    extract($_POST);

    $data = array();

    if (!empty($_FILES['image']['tmp_name'])) {

        //$new_id = generate_id($conn);

        $saved_name = $update_id . ".png";

        //files
        $file_name = $_FILES['image']['name'];
        $file_type = $_FILES['image']['type'];
        $file_size = $_FILES['image']['size'];

        $allowed_type = ["image/jpeg", "image/jpg", "image/png"];

        $max_size = 5 * 1024 * 1024;

        $error_message = array();

        if (in_array($file_type, $allowed_type)) {
            if (
                $file_size > $max_size
            ) {
                $error_message[] = $file_size / 1024 / 1024 . " MB Must be Less Than " . $max_size / 1024 / 1024 . " MB.";
            }
        } else {
            $error_message[] = "Thi File Is Not Allowed " . $file_type;
        }


        if (count($error_message) <= 0) {
            $query =
                "update users set username = '$username' ,password='$password' where id='$update_id'";
            $result = $conn->query($query);

            if ($result) {
                move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/" . $saved_name);
                $data = array("status" => true, "data" => "Successfully Registered.✔");
            } else {
                $data = array("status" => false, "data" => $conn->error);
            }
        } else {
            $data = array("status" => false, "data" => $error_message);
        }
    } else {
        extract($_POST);
        $query = "update users set username = '$username' ,password='$password' where id='$update_id'";
        $result = $conn->query($query);

        if ($result) {
            $data = array("status" => true, "data" => "Successfully Updated.✔");
        } else {
            $data = array("status" => false, "data" => $conn->error);
        }
    }
    echo json_encode($data);
}
//Generate ID
function generate_id($conn)
{
    extract($_POST);
    $new_id = '';
    $query = "SELECT * FROM users ORDER BY users.id DESC LIMIT 1";
    $result = $conn->query($query);

    if ($result) {
        $number_rows = $result->num_rows;
        if ($number_rows > 0) {
            $row = $result->fetch_assoc();
            $new_id = ++$row['id'];
        } else {
            $new_id = 'USR001';
        }

        return $new_id;
    }
}

//read all user expense
function readAllUsers($conn)
{
    $data = array();
    $message = array();
    $query = ("SELECT * FROM `users` ");
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
function readUser($conn)
{
    $data = array();
    $message = array();
    extract($_POST);
    $query = ("SELECT * FROM users where id ='$id'");
    $result = $conn->query($query);
    if ($result) {
        $row = $result->fetch_assoc();
        $message = array("status" => true, "data" => $row);
    } else {
        $message = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($message);
}

///delete function
function deleteUser($conn)
{
    extract($_POST);
    $data = array();

    $query = "Delete from users where id='$id'";
    $result = $conn->query($query);
    if ($result) {
        unlink('../uploads/' . $id . ".png");
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
