# Octopath Traveler Character Manager

A modern PHP web application for managing Octopath Traveler 1 characters and their abilities, built with MVC architecture and styled with Tailwind CSS.

## Features

- **Character Management**: View all 8 main characters with their stats and descriptions
- **Ability Tracking**: Track primary and secondary class abilities for each character
- **Level Management**: Update character levels
- **Class System**: Manage secondary classes for each character
- **Modern UI**: Beautiful, responsive design with Tailwind CSS
- **Database Management**: SQLite database with automatic seeding

## Character Features

### Primary Classes
- **Cleric** (Ophilia): Healing and light magic
- **Scholar** (Cyrus): Elemental magic and analysis
- **Merchant** (Tressa): Support abilities and wind magic
- **Warrior** (Olberic): Physical combat and tanking
- **Dancer** (Primrose): Buffs and dark magic
- **Apothecary** (Alfyn): Healing and item creation
- **Thief** (Therion): Stealth and debuffs
- **Hunter** (H'aanit): Beast mastery and bow skills

### Ability Management
- Track unlocked/locked abilities
- Separate active and passive abilities
- SP cost display for active abilities
- Ability descriptions and effects

## Installation

1. **Requirements**:
   - PHP 7.4 or higher
   - SQLite3 extension enabled
   - Web server (Apache/Nginx) or PHP built-in server

2. **Setup**:
   ```bash
   # Clone or download the project
   cd OctopathTraveler
   
   # Start PHP development server
   php -S localhost:8000
   ```

3. **Access**:
   - Open your browser and go to `http://localhost:8000`
   - The database will be automatically created and seeded on first run

## File Structure

```
OctopathTraveler/
├── index.php                 # Front controller
├── config/
│   └── database.php          # Database configuration and seeding
├── models/
│   ├── Character.php         # Character model
│   └── Ability.php           # Ability model
├── controllers/
│   └── CharacterController.php # Main controller
├── views/
│   ├── layout.php            # Main layout template
│   ├── characters/
│   │   ├── index.php         # Character listing
│   │   └── show.php          # Character details
│   └── abilities/
│       └── index.php         # All abilities view
├── database/
│   └── octopath.db          # SQLite database (auto-created)
└── README.md
```

## Usage

### Managing Characters
1. Visit the home page to see all characters
2. Click "Manage Character" to view detailed character information
3. Update character level using the level form
4. Change secondary class using the class dropdown

### Managing Abilities
1. In character view, see primary and secondary class abilities
2. Click "Unlock" or "Lock" to toggle ability availability
3. Abilities are organized by active/passive categories
4. View all abilities across all classes in the "All Abilities" section

### Features per Page

#### Home Page (`index.php`)
- Grid view of all 8 characters
- Character stats overview
- Quick navigation to character details

#### Character Details (`index.php?page=character&id=X`)
- Character information and stats
- Level management
- Secondary class selection
- Primary class abilities (always available)
- Secondary class abilities (based on selected class)
- Ability unlock/lock functionality

#### All Abilities (`index.php?page=abilities`)
- Complete ability reference
- Filter by class
- Organized by active/passive abilities
- Statistics overview

## Database Schema

### Characters Table
- `id`: Primary key
- `name`: Character name
- `primary_class`: Cannot be changed
- `secondary_class`: Can be updated
- `level`: Current character level
- `image`: Character image filename
- `description`: Character description

### Abilities Table
- `id`: Primary key
- `name`: Ability name
- `type`: 'active' or 'passive'
- `class_name`: Associated class
- `sp_cost`: SP required (for active abilities)
- `description`: Ability description
- `is_passive`: Boolean flag

### Character_Abilities Table
- Junction table linking characters to abilities
- `character_id`: Foreign key to characters
- `ability_id`: Foreign key to abilities
- `is_unlocked`: Boolean tracking unlock status

## Technical Details

### Architecture
- **MVC Pattern**: Clean separation of concerns
- **Single Entry Point**: All requests go through index.php
- **Simple Routing**: URL parameter-based routing
- **Database Layer**: Singleton pattern for database connection

### Security Features
- Prepared statements for SQL queries
- HTML escaping in views
- CSRF protection through form methods
- Input validation and sanitization

### Styling
- **Tailwind CSS**: Utility-first CSS framework
- **Custom Theme**: Octopath-inspired color scheme
- **Responsive Design**: Mobile-friendly layout
- **Glass Morphism**: Modern UI effects
- **Hover Effects**: Interactive elements

## Customization

### Adding New Characters
1. Insert into `characters` table
2. Add abilities to `character_abilities` table
3. Update seeding in `database.php`

### Adding New Abilities
1. Insert into `abilities` table
2. Link to appropriate characters
3. Update class filtering logic

### Styling Changes
- Modify Tailwind classes in views
- Update custom CSS in `layout.php`
- Adjust color scheme in Tailwind config

## Browser Compatibility

- Modern browsers (Chrome, Firefox, Safari, Edge)
- Responsive design for mobile and desktop
- JavaScript for interactive features

## License

This project is for educational purposes and fan use. Octopath Traveler is owned by Square Enix.
