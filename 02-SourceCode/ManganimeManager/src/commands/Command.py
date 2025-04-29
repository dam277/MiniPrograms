from abc import abstractmethod, ABC
from ..utils.Logger import Logger
import inquirer

class Command(ABC):
    """ # Command class
    @class
    @abstract
    
    Description :
    ---
        This class is the parent class of all the commands.
        
    Inheritance :
    ---
        ABC : abc.ABC : Abstract base class
    """
    # Static attributes --------------------------------------------------------------------------------------------
    commands = []   # List of commands

    # Class methods --------------------------------------------------------------------------------------------
    def _display_response(self, response: tuple) -> None:
        """ # Display the response
        @protected
        
        Description :
        ---
            This method will display the response of the command.
            
        Arguments :
        ---
            :attribute:`response` : tuple : The response of the command
            
        Returns :
        ---
            None
        """
        # Log the response
        if not response[0]:
            Logger.get_instance().error(response[1], True)
        else:
            Logger.get_instance().success(response[1], True)

    def _display_choices(self, choices: list, message: str) -> str:
        """ # Display the choices
        @protected
        
        Description :
        ---
            This method will display the choices to the user.
            
        Arguments :
        ---
            :attribute:`choices` : list : The choices to display
            :attribute:`message` : str : The message to display
            
        Returns :
        ---
            :rtype:`str` : The choice selected by the user
        """
        question = [inquirer.List('delete', message=message, choices=choices, carousel=True)]
        return inquirer.prompt(question)["delete"]

    # Abstract methods --------------------------------------------------------------------------------------------
    @abstractmethod
    def execute(self, choice: str) -> None:
        """ # Execute
        @abstract
        
        Description :
        ---
            Base method to execute any command that is inherited from this class.
            
        Arguments :
        ---
            :attribute:`choice` : str : The choice selected by the user
            
        Returns :
        ---
            None
        """
        pass
    
    # Static methods --------------------------------------------------------------------------------------------
    @staticmethod
    def register(name: str, parent: str = None) -> callable:
        """ # Register decorator
        @static
        
        Description :
        ---
            This method is a decorator to register a command.
            
        Arguments :
        ---
            :attribute:`name` : str : The name of the command
            :attribute:`parent` : str : The parent command
            
        Returns :
        ---
            :rtype:`callable` : The decorator
        """
        # Check if the command is already registered
        if Command.get_command(name):
            Logger.get_instance().error(f"Command [{name}] already registered")
            return
        def decorator(func: callable):
            # Add the command to the list
            Logger.get_instance().info(f"Registering command [{name}]", True)
            Command.commands.append({"name": name, "parent": parent})
            def wrapper(*args, **kwargs):
                return func(*args, **kwargs)
            return wrapper
        return decorator
    
    @staticmethod
    def get_command(name: str) -> dict:
        """ # Get command
        @static
        
        Description :
        ---
            This method will get the command by its name.
            
        Arguments :
        ---
            :attribute:`name` : str : The name of the command
            
        Returns :
        ---
            :rtype:`dict` : The command
        """
        return next((command for command in Command.commands if command.get("name") == name), None)
    
    @staticmethod
    def get_commands() -> list:
        """ # Get commands
        @static
        
        Description :
        ---
            This method will get all the commands.
            
        Arguments :
        ---
            None
        
        Returns :
        ---
            :rtype:`list` : The list of commands
        """
        return Command.commands