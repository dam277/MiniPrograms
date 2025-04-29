<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <?php
    include_once 'global.php';
    
    session_start();

    // Define the base path to the pages directory
    $pagesDir = __DIR__ . '/pages';

    // Get the url
    $url = $_SERVER['REQUEST_URI'];
    $url = ltrim($url, '/');
    $url = explode('?', $url)[0];

    // Get the requested route
    $route = $url === "" ? 'home' : $url;

    // Construct the file path
    $filePath = $pagesDir . '/' . $route . '.php';

    // Check if the file exists
    if (file_exists($filePath)) {
        // Include the requested page
        include $filePath;
    } else {
        // Include a 404 error page if the file doesn't exist
        include $pagesDir . '/404.php';
    }

    // count the number of time the url has / - 1
    function import($url) 
    {
        for($i = 0; $i < substr_count($url, '/'); $i++)
            echo '../';
    }
    ?>
    <script src=<?=import($url)."main.js"?>></script>
</body>
</html>