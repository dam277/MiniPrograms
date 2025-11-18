
<main class="min-h-screen p-8">
    <div class="mb-8">
        <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Add Character
        </button>
    </div>
    
    <div>
        <?php if (!empty($charactersByGame)): ?>
            <?php foreach ($charactersByGame as $game => $characters): ?>
                <h2 class="text-white text-xl mb-2"><?= htmlspecialchars($game) ?></h2>
                <?= View::getComponent(viewName: "charactersList", params: ["characters" => $characters]); ?>
                <hr class="my-4 border-gray-700">
            <?php endforeach; ?>
        <?php elseif (!empty($characters)): ?>
            <?= View::getComponent(viewName: "charactersList", params: ["characters" => $characters]); ?>
        <?php endif; ?>
    </div>
</main>