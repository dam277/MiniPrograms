<div class="mb-8">
    <h1 class="text-4xl font-bold text-center mb-4 text-octopath-gold">Choose Your Traveler</h1>
    <p class="text-center text-gray-300 text-lg">Select a character to manage their abilities and progression</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <?php foreach ($characters as $character): ?>
        <div class="glass-effect rounded-lg overflow-hidden card-hover">
            <div class="aspect-w-16 aspect-h-9 bg-gradient-to-br from-octopath-purple to-octopath-blue">
                <div class="flex items-center justify-center">
                    <div class="w-20 h-20 bg-octopath-gold rounded-full flex items-center justify-center">
                        <span class="text-2xl font-bold text-black">
                            <?php echo substr($character['name'], 0, 1); ?>
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="p-6">
                <h3 class="text-xl font-bold mb-2 text-octopath-gold"><?php echo htmlspecialchars($character['name']); ?></h3>
                <p class="text-gray-300 text-sm mb-4"><?php echo htmlspecialchars($character['description']); ?></p>
                
                <div class="space-y-2 mb-4">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-400">Level:</span>
                        <span class="text-sm font-medium"><?php echo $character['level']; ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-400">Primary Class:</span>
                        <span class="text-sm font-medium text-green-400"><?php echo htmlspecialchars($character['primary_class']); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-400">Secondary Class:</span>
                        <span class="text-sm font-medium text-blue-400"><?php echo htmlspecialchars($character['secondary_class'] ?? 'None'); ?></span>
                    </div>
                </div>
                
                <a href="index.php?page=character&id=<?php echo $character['id']; ?>" 
                   class="block w-full bg-octopath-gold text-black text-center py-2 rounded-md font-medium hover:bg-yellow-500 transition-colors">
                    Manage Character
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="mt-12 text-center">
    <div class="glass-effect rounded-lg p-8 max-w-2xl mx-auto">
        <h2 class="text-2xl font-bold mb-4 text-octopath-gold">About the Game</h2>
        <p class="text-gray-300 leading-relaxed">
            Octopath Traveler is a JRPG featuring eight unique characters, each with their own story and abilities. 
            This character manager helps you track your characters' abilities, manage their secondary classes, 
            and monitor their progression throughout your journey.
        </p>
    </div>
</div>
