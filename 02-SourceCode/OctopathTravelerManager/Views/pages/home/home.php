<main class="min-h-screen bg-gray-900 text-white p-8">
    <div class="mb-8">
        <h2 class="text-2xl font-bold mb-4">What you can do here:</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-gray-800 p-4 rounded-lg">
                <h3 class="font-bold mb-2">Character Management</h3>
                <p>Track your party members, their levels, and equipment</p>
            </div>
            <div class="bg-gray-800 p-4 rounded-lg">
                <h3 class="font-bold mb-2">Items Tracker</h3>
                <p>Keep inventory of your items, weapons, and accessories</p>
            </div>
            <div class="bg-gray-800 p-4 rounded-lg">
                <h3 class="font-bold mb-2">Abilities Management</h3>
                <p>Monitor skills, job classes, and passive abilities</p>
            </div>
        </div>

        <h2 class="text-2xl font-bold mb-4">Choose your game:</h2>
        <div class="flex flex-col items-center">
            <div class="flex flex-wrap gap-20">
                <?php foreach ($games as $game): ?>
                    <a href="?action=game&id=<?= $game->id_game ?>" class="bg-gray-800 aspect-square p-4 rounded-lg cursor-pointer hover:bg-gray-700 hover:-translate-y-2 transition-all duration-300 ease-in-out bg-cover bg-center w-64 h-64" style="background-image: url('<?= $game->cover ?>');">
                        <div class="bg-black bg-opacity-50 p-4 rounded">
                            <h3 class="text-xl font-bold mb-3"><?= $game->name ?></h3>
                            <p><?= $game->description ?></p>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>