<!-- Character jobs --> 
<?= View::getComponent(viewName: "characterStats.classes", params: ["character" => $character, "classes" => $classes, "weaponTypes" => $weaponTypes]); ?>
<!-- Character attributes -->
<?= View::getComponent(viewName: "characterStats.attributes", params: ["character" => $character]); ?>
<!-- Character skills -->
<?= View::getComponent(viewName: "characterStats.skills", params: ["character" => $character]); ?>