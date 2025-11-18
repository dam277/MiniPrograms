<div class="mb-8">
    <h1 class="text-4xl font-bold text-center mb-4 text-octopath-gold">All Abilities</h1>
    <p class="text-center text-gray-300 text-lg">Complete list of all abilities in Octopath Traveler</p>
</div>

<!-- Filter by Class -->
<div class="glass-effect rounded-lg p-6 mb-8">
    <h2 class="text-xl font-bold mb-4 text-octopath-gold">Filter by Class</h2>
    <div class="flex flex-wrap gap-2">
        <button onclick="filterByClass('all')" class="filter-btn bg-octopath-gold text-black px-4 py-2 rounded-md hover:bg-yellow-500 transition-colors">
            All Classes
        </button>
        <?php foreach ($classes as $class): ?>
            <button onclick="filterByClass('<?php echo htmlspecialchars($class); ?>')" 
                    class="filter-btn bg-gray-700 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition-colors">
                <?php echo htmlspecialchars($class); ?>
            </button>
        <?php endforeach; ?>
    </div>
</div>

<?php 
$abilitiesByClass = [];
foreach ($abilities as $ability) {
    $abilitiesByClass[$ability['class_name']][] = $ability;
}
?>

<?php foreach ($classes as $class): ?>
    <div class="class-section mb-12" data-class="<?php echo htmlspecialchars($class); ?>">
        <h2 class="text-3xl font-bold mb-6 text-octopath-gold border-b border-gray-700 pb-2">
            <?php echo htmlspecialchars($class); ?>
        </h2>
        
        <?php
        $classAbilities = $abilitiesByClass[$class] ?? [];
        $activeAbilities = array_filter($classAbilities, function($ability) { return !$ability['is_passive']; });
        $passiveAbilities = array_filter($classAbilities, function($ability) { return $ability['is_passive']; });
        ?>
        
        <!-- Active Abilities -->
        <?php if (!empty($activeAbilities)): ?>
            <div class="mb-8">
                <h3 class="text-2xl font-bold mb-4 text-purple-400">Active Abilities</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <?php foreach ($activeAbilities as $ability): ?>
                        <div class="ability-card rounded-lg p-4 border border-gray-600">
                            <div class="flex items-start justify-between mb-3">
                                <h4 class="font-bold text-lg text-white">
                                    <?php echo htmlspecialchars($ability['name']); ?>
                                </h4>
                                <span class="text-sm bg-blue-600 px-2 py-1 rounded">SP: <?php echo $ability['sp_cost']; ?></span>
                            </div>
                            
                            <div class="flex items-center space-x-2 mb-3">
                                <span class="text-sm bg-purple-600 px-2 py-1 rounded">Active</span>
                                <span class="text-sm bg-gray-600 px-2 py-1 rounded"><?php echo htmlspecialchars($ability['class_name']); ?></span>
                            </div>
                            
                            <p class="text-sm text-gray-300"><?php echo htmlspecialchars($ability['description']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
        
        <!-- Passive Abilities -->
        <?php if (!empty($passiveAbilities)): ?>
            <div class="mb-8">
                <h3 class="text-2xl font-bold mb-4 text-yellow-400">Passive Abilities</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <?php foreach ($passiveAbilities as $ability): ?>
                        <div class="ability-card rounded-lg p-4 border border-gray-600">
                            <div class="flex items-start justify-between mb-3">
                                <h4 class="font-bold text-lg text-white">
                                    <?php echo htmlspecialchars($ability['name']); ?>
                                </h4>
                                <span class="text-sm bg-yellow-600 px-2 py-1 rounded">Passive</span>
                            </div>
                            
                            <div class="flex items-center space-x-2 mb-3">
                                <span class="text-sm bg-gray-600 px-2 py-1 rounded"><?php echo htmlspecialchars($ability['class_name']); ?></span>
                            </div>
                            
                            <p class="text-sm text-gray-300"><?php echo htmlspecialchars($ability['description']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php endforeach; ?>

<!-- Statistics -->
<div class="glass-effect rounded-lg p-6 mt-12">
    <h2 class="text-2xl font-bold mb-4 text-octopath-gold">Statistics</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="text-center">
            <div class="text-3xl font-bold text-purple-400 mb-2">
                <?php echo count(array_filter($abilities, function($a) { return !$a['is_passive']; })); ?>
            </div>
            <div class="text-gray-400">Active Abilities</div>
        </div>
        <div class="text-center">
            <div class="text-3xl font-bold text-yellow-400 mb-2">
                <?php echo count(array_filter($abilities, function($a) { return $a['is_passive']; })); ?>
            </div>
            <div class="text-gray-400">Passive Abilities</div>
        </div>
        <div class="text-center">
            <div class="text-3xl font-bold text-octopath-gold mb-2">
                <?php echo count($classes); ?>
            </div>
            <div class="text-gray-400">Total Classes</div>
        </div>
    </div>
</div>

<script>
function filterByClass(className) {
    const sections = document.querySelectorAll('.class-section');
    const buttons = document.querySelectorAll('.filter-btn');
    
    // Reset button styles
    buttons.forEach(btn => {
        btn.classList.remove('bg-octopath-gold', 'text-black');
        btn.classList.add('bg-gray-700', 'text-white');
    });
    
    // Highlight active button
    event.target.classList.remove('bg-gray-700', 'text-white');
    event.target.classList.add('bg-octopath-gold', 'text-black');
    
    // Show/hide sections
    sections.forEach(section => {
        if (className === 'all' || section.dataset.class === className) {
            section.style.display = 'block';
        } else {
            section.style.display = 'none';
        }
    });
}
</script>
