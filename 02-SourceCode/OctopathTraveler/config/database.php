<?php
class Database {
    private static $instance = null;
    private $dataPath;
    
    private function __construct() {
        $this->dataPath = __DIR__ . '/../database/';
        if (!file_exists($this->dataPath)) {
            mkdir($this->dataPath, 0777, true);
        }
        $this->initializeData();
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    
    public function getCharacters() {
        $file = $this->dataPath . 'characters.json';
        if (file_exists($file)) {
            return json_decode(file_get_contents($file), true);
        }
        return [];
    }
    
    public function getCharacterById($id) {
        $characters = $this->getCharacters();
        foreach ($characters as $character) {
            if ($character['id'] == $id) {
                return $character;
            }
        }
        return null;
    }
    
    public function getAbilities() {
        $file = $this->dataPath . 'abilities.json';
        if (file_exists($file)) {
            return json_decode(file_get_contents($file), true);
        }
        return [];
    }
    
    public function getAbilitiesByJob($job) {
        $abilities = $this->getAbilities();
        return array_filter($abilities, function($ability) use ($job) {
            return $ability['job'] === $job;
        });
    }
    
    private function initializeData() {
        $charactersFile = $this->dataPath . 'characters.json';
        $abilitiesFile = $this->dataPath . 'abilities.json';
        
        if (!file_exists($charactersFile)) {
            $characters = [
                [
                    'id' => 1,
                    'name' => 'Ophilia',
                    'primary_class' => 'Cleric',
                    'secondary_class' => null,
                    'level' => 1,
                    'description' => 'A kind cleric who travels to kindle the Sacred Flame.',
                    'image' => 'ophilia.jpg'
                ],
                [
                    'id' => 2,
                    'name' => 'Cyrus',
                    'primary_class' => 'Scholar',
                    'secondary_class' => null,
                    'level' => 1,
                    'description' => 'A royal scholar in search of a forbidden tome.',
                    'image' => 'cyrus.jpg'
                ],
                [
                    'id' => 3,
                    'name' => 'Tressa',
                    'primary_class' => 'Merchant',
                    'secondary_class' => null,
                    'level' => 1,
                    'description' => 'A cheerful merchant seeking adventure and profit.',
                    'image' => 'tressa.jpg'
                ],
                [
                    'id' => 4,
                    'name' => 'Olberic',
                    'primary_class' => 'Warrior',
                    'secondary_class' => null,
                    'level' => 1,
                    'description' => 'A former knight seeking to test his blade.',
                    'image' => 'olberic.jpg'
                ],
                [
                    'id' => 5,
                    'name' => 'Primrose',
                    'primary_class' => 'Dancer',
                    'secondary_class' => null,
                    'level' => 1,
                    'description' => 'A dancer seeking revenge for her father\'s murder.',
                    'image' => 'primrose.jpg'
                ],
                [
                    'id' => 6,
                    'name' => 'Alfyn',
                    'primary_class' => 'Apothecary',
                    'secondary_class' => null,
                    'level' => 1,
                    'description' => 'A kind apothecary who helps those in need.',
                    'image' => 'alfyn.jpg'
                ],
                [
                    'id' => 7,
                    'name' => 'Therion',
                    'primary_class' => 'Thief',
                    'secondary_class' => null,
                    'level' => 1,
                    'description' => 'A skilled thief bound by dragonstones.',
                    'image' => 'therion.jpg'
                ],
                [
                    'id' => 8,
                    'name' => 'H\'aanit',
                    'primary_class' => 'Hunter',
                    'secondary_class' => null,
                    'level' => 1,
                    'description' => 'A skilled hunter tracking a dangerous beast.',
                    'image' => 'haanit.jpg'
                ]
            ];
            
            file_put_contents($charactersFile, json_encode($characters, JSON_PRETTY_PRINT));
        }
        
        if (!file_exists($abilitiesFile)) {
            $abilities = [
                // Cleric abilities
                ['id' => 1, 'name' => 'Heal', 'class_name' => 'Cleric', 'type' => 'active', 'sp_cost' => 7, 'description' => 'Restore HP to a single ally.', 'is_passive' => false],
                ['id' => 2, 'name' => 'Heal More', 'class_name' => 'Cleric', 'type' => 'active', 'sp_cost' => 13, 'description' => 'Restore HP to all allies.', 'is_passive' => false],
                ['id' => 3, 'name' => 'Light', 'class_name' => 'Cleric', 'type' => 'active', 'sp_cost' => 4, 'description' => 'Deal light damage to a single foe.', 'is_passive' => false],
                ['id' => 4, 'name' => 'Luminescence', 'class_name' => 'Cleric', 'type' => 'active', 'sp_cost' => 10, 'description' => 'Deal light damage to all foes.', 'is_passive' => false],
                ['id' => 5, 'name' => 'Reflective Veil', 'class_name' => 'Cleric', 'type' => 'active', 'sp_cost' => 16, 'description' => 'Reflect a single elemental attack back at the enemy.', 'is_passive' => false],
                ['id' => 6, 'name' => 'Heal All', 'class_name' => 'Cleric', 'type' => 'active', 'sp_cost' => 22, 'description' => 'Fully restore HP to all allies.', 'is_passive' => false],
                ['id' => 7, 'name' => 'Revive', 'class_name' => 'Cleric', 'type' => 'active', 'sp_cost' => 30, 'description' => 'Revive a fallen ally and restore some HP.', 'is_passive' => false],
                ['id' => 8, 'name' => 'Saving Grace', 'class_name' => 'Cleric', 'type' => 'passive', 'sp_cost' => 0, 'description' => 'Receive healing past maximum HP.', 'is_passive' => true],
                
                // Scholar abilities
                ['id' => 9, 'name' => 'Fireball', 'class_name' => 'Scholar', 'type' => 'active', 'sp_cost' => 7, 'description' => 'Deal fire damage to a single foe.', 'is_passive' => false],
                ['id' => 10, 'name' => 'Icewind', 'class_name' => 'Scholar', 'type' => 'active', 'sp_cost' => 7, 'description' => 'Deal ice damage to a single foe.', 'is_passive' => false],
                ['id' => 11, 'name' => 'Lightning Bolt', 'class_name' => 'Scholar', 'type' => 'active', 'sp_cost' => 7, 'description' => 'Deal lightning damage to a single foe.', 'is_passive' => false],
                ['id' => 12, 'name' => 'Analyze', 'class_name' => 'Scholar', 'type' => 'active', 'sp_cost' => 1, 'description' => 'Reveal a single foe\'s weaknesses.', 'is_passive' => false],
                ['id' => 13, 'name' => 'Fire Storm', 'class_name' => 'Scholar', 'type' => 'active', 'sp_cost' => 13, 'description' => 'Deal fire damage to all foes.', 'is_passive' => false],
                ['id' => 14, 'name' => 'Blizzard', 'class_name' => 'Scholar', 'type' => 'active', 'sp_cost' => 13, 'description' => 'Deal ice damage to all foes.', 'is_passive' => false],
                ['id' => 15, 'name' => 'Thunder Storm', 'class_name' => 'Scholar', 'type' => 'active', 'sp_cost' => 13, 'description' => 'Deal lightning damage to all foes.', 'is_passive' => false],
                ['id' => 16, 'name' => 'Elemental Aid', 'class_name' => 'Scholar', 'type' => 'passive', 'sp_cost' => 0, 'description' => 'Augment elemental attacks when at full health.', 'is_passive' => true],
                
                // Merchant abilities
                ['id' => 17, 'name' => 'Collect', 'class_name' => 'Merchant', 'type' => 'active', 'sp_cost' => 2, 'description' => 'Gain money based on user\'s level.', 'is_passive' => false],
                ['id' => 18, 'name' => 'Tradewinds', 'class_name' => 'Merchant', 'type' => 'active', 'sp_cost' => 8, 'description' => 'Deal wind damage to a single foe.', 'is_passive' => false],
                ['id' => 19, 'name' => 'Rest', 'class_name' => 'Merchant', 'type' => 'active', 'sp_cost' => 4, 'description' => 'Restore HP and SP to a single ally.', 'is_passive' => false],
                ['id' => 20, 'name' => 'Trade Tempest', 'class_name' => 'Merchant', 'type' => 'active', 'sp_cost' => 12, 'description' => 'Deal wind damage to all foes.', 'is_passive' => false],
                ['id' => 21, 'name' => 'Donate', 'class_name' => 'Merchant', 'type' => 'active', 'sp_cost' => 2, 'description' => 'Spend money to deal damage to a single foe.', 'is_passive' => false],
                ['id' => 22, 'name' => 'Hired Help', 'class_name' => 'Merchant', 'type' => 'active', 'sp_cost' => 18, 'description' => 'Spend money to summon help.', 'is_passive' => false],
                ['id' => 23, 'name' => 'Sidestep', 'class_name' => 'Merchant', 'type' => 'passive', 'sp_cost' => 0, 'description' => 'Gain a 25% chance to avoid physical attacks.', 'is_passive' => true],
                ['id' => 24, 'name' => 'Endless Items', 'class_name' => 'Merchant', 'type' => 'passive', 'sp_cost' => 0, 'description' => 'Items will not be consumed when used.', 'is_passive' => true],
                
                // Warrior abilities
                ['id' => 25, 'name' => 'Sword Strike', 'class_name' => 'Warrior', 'type' => 'active', 'sp_cost' => 4, 'description' => 'Deal sword damage to a single foe.', 'is_passive' => false],
                ['id' => 26, 'name' => 'Crossstrike', 'class_name' => 'Warrior', 'type' => 'active', 'sp_cost' => 8, 'description' => 'Deal damage to a single foe twice.', 'is_passive' => false],
                ['id' => 27, 'name' => 'Thousand Spears', 'class_name' => 'Warrior', 'type' => 'active', 'sp_cost' => 12, 'description' => 'Deal random polearm damage to all foes.', 'is_passive' => false],
                ['id' => 28, 'name' => 'Brand\'s Thunder', 'class_name' => 'Warrior', 'type' => 'active', 'sp_cost' => 30, 'description' => 'Deal lightning damage to all foes.', 'is_passive' => false],
                ['id' => 29, 'name' => 'Incite', 'class_name' => 'Warrior', 'type' => 'active', 'sp_cost' => 4, 'description' => 'Provoke a single foe to attack only you.', 'is_passive' => false],
                ['id' => 30, 'name' => 'Abide', 'class_name' => 'Warrior', 'type' => 'active', 'sp_cost' => 1, 'description' => 'Increase physical attack for 3 turns.', 'is_passive' => false],
                ['id' => 31, 'name' => 'Surpassing Power', 'class_name' => 'Warrior', 'type' => 'passive', 'sp_cost' => 0, 'description' => 'Ignore damage limit of 9999.', 'is_passive' => true],
                ['id' => 32, 'name' => 'Physical Prowess', 'class_name' => 'Warrior', 'type' => 'passive', 'sp_cost' => 0, 'description' => 'Gain bonus physical attack based on the number of weapons equipped.', 'is_passive' => true],
                
                // Dancer abilities
                ['id' => 33, 'name' => 'Mole Dance', 'class_name' => 'Dancer', 'type' => 'active', 'sp_cost' => 4, 'description' => 'Decrease a single foe\'s physical defense for 3 turns.', 'is_passive' => false],
                ['id' => 34, 'name' => 'Moonbeam Waltz', 'class_name' => 'Dancer', 'type' => 'active', 'sp_cost' => 7, 'description' => 'Deal dark damage to a single foe.', 'is_passive' => false],
                ['id' => 35, 'name' => 'Peacock Strut', 'class_name' => 'Dancer', 'type' => 'active', 'sp_cost' => 4, 'description' => 'Increase a single ally\'s physical attack for 3 turns.', 'is_passive' => false],
                ['id' => 36, 'name' => 'Lion Dance', 'class_name' => 'Dancer', 'type' => 'active', 'sp_cost' => 16, 'description' => 'Increase a single ally\'s physical attack, accuracy, and critical rate.', 'is_passive' => false],
                ['id' => 37, 'name' => 'Bewildering Grace', 'class_name' => 'Dancer', 'type' => 'active', 'sp_cost' => 25, 'description' => 'Cause a random effect to occur.', 'is_passive' => false],
                ['id' => 38, 'name' => 'Sealticge\'s Seduction', 'class_name' => 'Dancer', 'type' => 'active', 'sp_cost' => 30, 'description' => 'Deal dark damage to all foes.', 'is_passive' => false],
                ['id' => 39, 'name' => 'Allure', 'class_name' => 'Dancer', 'type' => 'active', 'sp_cost' => 3, 'description' => 'Charm a single foe to act as an ally.', 'is_passive' => false],
                ['id' => 40, 'name' => 'Eye for an Eye', 'class_name' => 'Dancer', 'type' => 'passive', 'sp_cost' => 0, 'description' => 'When receiving damage, gain a chance to act again.', 'is_passive' => true],
                
                // Apothecary abilities
                ['id' => 41, 'name' => 'Concoct', 'class_name' => 'Apothecary', 'type' => 'active', 'sp_cost' => 4, 'description' => 'Mix items to create powerful effects.', 'is_passive' => false],
                ['id' => 42, 'name' => 'First Aid', 'class_name' => 'Apothecary', 'type' => 'active', 'sp_cost' => 4, 'description' => 'Restore HP to a single ally.', 'is_passive' => false],
                ['id' => 43, 'name' => 'Icicle', 'class_name' => 'Apothecary', 'type' => 'active', 'sp_cost' => 6, 'description' => 'Deal ice damage to a single foe.', 'is_passive' => false],
                ['id' => 44, 'name' => 'Rehabilitate', 'class_name' => 'Apothecary', 'type' => 'active', 'sp_cost' => 8, 'description' => 'Cure a single ally of all status ailments.', 'is_passive' => false],
                ['id' => 45, 'name' => 'Amputation', 'class_name' => 'Apothecary', 'type' => 'active', 'sp_cost' => 10, 'description' => 'Deal axe damage to a single foe and inflict bleeding.', 'is_passive' => false],
                ['id' => 46, 'name' => 'Empoison', 'class_name' => 'Apothecary', 'type' => 'active', 'sp_cost' => 6, 'description' => 'Deal axe damage to a single foe and inflict poison.', 'is_passive' => false],
                ['id' => 47, 'name' => 'Dohter\'s Charity', 'class_name' => 'Apothecary', 'type' => 'active', 'sp_cost' => 30, 'description' => 'Fully restore HP and SP to all allies.', 'is_passive' => false],
                ['id' => 48, 'name' => 'Hale and Hearty', 'class_name' => 'Apothecary', 'type' => 'passive', 'sp_cost' => 0, 'description' => 'Increases maximum HP.', 'is_passive' => true],
                
                // Thief abilities
                ['id' => 49, 'name' => 'Steal', 'class_name' => 'Thief', 'type' => 'active', 'sp_cost' => 2, 'description' => 'Steal an item from a single foe.', 'is_passive' => false],
                ['id' => 50, 'name' => 'Wildfire', 'class_name' => 'Thief', 'type' => 'active', 'sp_cost' => 7, 'description' => 'Deal fire damage to a single foe.', 'is_passive' => false],
                ['id' => 51, 'name' => 'HP Thief', 'class_name' => 'Thief', 'type' => 'active', 'sp_cost' => 6, 'description' => 'Deal damage to a single foe and recover HP.', 'is_passive' => false],
                ['id' => 52, 'name' => 'Steal SP', 'class_name' => 'Thief', 'type' => 'active', 'sp_cost' => 6, 'description' => 'Steal SP from a single foe.', 'is_passive' => false],
                ['id' => 53, 'name' => 'Share SP', 'class_name' => 'Thief', 'type' => 'active', 'sp_cost' => 4, 'description' => 'Transfer SP from user to a single ally.', 'is_passive' => false],
                ['id' => 54, 'name' => 'Armor Corrosive', 'class_name' => 'Thief', 'type' => 'active', 'sp_cost' => 4, 'description' => 'Decrease a single foe\'s physical and elemental defense.', 'is_passive' => false],
                ['id' => 55, 'name' => 'Larceny', 'class_name' => 'Thief', 'type' => 'active', 'sp_cost' => 30, 'description' => 'Steal from all foes at once.', 'is_passive' => false],
                ['id' => 56, 'name' => 'Fleetfoot', 'class_name' => 'Thief', 'type' => 'passive', 'sp_cost' => 0, 'description' => 'Gain a 25% chance to act twice.', 'is_passive' => true],
                
                // Hunter abilities
                ['id' => 57, 'name' => 'Take Aim', 'class_name' => 'Hunter', 'type' => 'active', 'sp_cost' => 8, 'description' => 'Increase accuracy and critical rate for 3 turns.', 'is_passive' => false],
                ['id' => 58, 'name' => 'True Strike', 'class_name' => 'Hunter', 'type' => 'active', 'sp_cost' => 10, 'description' => 'Deal bow damage to a single foe with high accuracy.', 'is_passive' => false],
                ['id' => 59, 'name' => 'Thunderbird', 'class_name' => 'Hunter', 'type' => 'active', 'sp_cost' => 22, 'description' => 'Deal lightning damage to all foes.', 'is_passive' => false],
                ['id' => 60, 'name' => 'Leghold Trap', 'class_name' => 'Hunter', 'type' => 'active', 'sp_cost' => 12, 'description' => 'Deal damage to a single foe and inflict immobilization.', 'is_passive' => false],
                ['id' => 61, 'name' => 'Mercy Strike', 'class_name' => 'Hunter', 'type' => 'active', 'sp_cost' => 4, 'description' => 'Deal damage to a single foe without killing them.', 'is_passive' => false],
                ['id' => 62, 'name' => 'Rain of Arrows', 'class_name' => 'Hunter', 'type' => 'active', 'sp_cost' => 16, 'description' => 'Deal bow damage to all foes.', 'is_passive' => false],
                ['id' => 63, 'name' => 'Draefendi\'s Rage', 'class_name' => 'Hunter', 'type' => 'active', 'sp_cost' => 30, 'description' => 'Deal massive axe damage to all foes.', 'is_passive' => false],
                ['id' => 64, 'name' => 'Heightened Senses', 'class_name' => 'Hunter', 'type' => 'passive', 'sp_cost' => 0, 'description' => 'Gain first strike in battle.', 'is_passive' => true]
            ];
            
            file_put_contents($abilitiesFile, json_encode($abilities, JSON_PRETTY_PRINT));
        }
    }
}
?>
