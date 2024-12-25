from .Command import Command
from ..models import Anime, Manga

class Delete(Command):
    """ # Delete Command
    @class
    
    Description :
    ---
        This class offers the possibility to delete an anime or a manga from the list.
        
    Inheritance :
    ---
        Command : src.commands.Command.Command
    """
    def __init__(self):
        super().__init__()

    # Public functions --------------------------------------------------------------------------------------------
    @Command.register("Delete")
    def execute(self, choice):
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

        # Check the choice and delete data
        if choice == "Anime":
            animes = Anime.get_all()
            answer = self._display_choices([anime.name for anime in animes], "Select the anime you want to delete")
            anime = Anime.get_by_name(answer)
            response = anime.delete()
        else:
            mangas = Manga.get_all()
            answer = self._display_choices([manga.name for manga in mangas], "Select the manga you want to delete")
            manga = Manga.get_by_name(answer)
            response = manga.delete()

        # Log the response
        self._display_response(response)
        

        