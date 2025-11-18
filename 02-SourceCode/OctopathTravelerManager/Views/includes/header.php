<header class="bg-gray-800 shadow-lg">
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold text-white mb-4">Octopath Traveler Manager</h1>
        <?php 
        $navigation = [
            "Home" => "/",
            "Characters" => "?action=characters",
            "Abilities" => "?action=abilities",
            "Items" => "?action=items",
            "Settings" => "?action=settings"
        ];
        ?>
        <nav>
            <ul class="flex space-x-6">
                <?php foreach ($navigation as $name => $url): ?>
                    <li>
                        <a href="<?= $url; ?>" class="text-gray-300 hover:text-white transition-colors duration-200 font-medium">
                            <?= $name; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>
</header>
