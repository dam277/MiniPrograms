<?php if (!empty($characters)): ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php foreach ($characters as $character): ?>
            <a href="?action=characters&id=<?= $character->id_character ?>&tab=stats" class="bg-gray-800/80 rounded-lg p-4 max-w-sm cursor-pointer transform transition-transform hover:scale-105 hover:shadow-lg">
                <div class="flex items-center gap-4">
                    <!-- Character sprite/image -->
                    <div class="w-18 h-24 flex items-center">
                        <img src="<?= $character->image ?>" alt="Character sprite" class="pixel-art rounded-lg">
                    </div>
                    
                    <!-- Character info -->
                    <div class="flex-1">
                        <h2 class="text-white text-xl"><?= $character->name ?></h2>
                        <div class="flex items-center gap-2">
                            <span class="text-gray-300">Lv.</span>
                            <span class="text-white"><?= $character->level ?></span>
                        </div>
                        
                        <!-- HP Bar -->
                        <div class="mt-2">
                            <div class="flex justify-between text-white text-sm">
                                <span>HP</span>
                                <span><?= $character->characteristics["HP"]->value ?? "-" ?></span>
                            </div>
                            <div class="w-full bg-gray-700 rounded-full h-2">
                                <div class="bg-green-500 h-2 rounded-full" style="width: <?= $character->hpPercent ?? 100 ?>%"></div>
                            </div>
                        </div>
                        
                        <!-- PT Bar -->
                        <div class="mt-1">
                            <div class="flex justify-between text-white text-sm">
                                <span>SP</span>
                                <span><?= $character->characteristics["SP"]->value ?? "-" ?></span>
                            </div>
                            <div class="w-full bg-gray-700 rounded-full h-2">
                                <div class="bg-blue-500 h-2 rounded-full" style="width: <?= $character->spPercent ?? 100 ?>%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="text-center text-gray-500">
        <p>No characters found for <?= $game->name ?? "this game" ?>.</p>
    </div>
<?php endif; ?>