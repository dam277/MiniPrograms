from .Command import Command
from ..models import Anime, Manga

class Add(Command):
    """ # Add Command
    @class
    
    Description :
    ---
        This class will add an anime or a manga to the list.
    
    Inheritance :
    ---
        Command : src.commands.Command.Command 
    """
    def __init__(self):
        super().__init__()

    # Public functions --------------------------------------------------------------------------------------------
    @Command.register("Add")
    def execute(self, choice: str) -> None:
        """ # Execute
        @public
        @override
        
        Description :
        ---
            Execute the command.
            
        Arguments :
        ---
            :attribute:`choice` : str : The choice selected by the user
        
        Returns :
        ---
            None
        """
        response = None
        
        # Check the choice and add data
        if choice == "Anime":
            # Get the information of the anime
            name, seasons, episodes, rate = input("Enter the information of your anime (name,seasons,episodes,rate): ").split(",")

            # Add the anime
            response = Anime.add(name, int(seasons), int(episodes), float(rate))
        elif choice == "Manga":
            # Get the information of the manga
            name, tomes, rate = input("Enter the information of you manga (name,tomes,rate): ").split(",")

            # Add the manga
            response = Manga.add(name, int(tomes), float(rate))

        # Log the response
        self._display_response(response)