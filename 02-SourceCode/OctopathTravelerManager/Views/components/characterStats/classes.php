<article class="bg-gray-900 rounded-lg px-4 m-4 border border-gray-700">
    <table class="w-full">
        <tbody>
            <tr class="border-b border-gray-700">
                <th class="text-left py-2 text-gray-400 w-[40%]">Primary Job</th>
                <td class="py-2 w-[20%]">
                    <img src="<?= $classes[0]->image ?>" alt="" class="w-10 h-10 inline-block">
                </td>
                <td class="py-2 w-[40%]"><?= $classes[0]->name ?></td>
            </tr>
            <tr class="border-b border-gray-700">
                <th class="text-left py-2 text-gray-400">Secondary Job</th>
                <td class="py-2">
                    <img src="<?= $classes[1]->image ?>" alt="" class="w-10 h-10 inline-block">
                </td>
                <td class="py-2"><?= $classes[1]->name ?></td>
            </tr>
            <tr class="border-b border-gray-700">
                <th class="text-left py-2 text-gray-400">Weapon Types</th>
                <td class="py-2 flex items-center gap-2">
                    <?php foreach ($weaponTypes as $weaponType): ?>
                        <img src="<?= $weaponType->image ?>" alt="" class="w-10 h-10 inline-block">
                    <?php endforeach; ?>
                </td>
                <td class="py-2">
                    <?php foreach ($weaponTypes as $key => $weaponType): ?>
                        <span><?= $weaponType->name ?></span>
                        <?php if ($key < count($weaponTypes) - 1): ?>
                            <span class="text-gray-500">- </span>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </td>
            </tr>
        </tbody>
    </table>
</article>