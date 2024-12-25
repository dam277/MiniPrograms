from .Command import Command
from ..models import Anime, Manga

class Update(Command):
    """ # Update Command 
    @class
    
    Description :
    ---
        This class offers the possibility to update an anime or a manga from the list.
        
    Inheritance :
    ---
        Command : src.commands.Command.Command
    """
    def __init__(self):
        super().__init__()

    # Public functions --------------------------------------------------------------------------------------------
    @Command.register("Update")
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

        # Check the choice and update data
        if choice == "Anime":
            # Get the name of the anime
            animes = Anime.get_all()
            name = self._display_choices([anime.name for anime in animes], "Select the anime you want to update")

            # Get the information of the anime
            new_name, new_seasons, new_episodes, new_rate = input("Enter the information of your anime (name,seasons,episodes,rate) if no changes (sao,,3,): ").split(",")
            anime = Anime.get_by_name(name)
            
            # Update the anime
            response = anime.update(new_name, new_seasons, new_episodes, new_rate)
        elif choice == "Manga":
            # Get the name of the manga
            mangas = Manga.get_all()
            name = self._display_choices([manga.name for manga in mangas], "Select the manga you want to update")

            # Get the information of the manga
            new_name, new_tomes, new_rate = input("Enter the information of your manga (name,tomes,rate) if no changes (ons,,99): ").split(",")
            manga = Manga.get_by_name(name)
            
            # Update the manga
            response = manga.update(new_name, new_tomes, new_rate)

        # Log the response
        self._display_response(response)