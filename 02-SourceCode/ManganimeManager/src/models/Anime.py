from .Base import Base
from ..utils.data_interactions import load_data

class Anime(Base):
    """ # Anime class
    @class
    
    Description :
    ---
        This class will represent an anime.
        
    Inheritance :
    ---
        Base : src.models.Base.Base
    """
    JSON_FILE = "src/data/animes.json"
    
    def __init__(self, id: int, name: str, seasons: int, episodes: int, rate: float):
        super().__init__(id, name, rate)
        self.seasons = seasons
        self.episodes = episodes

    # Public methods --------------------------------------------------------------------------------------------
    def delete(self) -> tuple[bool, str]:
        """ # Delete
        @public
        
        Description :
        ---
            Delete an anime.
        
        Returns :
        ---
            :rtype:`tuple` : The response of the deletion
        """
        return self._delete_entry(Anime.JSON_FILE)
    
    def update(self, name: str = None, seasons: str = None, episodes: str = None, rate: str = None) -> tuple[bool, str]:
        """ # Update
        @public
        
        Description :
        ---
            Update an anime.
            
        Arguments :
        ---
            :attribute:`name` : str : The name of the anime
            :attribute:`seasons` : int : The number of seasons
            :attribute:`episodes` : int : The number of episodes
            :attribute:`rate` : float : The rate of the anime
            
        Returns :
        ---
            :rtype:`tuple` : The response of the update
        """
        data = load_data(Anime.JSON_FILE)

        # Check if the entry exists
        if not self._check_if_exists(data):
            return (False, "This entry does not exist")

        # Update the entry
        self.name = name if name else self.name
        self.seasons = int(seasons) if seasons else self.seasons
        self.episodes = int(episodes) if episodes else self.episodes
        self.rate = float(rate) if rate else self.rate
        return self._update_entry(Anime.JSON_FILE)
    
    # Static methods --------------------------------------------------------------------------------------------
    @staticmethod
    def get_last_id() -> int:
        """ # Get the last id
        @static
        
        Description :
        ---
            Get the last id of the list.
            
        Returns :
        ---
            :rtype:`int` : The last id
        """
        return Base.get_last_id(Anime.JSON_FILE) + 1
    
    @staticmethod
    def add(name: str, seasons: int, episodes: int, rate: int) -> tuple[bool, str]:
        """ # Add
        @static
        
        Description :
        ---
            Add an anime to the list.
            
        Arguments :
        ---
            :attribute:`name` : str : The name of the anime
            :attribute:`seasons` : int : The number of seasons
            :attribute:`episodes` : int : The number of episodes
            :attribute:`rate` : float : The rate of the anime
            
        Returns :
        ---
            :rtype:`tuple` : The response of the addition
        """
        return Anime(Anime.get_last_id(), name, seasons, episodes, rate)._add_entry(Anime.JSON_FILE)

    @staticmethod
    def get_all() -> list["Anime"]:
        """ # Get all
        @static
        
        Description :
        ---
            Get all the animes.
            
        Returns :
        ---
            :rtype:`list` : The list of animes
        """
        return Anime.from_json(load_data(Anime.JSON_FILE))
    
    @staticmethod
    def get_by_name(name: str) -> "Anime":
        """ # Get by name
        @static
        
        Description :
        ---
            Get an anime by its name.
            
        Arguments :
        ---
            :attribute:`name` : str : The name of the anime
            
        Returns :
        ---
            :rtype:`Anime` : The anime
        """
        anime = Base.get_entry_by_name(Anime.JSON_FILE, name)
        return Anime(anime["id"], anime["name"], anime["seasons"], anime["episodes"], anime["rate"])
    
    @staticmethod
    def from_json(anime: list) -> list["Anime"]:
        """ # From JSON
        @static
        
        Description :
        ---
            Convert the JSON data to animes.
            
        Arguments :
        ---
            :attribute:`anime` : list : The JSON data
            
        Returns :
        ---
            :rtype:`list` : The list of animes
        """
        return [Anime(value["id"], value['name'], value['seasons'], value['episodes'], value['rate']) for value in anime]