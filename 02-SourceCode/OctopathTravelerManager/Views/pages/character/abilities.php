<main class="min-h-screen p-8">
    <div class="max-w-4xl mx-auto">
        <!-- Character Stats Header -->
        <div class="flex justify-between items-center mb-6 text-gray-200">
            <div class="flex items-center gap-4">
                <span class="text-xl">Primrose</span>
                <span class="text-sm text-gray-400">Danseur</span>
            </div>
            <div class="flex items-center gap-2">
                <span>PC obtenus</span>
                <span class="text-cyan-400">379 PC</span>
            </div>
        </div>

        <!-- Abilities Grid -->
        <div class="grid grid-cols-2 gap-8">
            <!-- Left Column -->
            <div class="space-y-6">
                <h3 class="text-gray-400 text-lg mb-4">Aptitudes</h3>
                <div class="space-y-3">
                    <?php
                    foreach($mainClassAbilities as $ability) {
                        echo '<div class="flex justify-between items-center text-gray-300 p-2 hover:bg-gray-800 rounded">
                            <span>' . $ability . '</span>
                            <svg class="w-5 h-5 text-cyan-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                            </svg>
                        </div>';
                    }
                    ?>
                </div>
            </div>

            <!-- Second class Column -->
            <?php if (isset($secondaryClassAbilities) && !empty($secondaryClassAbilities)): ?>
            <div class="space-y-6">
                <h3 class="text-gray-400 text-lg mb-4">Érudit</h3>
                <div class="space-y-3">
                    <?php
                    foreach($secondaryClassAbilities as $ability) {
                        echo '<div class="flex justify-between items-center text-gray-300 p-2 hover:bg-gray-800 rounded">
                            <span>' . $ability . '</span>
                            <svg class="w-5 h-5 text-cyan-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                            </svg>
                        </div>';
                    }
                    ?>
                </div>
            </div>
            <?php else: ?>
            <div class="space-y-6">
                <h3 class="text-gray-400 text-lg mb-4">Aucune classe secondaire</h3>
                <p class="text-gray-500">Aucune aptitude de classe secondaire disponible.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</main>