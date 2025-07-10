<?php
class Ability {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function getAllAbilities() {
        return $this->db->getAbilities();
    }
    
    public function getAbilitiesByClass($className) {
        $abilities = $this->db->getAbilities();
        $classAbilities = [];
        
        foreach ($abilities as $ability) {
            if ($ability['class_name'] === $className) {
                $classAbilities[] = $ability;
            }
        }
        
        return $classAbilities;
    }
    
    public function getPassiveAbilities() {
        $abilities = $this->db->getAbilities();
        $passiveAbilities = [];
        
        foreach ($abilities as $ability) {
            if ($ability['is_passive']) {
                $passiveAbilities[] = $ability;
            }
        }
        
        return $passiveAbilities;
    }
    
    public function getActiveAbilities() {
        $abilities = $this->db->getAbilities();
        $activeAbilities = [];
        
        foreach ($abilities as $ability) {
            if (!$ability['is_passive']) {
                $activeAbilities[] = $ability;
            }
        }
        
        return $activeAbilities;
    }
    
    public function getAbilityById($id) {
        $abilities = $this->db->getAbilities();
        
        foreach ($abilities as $ability) {
            if ($ability['id'] == $id) {
                return $ability;
            }
        }
        
        return null;
    }
    
    public function getAllClasses() {
        $abilities = $this->db->getAbilities();
        $classes = [];
        
        foreach ($abilities as $ability) {
            if (!in_array($ability['class_name'], $classes)) {
                $classes[] = $ability['class_name'];
            }
        }
        
        sort($classes);
        return $classes;
    }
}
?>
