<?php
require "../../db.php";

$result = dataStatistic();

$dataPoints = [];

while ($data = $result->fetch_assoc()) {
    $dataPoints[] = ["label"=> $data["product_name"],  "y"=> $data["product_name"] === null ? 0 : (int) $data["total_transaction"]];
    // if ($data["total_transaction"] === null) {
    //     $dataPoints[] = ["label"=> $data["product_name"],  "y"=> 0];
    // } else {
    //     $dataPoints[] = ["label"=> $data["product_name"],  "y"=> (int) $data["total_transaction"]];
    // }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Statistic</title>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
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
            <a href="./index.php" class="flex flex-col gap-2 items-center md:mt-15">
                <img class="w-[10rem]" src="../assets/img/food-logo.png" alt="logo">
                <p class="font-semibold text-4xl text-lime-500 uppercase">My Resto</p>
            </a>
        </div>
        <ul class="flex flex-col gap-5 mt-10">
            <li>
                <a href="../../index.php" class="flex gap-2 text-xl font-semibold items-center text-lime-600 justify-center border-2 border-lime-600 rounded-md p-2 shadow hover:bg-lime-600 hover:text-white transition-all duration-300"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" /></svg> <span>Menu</span></a>
            </li>
            <li>
                <a href="./cart.php" class="flex gap-2 text-xl font-semibold items-center text-lime-600 justify-center border-2 border-lime-600 rounded-md p-2 shadow hover:bg-lime-600 hover:text-white transition-all duration-300">
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
                <a href="./statistic.php" class="flex gap-2 text-xl font-semibold items-center text-white bg-lime-600 justify-center border-2 border-lime-600 rounded-md p-2 shadow hover:bg-lime-600 hover:text-white transition-all duration-300">
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
    <main class="md:ml-96 mt-16 md:mt-0" style="padding: 40px">
        <section class="border-b-2 border-lime-800 pb-2 flex justify-between items-center">
            <h1 class="text-lime-600 font-semibold text-2xl md:text-4xl">Product Sales Data</h1>
        </section>
        <div id="chartContainer" class="p-5 bg-white rounded-xl shadow-md" style="margin-top: 100px; widht: 100%; height: 60vh;"></div>
    </main>
    <script type="text/javascript">
        window.onload = function () {
            var chart = new CanvasJS.Chart("chartContainer", {
                // title:{
                //     text: "Popular Article"              
                // },
                data: [              
                    {
                        type: "column",
                        dataPoints: <?= json_encode($dataPoints) ?>
                    }
                ]
            });
            chart.render();
        }
    </script>
</body>
</html>