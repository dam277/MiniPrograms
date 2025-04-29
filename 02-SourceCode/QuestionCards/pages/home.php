<main>
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Courses</h1>
            <a href="/add-course" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Add Course</a>
        </div>
        <div class="flex flex-wrap -mx-2">
            <?php


            // Example array of courses with descriptions
            $courses = getArrayFromJson('courses.json');

            foreach ($courses as $course) 
            {
                echo '<div class="w-1/4 p-2">';
                echo '<a href="/course?idCourse=' . $course['id'] . '" class="block bg-white p-4 rounded shadow hover:bg-gray-200">';
                echo '<div class="text-center font-semibold">' . $course['name'] . '</div>';
                echo '<div class="text-center text-gray-600 mt-2">' . $course['description'] . '</div>';
                echo '</a>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</main>