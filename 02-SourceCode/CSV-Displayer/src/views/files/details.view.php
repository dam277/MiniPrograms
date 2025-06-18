<main class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- File details header -->
        <div class="bg-gray-50 p-4 border-b">
            <h1 class="text-2xl font-bold text-gray-800"><?= $file->getFilName() ?></h1>
            <p class="text-sm text-gray-600">Last updated: <?= $file->getFilUpdatedAt() ?></p>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <?php foreach (json_decode($file->getFilHeaders(), true) as $header): ?>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <?= htmlspecialchars($header) ?>
                            </th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($rows as $row): ?>
                        <tr class="hover:bg-gray-50">
                            <?php foreach (json_decode($row->getRowJsonData(), true) as $value): ?>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    <?= htmlspecialchars($value) ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>