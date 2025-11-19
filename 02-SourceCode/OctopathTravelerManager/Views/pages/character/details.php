<main class="min-h-screen p-8 bg-gray-900 text-white">
    <!-- Tabs Navigation -->
    <div class="border-b border-gray-700 mb-6">
        <nav class="flex space-x-4">
            <?php foreach ($tabs as $tabPath => $tabName): ?>
                <a href="?action=characters&id=<?= $character->id_character ?>&tab=<?= $tabPath ?>" class="px-4 py-2 text-sm font-medium <?= $tab === $tabPath ? 'border-b-2 border-blue-500' : 'text-gray-400 hover:text-white' ?>"><?= $tabName ?></a>
            <?php endforeach; ?>
        </nav>
    </div>
    
    <!-- Character Info Section -->
    <div class="flex">
        <!-- Left section with character info -->
        <section class="bg-gray-800 rounded-lg p-2 w-2/3">
            <!-- Character header -->
            <?= View::getComponent(viewName: "characterStats.header", params: ["character" => $character]); ?>   
            <?php switch ($tab) 
            {
                case "stats":
                    // Character stats
                    echo View::getComponent(viewName: "characterStats", params: ["character" => $character, "classes" => $classes, "weaponTypes" => $weaponTypes]);
                    break;
                case "skills":
                    // Character skills
                    echo View::getComponent(viewName: "characterSkills", params: ["character" => $character]);
                    break;
                case "equipment":
                    // Character equipment
                    echo View::getComponent(viewName: "characterEquipment", params: ["character" => $character]);
                    break;
                case "talents":
                    // Character talents
                    echo View::getComponent(viewName: "characterTalents", params: ["character" => $character]);
                    break;
                default:
                    echo "<p class='text-gray-400'>Nothing to show...</p>";
            } 
            ?>
        </section>

        <!-- Right section with character artwork -->
        <section class="w-1/3 ml-6">
            <img src="<?= $character->backgroundImage ?>" alt="" class="rounded-lg w-full h-auto">
        </section>
    </div>
</main>