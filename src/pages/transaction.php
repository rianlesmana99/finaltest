<?php
require "../../midlewere.php";
require "../../db.php";

$menu_id = htmlspecialchars($_GET["id"]);
$result = getMenuById($menu_id);

if (isset($_POST["submit"])) {
    $name = htmlentities($_SESSION["customers"]);
    $product_id = htmlspecialchars($_GET["id"]);
    $quantity = htmlspecialchars($_POST["quantity"]);
    addTransaction($name, $quantity, $product_id);
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Form</title>
    <link rel="stylesheet" href="../assets/css/output.css">
</head>
<body>
    <main class="w-screen h-screen flex justify-center items-center bg-slate-100">
        <form action="" method="post" class="w-[80%] md:w-96 bg-white rounded-md shadow p-5">
            <h1 class="text-center font-semibold text-lime-600 text-xl my-4"><?= $result["product_name"] ?></h1>
            <img src="../assets/img/food-img.avif" alt="food" class="w-full">
            <div class="flex justify-between gap-3 mt-5">
                <a id="min-btn" class="inline-block bg-lime-600 px-3 font-semibold text-white text-xl rounded-md shadow" href="#">-</a>
                <input class="border-2 grow border-lime-600 rounded-md text-center text-lime-600 py-1" value="1" type="number" id="quantity" name="quantity">
                <a id="plus-btn" class="inline-block bg-lime-600 px-3 font-semibold text-white text-xl rounded-md shadow" href="#">+</a>
            </div>
            <button class="mt-4 border-2 border-lime-600 rounded-md shadow w-full py-1 font-semibold text-lime-600 hover:bg-lime-600 hover:text-white transition-all duration-300" name="submit">Order Now</button>
            <a class="inline-block w-full mt-4 text-center border-2 border-rose-600 rounded-md shadow bg-white py-1 font-semibold text-rose-600 hover:bg-rose-600 hover:text-white transition-all duration-300" href="../../index.php">Cancel</a>
        </form>
    </main>

    <script src="../assets/js/transaction.js"></script>
</body>
</html>