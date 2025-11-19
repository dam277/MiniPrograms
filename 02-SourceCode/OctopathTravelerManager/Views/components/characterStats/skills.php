<article>
    <div class="bg-black p-1">
        <h2 class="text-lg font-semibold text-gray-400"><?= "Name" ?>'s Unique Actions</h2>
    </div>
    <div class="font-semibold text-gray-300 text-lg p-2 flex flex-col gap-4">
        <div>
            <span class="text-lg font-semibold text-gray-400 w-1/2">Path Action</span>
            <div class="bg-gray-900 rounded-lg border border-gray-700 py-2 px-8">
                <?= $character->pathAction ?>
            </div>
        </div>
        <div>
            <span class="text-lg font-semibold text-gray-400 w-1/2">Talent</span>
            <div class="bg-gray-900 rounded-lg border border-gray-700 py-2 px-8">
                <?= $character->talent ?>
            </div>
        </div>
    </div>
</article>