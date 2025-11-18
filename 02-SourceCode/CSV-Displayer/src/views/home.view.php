<main class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-gray-900 mb-8">CSV Displayer</h1>
            <p class="text-xl text-gray-600 mb-12">Upload and view your CSV files with ease</p>
        </div>
        
        <div class="bg-white shadow-sm rounded-lg p-6">
            <?php foreach ($files as $file): ?>
                <div class="mb-6 pb-6 border-b border-gray-200 last:border-b-0 last:mb-0 last:pb-0">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-2"><?= htmlspecialchars($file->getFilName()) ?></h2>
                    <p class="text-gray-600 mb-4">Uploaded on: <?= htmlspecialchars($file->getFilAddedAt()) ?></p>
                    <a href="?action=details&id=<?= $file->getIdFile() ?>" class="text-blue-600 hover:underline">View details</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>