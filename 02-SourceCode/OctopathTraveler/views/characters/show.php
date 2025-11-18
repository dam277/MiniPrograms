<!-- Character Header -->
<div class="glass-effect rounded-lg p-6 mb-8">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <div class="w-16 h-16 bg-octopath-gold rounded-full flex items-center justify-center">
                <span class="text-2xl font-bold text-black">
                    <?php echo substr($character['name'], 0, 1); ?>
                </span>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-octopath-gold"><?php echo htmlspecialchars($character['name']); ?></h1>
                <p class="text-gray-300"><?php echo htmlspecialchars($character['description']); ?></p>
            </div>
        </div>
        <a href="index.php?page=home" class="bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded-md transition-colors">
            ← Back to Characters
        </a>
    </div>
</div>

<!-- Character Stats -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="glass-effect rounded-lg p-6">
        <h3 class="text-lg font-bold mb-4 text-octopath-gold">Level</h3>
        <form method="POST" class="flex items-center space-x-2">
            <input type="hidden" name="action" value="update_level">
            <input type="number" name="level" value="<?php echo $character['level']; ?>" min="1" max="99" 
                   class="bg-gray-700 border border-gray-600 rounded px-3 py-2 text-white w-20">
            <button type="submit" class="bg-octopath-gold text-black px-4 py-2 rounded hover:bg-yellow-500 transition-colors">
                Update
            </button>
        </form>
    </div>
    
    <div class="glass-effect rounded-lg p-6">
        <h3 class="text-lg font-bold mb-4 text-green-400">Primary Class</h3>
        <p class="text-xl font-medium"><?php echo htmlspecialchars($character['primary_class']); ?></p>
        <p class="text-sm text-gray-400 mt-2">Cannot be changed</p>
    </div>
    
    <div class="glass-effect rounded-lg p-6">
        <h3 class="text-lg font-bold mb-4 text-blue-400">Secondary Class</h3>
        <form method="POST" class="space-y-2">
            <input type="hidden" name="action" value="update_secondary_class">
            <select name="secondary_class" class="bg-gray-700 border border-gray-600 rounded px-3 py-2 text-white w-full">
                <option value="">None</option>
                <?php foreach ($allClasses as $class): ?>
                    <?php if ($class !== $character['primary_class']): ?>
                        <option value="<?php echo htmlspecialchars($class); ?>" 
                                <?php echo ($character['secondary_class'] === $class) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($class); ?>
                        </option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors">
                Update Class
            </button>
        </form>
    </div>
</div>

<!-- Primary Class Abilities -->
<div class="mb-8">
    <h2 class="text-2xl font-bold mb-6 text-green-400">
        <span class="inline-block w-4 h-4 bg-green-400 rounded-full mr-2"></span>
        Primary Class Abilities (<?php echo htmlspecialchars($character['primary_class']); ?>)
    </h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php 
        $activeAbilities = array_filter($primaryAbilities, function($ability) { return !$ability['is_passive']; });
        $passiveAbilities = array_filter($primaryAbilities, function($ability) { return $ability['is_passive']; });
        
        foreach ($activeAbilities as $ability): ?>
            <div class="ability-card rounded-lg p-4 border-green-400">
                <div class="flex items-start justify-between mb-3">
                    <h4 class="font-bold text-lg text-green-400">
                        <?php echo htmlspecialchars($ability['name']); ?>
                    </h4>
                </div>
                
                <div class="flex items-center space-x-4 mb-3">
                    <span class="text-sm bg-blue-600 px-2 py-1 rounded">SP: <?php echo $ability['sp_cost']; ?></span>
                    <span class="text-sm bg-purple-600 px-2 py-1 rounded">Active</span>
                </div>
                
                <p class="text-sm text-gray-300"><?php echo htmlspecialchars($ability['description']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    
    <?php if (!empty($passiveAbilities)): ?>
        <h3 class="text-xl font-bold mt-8 mb-4 text-green-400">Passive Abilities</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <?php foreach ($passiveAbilities as $ability): ?>
                <div class="ability-card rounded-lg p-4 border-green-400">
                    <div class="flex items-start justify-between mb-3">
                        <h4 class="font-bold text-lg text-green-400">
                            <?php echo htmlspecialchars($ability['name']); ?>
                        </h4>
                    </div>
                    
                    <div class="flex items-center space-x-4 mb-3">
                        <span class="text-sm bg-yellow-600 px-2 py-1 rounded">Passive</span>
                    </div>
                    
                    <p class="text-sm text-gray-300"><?php echo htmlspecialchars($ability['description']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<!-- Secondary Class Abilities -->
<?php if (!empty($secondaryAbilities)): ?>
<div class="mb-8">
    <h2 class="text-2xl font-bold mb-6 text-blue-400">
        <span class="inline-block w-4 h-4 bg-blue-400 rounded-full mr-2"></span>
        Secondary Class Abilities (<?php echo htmlspecialchars($character['secondary_class']); ?>)
    </h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php 
        $activeSecondaryAbilities = array_filter($secondaryAbilities, function($ability) { return !$ability['is_passive']; });
        $passiveSecondaryAbilities = array_filter($secondaryAbilities, function($ability) { return $ability['is_passive']; });
        
        foreach ($activeSecondaryAbilities as $ability): ?>
            <div class="ability-card rounded-lg p-4 border-blue-400">
                <div class="flex items-start justify-between mb-3">
                    <h4 class="font-bold text-lg text-blue-400">
                        <?php echo htmlspecialchars($ability['name']); ?>
                    </h4>
                </div>
                
                <div class="flex items-center space-x-4 mb-3">
                    <span class="text-sm bg-blue-600 px-2 py-1 rounded">SP: <?php echo $ability['sp_cost']; ?></span>
                    <span class="text-sm bg-purple-600 px-2 py-1 rounded">Active</span>
                </div>
                
                <p class="text-sm text-gray-300"><?php echo htmlspecialchars($ability['description']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    
    <?php if (!empty($passiveSecondaryAbilities)): ?>
        <h3 class="text-xl font-bold mt-8 mb-4 text-blue-400">Passive Abilities</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <?php foreach ($passiveSecondaryAbilities as $ability): ?>
                <div class="ability-card rounded-lg p-4 border-blue-400">
                    <div class="flex items-start justify-between mb-3">
                        <h4 class="font-bold text-lg text-blue-400">
                            <?php echo htmlspecialchars($ability['name']); ?>
                        </h4>
                    </div>
                    
                    <div class="flex items-center space-x-4 mb-3">
                        <span class="text-sm bg-yellow-600 px-2 py-1 rounded">Passive</span>
                    </div>
                    
                    <p class="text-sm text-gray-300"><?php echo htmlspecialchars($ability['description']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
<?php else: ?>
<div class="glass-effect rounded-lg p-8 text-center">
    <h2 class="text-xl font-bold mb-4 text-gray-400">No Secondary Class Selected</h2>
    <p class="text-gray-300">Choose a secondary class above to unlock additional abilities for this character.</p>
</div>
<?php endif; ?>
