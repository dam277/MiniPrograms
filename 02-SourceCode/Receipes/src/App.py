from tkinter import *
from tkinter import ttk

from .interfaces.AppInterface import AppInterface
from .utils.langs import Langs
from .utils.decorators import route
from .pages import Page, Home, Receipes
from .menus import FileMenu, LangsMenu, ThemesMenu
from .utils.data_interactions import load_data
import os

class App(Tk, AppInterface):
    """ # Main application class 
    @class
    
    Description :
    ---
        This class will be the main application class.

    Inheritances :
    ---
        :attribute:`Tk` : The tkinter main class
        :attribute:`AppInterface` : The interface of the app
    """
    instance: "App" = None
    language = "EN"
    current_page: Page = None
    theme = "dark"
    themes = []

    def __init__(self):
        """ # Constructor
        @constructor
        
        Description :
        ---
            This function will initialize
        """
        super().__init__()
        self.title("TITLE")
        self.geometry("1000x600")
    
    #region Private functions ==================================================
    def __menus(self) -> None:
        """ # Create the menus
        @private
        
        Description :
        ---
            This function will create the menus of the app.

        Returns :
        ---
            :rtype: None
        """
        # Create the menu
        self.menu = Menu(self)
        self.config(menu=self.menu)
        
        # Get the menus
        self.menu.add_cascade(label="File", menu=FileMenu.get_instance(self).setup())
        self.menu.add_cascade(label="Language", menu=LangsMenu.get_instance(self).setup())
        self.menu.add_cascade(label="Themes", menu=ThemesMenu.get_instance(self).setup())

    def __themes(self) -> None:
        """ # Set the theme
        @private
        
        Description :
        ---
            This function will set the theme of the app.

        Returns :
        ---
            :rtype: None
        """
        path = "src/data/themes"
        style = ttk.Style()
        
        # Set the themes
        for file in os.listdir(path):
            if file.endswith(".json"):
                theme = load_data(f"{path}/{file}")
                self.themes.append(theme)
                style.theme_create(theme.get("name"), parent=theme.get("parent"), settings=theme.get("settings"))

        # Set the theme
        self.update_theme()
    #endregion ______________________________________________________________
    
    #region Public functions ===================================================   
    def setup(self) -> None:
        """ # Setup the app
        @public
        
        Description :
        ---
            This function will setup the app.
            
        Returns :
        ---
            :rtype: None
        """
        self.__themes()        
        self.__menus()

    def update_theme(self) -> None: 
        """ # Update the theme
        @public
        
        Description :
        ---
            This function will update the theme of the app.
            
        Returns :
        ---
            :rtype: None
        """
        style = ttk.Style()
        style.theme_use(self.theme)

    def change_language(self, lang: Langs) -> None:
        """ # Change the language
        @public
        
        Description :
        ---
            This function will change the language of the app.
            
        Parameters :
        ---
            :param Langs lang: The language to change to
            
        Returns :
        ---
            :rtype: None
        """
        # Change the language
        self.language = lang.value.upper()
        self.display(self.current_page)

    def display(self, page: Page) -> None:
        """ # Display a page
        @public
        
        Description :
        ---
            This function will display a page.
            
        Parameters :
        ---
            :param Page page: The page to display
            
        Returns :
        ---
            :rtype: None
        """
        # Clearing the current page
        if self.current_page:
            self.current_page.clear(page is not self.current_page)

        # Display the new page
        if page:
            self.current_page = page

        # Display the page
        self.current_page.display()

    # -> Routes --------------------------------------------------------------
    @route("home")
    def home(self) -> None:
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
        page = Home.get_instance(self)
        self.display(page)

    @route("receipes")
    def receipes(self) -> None:
        """ # Display the receipes page
        @public
        
        Description :
        ---
            This function will display the receipes page.

        Returns :
        ---
            :rtype: None
        """
        # Display the receipes page
        page = Receipes.get_instance(self)
        self.display(page)
    #endregion ______________________________________________________________

    #region Static functions ===================================================
    @staticmethod
    def get_instance() -> "App":
        """ # Get the instance of the app
        @staticmethod
        
        Description :
        ---
            This function will return the instance of the app.
            
        Returns :
        ---
            :rtype: App
            :return: The instance of the app
        """
        if not App.instance:
            App.instance = App()
        return App.instance
    #endregion _________________________________________________________________