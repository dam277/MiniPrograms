<main class="min-h-screen bg-gray-900 flex items-center justify-center px-4">
    <div class="text-center">
        <h1 class="text-9xl font-bold text-gray-100"><?= $errorCode ?></h1>
        <h2 class="text-4xl font-semibold text-gray-300 mt-4"><?= $errorMessage ?></h2>
        <p class="text-gray-400 mt-4"><?= $errorDescription ?></p>
        <a href="/" class="inline-block mt-8 px-6 py-3 bg-blue-700 text-white rounded-lg hover:bg-blue-800 transition-colors">
            Go Home
        </a>
    </div>
</main>