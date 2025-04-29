<main>
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Exercises of <?=getCourseNameById()?></h1>
            <a href="/add-exercise" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Add Exercise</a>
        </div>
        <div class="flex flex-wrap-mx-2">
            <?php
            $exercises = getByCourseId();

            foreach ($exercises as $exercise) 
            {
                echo '<div class="w-1/4 p-2">';
                echo '<a href="/course/exercise?idCourse=' . $_GET["idCourse"] . '&idExercise=' . $exercise['id'] . '" class="block bg-white p-4 rounded shadow hover:bg-gray-200">';
                echo '<div class="text-center font-semibold">' . $exercise['name'] . '</div>';
                echo '<div class="text-center text-gray-600 mt-2">' . $exercise['description'] . '</div>';
                echo '</a>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</main>