<main class="bg-gray-100 flex items-center justify-center h-screen w-full">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-4xl h-3/4">
        <?php   

        if(isset($_POST) && sizeof($_POST) > 0)
            $_SESSION["answers"][$_GET["idQuestion"] - 1] = $_POST;

        // Fetch question and answer from database (dummy data for example)
        $exercise = getByCourseId(false);
        $questions = $exercise["questions"];
        $question = isset($questions[$_GET["idQuestion"] - 1]) ? $questions[$_GET["idQuestion"] - 1] : null;

        if(sizeof($questions) < $_GET["idQuestion"]) : ?>
            <h1 class='text-2xl font-bold mb-4'>Exercise completed</h1>
            <!-- Verification of the answers -->
            <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
                <h2 class="text-2xl font-semibold mb-4">Results</h2>
                <ul class="list-disc list-inside">
                    <?php
                    echo "<pre>";
                    var_dump($_SESSION);
                    $correctAnswers = 0;
                    foreach ($questions as $key => $correctQuestion) :
                        echo "<pre>";
                        // echo "Key: $key";
                        // var_dump($correctQuestion);
                        if($correctQuestion["type"] == "multipleChoice" || $correctQuestion["type"] == "trueFalse" || $correctQuestion["type"] == "longAnswer")
                        {   
                            var_dump($correctQuestion["correctAnswer"]);
                            var_dump($_SESSION["answers"][$key]);

                            if(str_replace(' ', '', $correctQuestion["correctAnswer"]) == str_replace(' ', '', $_SESSION["answers"][$key]["answer"]))
                                $correctAnswers++;
                        }
                        else if($correctQuestion["type"] == "multipleText")
                        {
                            foreach($_SESSION["answers"][$key+1] as $answer)
                                if(in_array($answer, $correctQuestion["correctAnswers"]))
                                    $correctAnswers++;
                        }
                    endforeach;
                    ?>
                    <li class="mb-2">Correct answers: <span class="font-bold"><?= $correctAnswers ?></span></li>
                    <li class="mb-2">Total questions: <span class="font-bold"><?= sizeof($questions) ?></span></li>
                    <li class="mb-2">Score: <span class="font-bold"><?= ($correctAnswers / sizeof($questions)) * 100 ?>%</span></li>
                </ul>
            </div>
        <?php 
        return;
        endif; 
        ?>

        <h1 class="text-2xl font-bold mb-4"><?= $question["question"] ?></h1>

        <form method="POST" class="mb-4" action="/course/exercise/question?idCourse=<?= $_GET["idCourse"] ?>&idExercise=<?= $_GET["idExercise"] ?>&idQuestion=<?= $_GET["idQuestion"]+1 ?>">
            <?php switch($question["type"])
            {
                case "multipleChoice":
                    foreach ($question["answers"] as $answer) :
            ?>
                        <label class="flex items center mb-2">
                            <input type="radio" name="answer" id="multipleAnswer" value="<?= $answer["id"] ?>" class="mr-2">
                            <span><?= $answer["answer"] ?></span>
                        </label>
            <?php 
                    endforeach;
                    break;
                case "trueFalse":
            ?>
                    <label class="flex items center mb-2">
                        <input type="radio" name="answer" id="falseAnswer" value="true" class="mr-2">
                        <span>True</span>
                    </label>
                    <label class="flex items center mb-2">
                        <input type="radio" name="answer" id="trueAnswer" value="false" class="mr-2">
                        <span>False</span>
                    </label>
            <?php
                    break;
                case "multipleText":
            ?>
                    <div id="answers" class="mb-4">

                    </div>
                    <button class="bg-green-500 text-white px-4 py-2 rounded" type="button" onclick="addTextInput('answers')">Add answer</button>
            <?php 
                    break;
                case "longAnswer":
            ?>
                    <textarea type="text" name="answer" id="longAnswer" class="border p-2 w-full mb-4 h-96" placeholder="Your answer"></textarea>
            <?php
            }
            ?>

            <div class="flex justify-between mt-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
                <?php if ($_GET["idQuestion"] > 1) : ?>
                    <a href="/course/exercise/question?idCourse=<?= $_GET["idCourse"] ?>&idExercise=<?= $_GET["idExercise"] ?>&idQuestion=<?= $_GET["idQuestion"]-1 ?>" class="bg-gray-500 text-white px-4 py-2 rounded">Previous</a>
                <?php endif; ?>
            </div>
        </form>
        <?php

        echo "<pre>";
        var_dump($_SESSION["answers"]);
        echo "</pre>";
        ?>
    </div>
</main>
