from tkinter import *
from tkinter import ttk

from ..utils.langs import get_translations, Langs
from ..utils.decorators import call_route
from .Page import Page
from ..interfaces.AppInterface import AppInterface

class Home(Page):
    """ # Home page class
    @class
    
    Description :
    ---
        This class will be the home page of the app.
        
    Inheritances :
    ---
        :attribute:`Page` : The page class
    """
    instance: "Home" = None

    def __init__(self, app: AppInterface):
        """ # Constructor
        @constructor
        
        Description :
        ---
            This function will initialize the home page.
            
        Parameters :
        ---
            `AppInterface`:app: The app instance
        """
        super().__init__(app)

    #region Private methods ========================================================
    # -> Events -------------------------------------------------------------------
    def __event(self):
        """ # Event
        @private
        
        Description :
        ---
            This function will be the event of the button.
        """
        call_route("receipes", self.app)
    #endregion ______________________________________________________________________

    #region Public methods ========================================================
    def display(self) -> None:
        """ # Display the home page
        @public
        
        Description :
        ---
            This function will display the home page.
    
        Returns :
        ---
            :rtype: None
        """
        # Display the home page
        translations = get_translations(Langs[self.app.language])

        # Create widgets
        label = {"widget": ttk.Label(self, text=translations.get("welcome"), style="TLabel"), "pack": {"pady": 20}}
        button_recipes = {"widget": ttk.Button(self, text="Recipes", style="TButton", command=self.__event), "pack": {"pady": 10}}
        button_add = {"widget": ttk.Button(self, text="Add Recipe", style="TButton", command=self.__event), "pack": {"pady": 10}}
        button_delete = {"widget": ttk.Button(self, text="Delete Recipe", style="TButton", command=self.__event), "pack": {"pady": 10}}
        button_modify = {"widget": ttk.Button(self, text="Modify Recipe", style="TButton", command=self.__event), "pack": {"pady": 10}}
        
        self._display([label, button_recipes, button_add, button_delete, button_modify])
    #endregion ______________________________________________________________________

    #region Static methods ========================================================
    @staticmethod
    def get_instance(app: AppInterface) -> "Home":
        """ # Get the instance of the home page
        @staticmethod
        
        Description :
        ---
            This function will return the instance of the home page.
            
        Parameters :
        ---
            `AppInterface`:app: The app instance
            
        Returns :
        ---
            :rtype: Home
            :return: The instance of the home page
        """
        if not Home.instance or not Home.instance._is_alive():
            Home.instance = Home(app)
        return Home.instance
    #endregion ______________________________________________________________________
    
