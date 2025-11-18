<?php
class CharacterController {
    private $characterModel;
    private $abilityModel;
    
    public function __construct() {
        $this->characterModel = new Character();
        $this->abilityModel = new Ability();
    }
    
    public function index() {
        $characters = $this->characterModel->getAllCharacters();
        $this->render('characters/index', ['characters' => $characters]);
    }
    
    public function show($id) {
        $character = $this->characterModel->getCharacterById($id);
        $primaryAbilities = $this->characterModel->getPrimaryClassAbilities($id);
        $secondaryAbilities = $this->characterModel->getSecondaryClassAbilities($id);
        $allClasses = $this->abilityModel->getAllClasses();
        
        // Handle form submissions
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['action'])) {
                switch ($_POST['action']) {
                    case 'update_level':
                        $this->characterModel->updateCharacterLevel($id, $_POST['level']);
                        break;
                    case 'update_secondary_class':
                        $this->characterModel->updateSecondaryClass($id, $_POST['secondary_class']);
                        break;
                }
                // Redirect to prevent form resubmission
                header("Location: index.php?page=character&id=$id");
                exit;
            }
        }
        
        $this->render('characters/show', [
            'character' => $character,
            'primaryAbilities' => $primaryAbilities,
            'secondaryAbilities' => $secondaryAbilities,
            'allClasses' => $allClasses
        ]);
    }
    
    public function abilities() {
        $abilities = $this->abilityModel->getAllAbilities();
        $classes = $this->abilityModel->getAllClasses();
        
        $this->render('abilities/index', [
            'abilities' => $abilities,
            'classes' => $classes
        ]);
    }
    
    private function render($view, $data = []) {
        extract($data);
        include "views/layout.php";
    }
}
?>
