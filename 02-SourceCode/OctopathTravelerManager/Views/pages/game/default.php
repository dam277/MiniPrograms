<main class="min-h-screen bg-gray-900 text-white">
    <!-- Banner Section -->
    <div class="w-full bg-gray-800 p-0 mb-8">
        <img src="<?= $game->banner ?>" alt="<?= $game->name ?>" class="h-full w-full">
    </div>
    <!-- Cards Grid -->
    <?php
    $links = [
        "characters" => "Characters",
        "abilities" => "Abilities",
        "items" => "Items",
        "classes" => "Classes",
        "enemies" => "Enemies",
    ];
    ?>
    <div class="container mx-auto px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Link Card -->
            <?php foreach ($links as $key => $label): ?>
                <a href="?action=<?= $key ?>&gameId=<?= $game->id_game ?>" class="bg-gray-800 rounded-lg p-6 hover:bg-gray-700 transition-colors w-full">
                    <h2 class="text-2xl font-bold mb-2"><?= $label ?></h2>
                    <p class="text-gray-400">Manage and view all <?= strtolower($label) ?></p>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</main>