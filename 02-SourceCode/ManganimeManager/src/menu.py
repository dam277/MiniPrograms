import inquirer
import os

from .utils.enums.Commands import Commands
from .utils.data_interactions import load_data
from .utils.Logger import Logger, Level

# Initialize the logger
def menu(app_values: dict) -> tuple[str, str|None]:
    """ # Show the menu
    @open
    
    Description :
    ---
        This function will show the menu to the user and return the choice and option selected.
        
    Arguments :
    ---
        :attribute:`app_values` : dict : The values of the application
        
    Returns :
    ---
        :rtype:`tuple[str, str|None]` : The choice and option selected
    """
    # Get the menu options
    option: str = None
    choices: dict|list = app_values.get("menu").get("options")
    has_choices: bool = True

    # While there are choices, show the menu
    while has_choices:
        # Menu options using inquirer
        menu = [inquirer.List('option', message="What do you want to do ?", choices=choices, carousel=True)]
        choice: str = inquirer.prompt(menu)["option"]

        # If the choice is a dict, get the value of the key
        if isinstance(choices, list) or not choices.get(choice):
            has_choices = False
            # Clear the screen
            os.system("cls")
        else:
            choices = choices.get(choice)
            option = choice
    
    return choice, option

def execute_command(command: dict, choice: str) -> None:
    """ # Execute the command
    @open

    Description :
    ---
        This function will execute the command chosen by the user.

    Arguments :
    ---
        :attribute:`command` : dict : The command to execute
        :attribute:`choice` : str : The choice selected by the user

    Returns :
    ---
        None
    """
    # Check if the command exists
    if not command:
        Logger.get_instance().error("Command not found")
        return
    
    # Get the command and execute it
    cmd = Commands.get(command.get("name"))
    cmd.execute(choice)

def get_data() -> dict:
    """ # Get the data
    @open

    Description :
    ---
        This function will load the data from the app.json file.

    Arguments :
    ---
        None

    Returns :
    ---
        :rtype:`dict` : The values of the application
    """
    # Get all the animes, mangas and app values
    path = os.path.join(os.path.dirname(__file__), 'data', 'app.json')
    app_values = load_data(path)
    if not app_values:
        Logger.get_instance().error("Error loading data")
        return

    Logger.get_instance().success("Data loaded successfully")
    return app_values