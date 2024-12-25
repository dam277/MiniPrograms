from .Command import Command
from ..models import Anime, Manga
from tabulate import tabulate

class List(Command):
    """ # List command class
    @class
    
    Description :
    ---
        This class will list the animes or mangas.

    Inheritance :
    ---
        Command : src.commands.Command
    """
    def __init__(self):
        super().__init__()

    # Private functions --------------------------------------------------------------------------------------------
    def __display_list(self, table: list, headers: list[list]) -> None:
        """ # Display the list
        @private
        
        Description :
        ---
            This function will display the list of animes or mangas.
            
        Arguments :
        ---
            :attribute:`table` : list : The table to display
            :attribute:`headers` : list : The headers of the table
            
        Returns :
        ---
            None
        """
        print(tabulate(table, headers=headers, tablefmt="fancy_grid"))

    def __sort_list(self, data: list[Anime, Manga]) -> list[Anime|Manga]:
        """ # Sort the list
        @private
        
        Description :
        ---
            This function will sort the list of animes or mangas.
            
        Arguments :
        ---
            :attribute:`data` : list : The data to sort
            
        Returns :
        ---
            :rtype:`list` : The sorted list
        """
        return sorted(data, key=lambda x: x.rate, reverse=True)

    # Public functions --------------------------------------------------------------------------------------------
    @Command.register("List")
    def execute(self, choice: str) -> None:
        """ # Execute the command
        @public

        Description :
        ---
            This function will execute the list command.

        Decorators :
        ---
            @Command.register("List") : Register the function to the command list
        
        Arguments :
        ---
            :attribute:`choice` : str : The choice selected by the user
        
        Returns :
        ---
            None
        """
        # Initialize the headers and table
        headers = []
        table: list[Anime|Manga] = []
        
        # Check the choice and get data
        if choice == "Anime":
            headers = ["N°", "Name", "Seasons", "Episodes", "Rate"]
            animes: list[Anime] = self.__sort_list(Anime.get_all())
            table = [[index + 1, anime.name, anime.seasons, anime.episodes, anime.rate] for index, anime in enumerate(animes)]
            total = [0, "> TOTAL", sum(element[2] for element in table), sum(element[3] for element in table), 0]
        elif choice == "Manga":
            headers = ["N°", "Name", "Tomes", "Rate"]
            mangas: list[Manga] = self.__sort_list(Manga.get_all())
            table = [[index + 1, manga.name, manga.tomes, manga.rate] for index, manga in enumerate(mangas)]
            total = [0, "> TOTAL", sum(element[2] for element in table), 0]
        
        table.append(total)

        # List the data
        self.__display_list(table, headers)