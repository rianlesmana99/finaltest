<?php

$hostname = "localhost";
$username = "root";
$password = "12345678";
$database = "finaltest";
$port = 3306;

$conn = mysqli_connect($hostname, $username, $password, $database, $port);

if (!$conn) {
    die("Error: " . mysqli_connect_error());
}

function addSession($customers) {
    session_start();
    $_SESSION["customers"] = $customers;
    header("Location: ./index.php");
}

function addMenu($product_name, $price) {
    global $conn;
    $sql = "INSERT INTO menus (product_name, price) VALUES ('$product_name', '$price')";
    if (mysqli_query($conn, $sql)){
        $msg = "Success to add new menu!";
        header("Location: ../../index.php?status=200&msg=$msg");
    } else {
        echo "Error" . mysqli_error($conn);
    }
}

function viewMenu() {
    global $conn;
    $sql = "SELECT * FROM menus";
    $result = mysqli_query($conn, $sql);
    if ($result){
        return $result;
    } else {
        return "Error" . mysqli_error($conn);
    }
}

function getMenuById($id) {
    global $conn;
    $sql = "SELECT * FROM menus WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        $result = mysqli_query($conn, $sql)->fetch_assoc();
        return $result;
    }
}

function deleteMenu($id) {
    global $conn;
    $sql = "DELETE FROM menus WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        $msg = "Success to delete menu from database!";
        header("Location: ./index.php?status=$msg");
    }
}

function updateMenuById($id, $product_name, $price) {
    global $conn;
    $sql = "UPDATE menus SET product_name='$product_name', price='$price' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        $msg = "Successfully to update menu";
        header("Location: ../../index.php?status=200&msg=$msg");
    }
}

function addTransaction($name, $qty, $product_id) {
    global $conn;
    $sql = "INSERT INTO transaction (customer_name, quantity, status, product_id) VALUES ('$name', '$qty', '0', '$product_id')";
    if (mysqli_query($conn, $sql)) {
        $msg = "Success to add new transaction!";
        header("Location: ./cart.php?status=200&message=$msg");
    }
}

function cartTransaction($name) {
    global $conn;
    $sql = "SELECT transaction.id, customer_name, product_name, price, quantity, (price * quantity) AS total_price, status FROM transaction INNER JOIN menus ON product_id = menus.id WHERE status=0 AND customer_name='$name'";
    if (mysqli_query($conn, $sql)) {
        $result = mysqli_query($conn, $sql);
        return $result;
    }
}

function deleteTransaction($id) {
    global $conn;
    $sql = "DELETE FROM transaction WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        $msg = "Successfully to delete transaction data!";
        header("Location: ../../index.php?status=200&message=$msg");
    }
}

function endTransaction($id) {
    global $conn;
    $sql = "UPDATE transaction SET status=1 WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        $msg = "Successfully to pay a transaction!";
        header("Location: ./history.php?status=200&message=$msg");
    }
}

function historyTransaction($name) {
    global $conn;
    $sql = "SELECT transaction.id, customer_name, product_name, price, quantity, (price * quantity) AS total_price, status FROM transaction INNER JOIN menus ON product_id = menus.id WHERE status=1 AND customer_name='$name'";
    if (mysqli_query($conn, $sql)) {
        $result = mysqli_query($conn, $sql);
        return $result;
    }
}

function dataStatistic() {
    global $conn;
    $sql = "SELECT product_name, SUM(quantity) AS total_transaction FROM transaction RIGHT JOIN menus ON product_id=menus.id GROUP BY menus.product_name";
    if (mysqli_query($conn, $sql)) {
        $result = mysqli_query($conn, $sql);
        return $result;
    }
}