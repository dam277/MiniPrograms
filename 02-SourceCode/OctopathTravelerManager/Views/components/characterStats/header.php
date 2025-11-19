<article class="flex items-center gap-4 m-4">
    <img src="<?= $character->image ?>" alt="">
    <div class="w-full">
        <h1 class="text-xl font-bold"><?= $character->name ?></h1>
        <hr class="my-2 border-gray-700">
        <span>Lv. <?= $character->level ?></span>
    </div>
</article>