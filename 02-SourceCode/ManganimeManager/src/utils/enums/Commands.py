from enum import Enum
from ..Logger import Logger, Level

from ...commands import Add, Delete, List, Update, Command

class Commands(Enum):
    """ # Commands
    @enum
    
    Description :
    ---
        This enumeration will contain all the commands available in the application.
    
    Inheritance :
    ---
        Enum : The enumeration class from the enum module
    """
    ADD = Add
    DELETE = Delete
    LIST = List
    UPDATE = Update

    @staticmethod
    def get(name: str) -> Command.Command:
        """ # Get function for the commands
        @static
        
        Description :
        ---
            This method will get the command by its name.
        
        Arguments :
        ---
            :attribute:`name` : str : The name of the command
        
        Returns :
        ---
            :rtype:`Command` : The command
        """
        try:
            return Commands[name.upper()].value()
        except KeyError:
            Logger.get_instance().error(f"Command {name} not found")
            return None