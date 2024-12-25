from .Base import Base
from ..utils.data_interactions import load_data

class Manga(Base):
    """ # Manga class
    @class
    
    Description :
    ---
        This class will represent a manga.
        
    Inheritance :
    ---
        Base : src.models.Base.Base
    """
    JSON_FILE = "src/data/mangas.json"

    def __init__(self, id: int, name: str, tomes: int, rate: float):
        super().__init__(id, name, rate)
        self.tomes = tomes
    
    # Public methods --------------------------------------------------------------------------------------------
    def delete(self) -> tuple[bool, str]:
        """ # Delete
        @public
        
        Description :
        ---
            Delete a manga.
            
        Returns :
        ---
            :rtype:`tuple` : The response of the deletion
        """
        return self._delete_entry(Manga.JSON_FILE)
    
    def update(self, name: str = None, tomes: str = None, rate: str = None) -> tuple[bool, str]:
        """ # Update
        @public
        
        Description :
        ---
            Update a manga.
            
        Arguments :
        ---
            :attribute:`name` : str : The name of the manga
            :attribute:`tomes` : int : The number of tomes
            :attribute:`rate` : float : The rate of the manga
            
        Returns :
        ---
            :rtype:`tuple` : The response of the update
        """
        data = load_data(Manga.JSON_FILE)

        # Check if the entry exists
        if not self._check_if_exists(data):
            return (False, "This entry does not exist")

        # Update the entry
        self.name = name if name else self.name
        self.tomes = int(tomes) if tomes else self.tomes
        self.rate = float(rate) if rate else self.rate
        return self._update_entry(Manga.JSON_FILE)
    
    # Static methods --------------------------------------------------------------------------------------------
    @staticmethod
    def get_last_id() -> int:
        """ # Get last id
        @static
        
        Description :
        ---
            Get the last id of the JSON file.
            
        Returns :
        ---
            :rtype:`int` : The last id
        """
        return Base.get_last_id(Manga.JSON_FILE) + 1

    @staticmethod
    def add(name: str, tomes:int, rate: int) -> tuple[bool, str]:
        """ # Add
        @static
        
        Description :
        ---
            Add a manga to the list.
            
        Arguments :
        ---
            :attribute:`name` : str : The name of the manga
            :attribute:`tomes` : int : The number of tomes
            :attribute:`rate` : float : The rate of the manga
            
        Returns :
        ---
            :rtype:`tuple` : The response of the addition
        """
        return Manga(Manga.get_last_id(), name, tomes, rate)._add_entry(Manga.JSON_FILE)
        
    @staticmethod
    def get_all() -> list["Manga"]:
        """ # Get all
        @static
        
        Description :
        ---
            Get all the mangas from the JSON file.
            
        Returns :
        ---
            :rtype:`list` : The list of mangas
        """
        return Manga.from_json(load_data(Manga.JSON_FILE))
    
    @staticmethod
    def get_by_name(name: str) -> "Manga":
        """ # Get by name
        @static
        
        Description :
        ---
            Get a manga by its name.
            
        Arguments :
        ---
            :attribute:`name` : str : The name of the manga
            
        Returns :
        ---
            :rtype:`Manga` : The manga
        """
        manga = Base.get_entry_by_name(Manga.JSON_FILE, name)
        return Manga(manga["id"], manga["name"], manga["tomes"], manga["rate"])
    
    @staticmethod
    def from_json(manga: list) -> list["Manga"]:
        """ # From JSON
        @static
        
        Description :
        ---
            Get the mangas from the JSON file.
            
        Arguments :
        ---
            :attribute:`manga` : list : The list of mangas
            
        Returns :
        ---
            :rtype:`list` : The list of mangas
        """
        return [Manga(value["id"], value['name'], value['tomes'], value['rate']) for value in manga]