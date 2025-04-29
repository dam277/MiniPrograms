<?php
function getArrayFromJson(string $jsonFile) : array
{
    $json = file_get_contents(__DIR__ . '/data/' . $jsonFile);
    return json_decode($json, true);
}

function getByCourseId(bool $hasIndex = true) : array
{
    // Only keep where fk_course === $_GET['idCourse']
    $exercises = array_filter(getArrayFromJson('exercises.json'), function($exercise) 
    {
        return $exercise['fk_course'] == $_GET['idCourse'];
    });

    if ($hasIndex) 
        return $exercises;

    return $exercises[0];
}

function getCourseNameById() : string
{
    $courses = getArrayFromJson('courses.json');
    foreach ($courses as $course) 
    {
        if ($course['id'] == $_GET['idCourse']) 
        {
            return $course['name'];
        }
    }
    return '';
}