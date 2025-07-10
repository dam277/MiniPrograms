<?php
class Character {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function getAllCharacters() {
        return $this->db->getCharacters();
    }
    
    public function getCharacterById($id) {
        return $this->db->getCharacterById($id);
    }
    
    public function getCharacterAbilities($characterId) {
        $character = $this->db->getCharacterById($characterId);
        if (!$character) {
            return [];
        }
        
        $abilities = $this->db->getAbilities();
        $characterAbilities = [];
        
        foreach ($abilities as $ability) {
            if ($ability['class_name'] === $character['primary_class'] || 
                $ability['class_name'] === $character['secondary_class']) {
                $characterAbilities[] = $ability;
            }
        }
        
        return $characterAbilities;
    }
    
    public function getPrimaryClassAbilities($characterId) {
        $character = $this->db->getCharacterById($characterId);
        if (!$character) {
            return [];
        }
        
        $abilities = $this->db->getAbilities();
        $primaryAbilities = [];
        
        foreach ($abilities as $ability) {
            if ($ability['class_name'] === $character['primary_class']) {
                $primaryAbilities[] = $ability;
            }
        }
        
        return $primaryAbilities;
    }
    
    public function getSecondaryClassAbilities($characterId) {
        $character = $this->db->getCharacterById($characterId);
        if (!$character || !$character['secondary_class']) {
            return [];
        }
        
        $abilities = $this->db->getAbilities();
        $secondaryAbilities = [];
        
        foreach ($abilities as $ability) {
            if ($ability['class_name'] === $character['secondary_class']) {
                $secondaryAbilities[] = $ability;
            }
        }
        
        return $secondaryAbilities;
    }
    
    public function updateCharacterLevel($characterId, $level) {
        $characters = $this->db->getCharacters();
        
        foreach ($characters as &$character) {
            if ($character['id'] == $characterId) {
                $character['level'] = $level;
                break;
            }
        }
        
        $file = __DIR__ . '/../database/characters.json';
        file_put_contents($file, json_encode($characters, JSON_PRETTY_PRINT));
        
        return true;
    }
    
    public function updateSecondaryClass($characterId, $secondaryClass) {
        $characters = $this->db->getCharacters();
        
        foreach ($characters as &$character) {
            if ($character['id'] == $characterId) {
                $character['secondary_class'] = $secondaryClass;
                break;
            }
        }
        
        $file = __DIR__ . '/../database/characters.json';
        file_put_contents($file, json_encode($characters, JSON_PRETTY_PRINT));
        
        return true;
    }
}
?>
