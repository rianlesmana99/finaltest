<?php
require "../../db.php";
require "../../midlewere.php";

if (isset($_POST["submit"])) {
    $product = htmlspecialchars($_POST["product"]);
    $price = htmlspecialchars($_POST["price"]);
    addMenu($product, $price);
}

if (isset($_GET["update"])) {
    $id = htmlspecialchars($_GET["id"]);
    $result = getMenuById($id);
}

if (isset($_POST["update"])) {
    $id = htmlspecialchars($_GET["id"]);
    $product = htmlspecialchars($_POST["product"]);
    $price = htmlspecialchars($_POST["price"]);
    updateMenuById($id, $product, $price);
}

if ($_SESSION["customers"] !== "Admin") {
    header("Location: ../../index.php");
}


$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Menu</title>
    <link rel="stylesheet" href="../assets/css/output.css">
</head>
<body>
    <main class="w-screen h-screen bg-slate-100 flex justify-center items-center">
        <form action="" method="post" class="bg-white p-5 shadow rounded-md w-[80vw] md:w-96">
            <center>
                <img src="../assets/img/food-logo.png" alt="logo" width="80px">
            </center>
            <?php if (isset($_GET["update"])) : ?>
                <h1 class="text-center text-lime-600 font-semibold text-2xl">Update Menu</h1>
            <?php else :?>
                <h1 class="text-center text-lime-600 font-semibold text-2xl">Add Menu</h1>
            <?php endif ?>
            
            <?php if (isset($_GET["update"])) : ?>
                <div class="flex flex-col gap-2 mt-5">
                    <label class="text-lime-600" for="product">Product Name</label>
                    <input class="outline-0 border border-lime-600 rounded-md px-2 py-1 focus:ring-4 ring-lime-100 transition-all duration-300" type="text" name="product" id="product" value="<?= $result["product_name"] ?>">
                </div>
                <div class="flex flex-col gap-2 mt-5">
                    <label class="text-lime-600" for="price">Price of product</label>
                    <input class="outline-0 border border-lime-600 rounded-md px-2 py-1 focus:ring-4 ring-lime-100 transition-all duration-300" type="number" name="price" id="price" value="<?= $result["price"] ?>">
                </div>
                <div class="flex flex-col gap-2 mt-5">
                    <button type="submit" name="update" class="border-2 border-lime-600 rounded-md shadow bg-white py-1 font-semibold text-lime-600 hover:bg-lime-600 hover:text-white transition-all duration-300">Update Product</button>
                    <a class="inline-block text-center border-2 border-rose-600 rounded-md shadow bg-white py-1 font-semibold text-rose-600 hover:bg-rose-600 hover:text-white transition-all duration-300" href="../../index.php">Cancel</a>
                </div>
            <?php else: ?>
                <div class="flex flex-col gap-2 mt-5">
                    <label class="text-lime-600" for="product">Product Name</label>
                    <input class="outline-0 border border-lime-600 rounded-md px-2 py-1 focus:ring-4 ring-lime-100 transition-all duration-300" type="text" name="product" id="product">
                </div>
                <div class="flex flex-col gap-2 mt-5">
                    <label class="text-lime-600" for="price">Price of product</label>
                    <input class="outline-0 border border-lime-600 rounded-md px-2 py-1 focus:ring-4 ring-lime-100 transition-all duration-300" type="number" name="price" id="price">
                </div>
                <div class="flex flex-col gap-2 mt-5">
                    <button type="submit" name="submit" class="border-2 border-lime-600 rounded-md shadow bg-white py-1 font-semibold text-lime-600 hover:bg-lime-600 hover:text-white transition-all duration-300">Add Product</button>
                    <a class="inline-block text-center border-2 border-rose-600 rounded-md shadow bg-white py-1 font-semibold text-rose-600 hover:bg-rose-600 hover:text-white transition-all duration-300" href="../../index.php">Cancel</a>
                </div>
            <?php endif ?>
        </form>
    </main>
</body>
</html>