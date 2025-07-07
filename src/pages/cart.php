<?php
require "../../midlewere.php";
require "../../db.php";

$customers = htmlspecialchars($_SESSION["customers"]);
$result = cartTransaction($customers);

if (isset($_GET["delete"])) {
    $id = htmlspecialchars($_GET["delete"]);
    deleteTransaction($id);
}

if (isset($_GET["payment"])) {
    $id = htmlspecialchars($_GET["payment"]);
    endTransaction($id);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="../assets/css/output.css">
</head>
<body class="bg-slate-100 overflow-x-hidden">
    <div class="fixed top-0 bg-white w-screen md:hidden flex items-center justify-between px-5 z-10">
        <a id="btn-menu" href="#" class="text-lime-800">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" /></svg>
        </a>
        <div class="grow flex justify-center">
            <img class="h-16" src="../assets/img/food-logo.png" alt="logo">
        </div>  
    </div>
    <nav id="navside" class="bg-white w-screen md:w-96 h-screen absolute left-[-100vw] md:left-0 top-0 shadow-md px-16 md:p-5 transition-all duration-300 z-20">
        <a id="close-btn" href="#" class="md:hidden flex text-lime-800 w-full justify-end">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
        </a>
        <div class="w-full">
            <a href="../../index.php" class="flex flex-col gap-2 items-center md:mt-15">
                <img class="w-[10rem]" src="../assets/img/food-logo.png" alt="logo">
                <p class="font-semibold text-4xl text-lime-500 uppercase">My Resto</p>
            </a>
        </div>
        <ul class="flex flex-col gap-5 mt-10">
            <li>
                <a href="../../index.php" class="flex gap-2 text-xl font-semibold items-center text-lime-600 justify-center border-2 border-lime-600 rounded-md p-2 shadow hover:bg-lime-600 hover:text-white transition-all duration-300"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" /></svg> <span>Menu</span></a>
            </li>
            <li>
                <a href="./cart.php" class="flex gap-2 text-xl font-semibold bg-lime-600 items-center text-white justify-center border-2 border-lime-600 rounded-md p-2 shadow hover:bg-lime-600 hover:text-white transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" /></svg>
                    <span>Cart</span>
                </a>
            </li>
            <li>
                <a href="./history.php" class="flex gap-2 text-xl font-semibold items-center text-lime-600 justify-center border-2 border-lime-600 rounded-md p-2 shadow hover:bg-lime-600 hover:text-white transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" /></svg>
                    <span>History</span>
                </a>
            </li>
            <li>
                <a href="./statistic.php" class="flex gap-2 text-xl font-semibold items-center text-lime-600 justify-center border-2 border-lime-600 rounded-md p-2 shadow hover:bg-lime-600 hover:text-white transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" /></svg>
                    <span>Statistic</span>
                </a>
            </li>
        </ul>
        <div class="mt-10 border-2 border-lime-600 w-20 h-20 flex justify-center items-center rounded-md text-lime-600 mx-auto hover:text-white hover:bg-lime-600 transition-all duration-300">
            <a href="../../index.php?logout=1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" /></svg>
            </a>
        </div>
    </nav>
    <main class="md:ml-96 mt-16 md:mt-0 p-2">
        <section class="border-b-2 border-lime-800 pb-2 flex justify-between items-center">
            <h1 class="text-lime-600 font-semibold text-2xl md:text-4xl">Order List</h1>
        </section>
        <section>
            <?php if (mysqli_num_rows($result) != 0) :?>
                <?php while ($data = $result->fetch_assoc()) : ?>
                    <div class="w-full bg-white mt-2 flex p-2 rounded-md shadow gap-2">
                        <img src="../assets/img/food-img.avif" alt="food" width="100px">
                        <div class="grow">
                            <p class="font-semibold"><?= $data["product_name"] ?></p>
                            <p><?= $data["price"] ?> x <?= $data["quantity"] ?></p>
                            <p class="font-semibold">Total: <?= $data["total_price"] ?></p>
                            <div class="flex justify-end gap-2 items-center">
                                <a href="./cart.php?payment=<?= $data["id"] ?>" class="bg-lime-600 font-semibold px-3 py-1 text-white rounded-md shadow">Pay for now</a>
                                <a href="./cart.php?delete=<?= $data["id"] ?>" class="bg-rose-600 font-semibold px-3 py-1 text-white rounded-md shadow">Delete</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile ?>
            <?php else: ?>
                <div class="w-full mt-2">
                    <p class="font-semibold text-slate-300 italic text-center">Currently thhere is no transaction!</p>
                </div>
            <?php endif ?>
        </section>
    </main>

    <section src="../assets/js/cart.js"></section>
</body>
</html>