from tkinter import Menu
from ..interfaces.AppInterface import AppInterface

class ThemesMenu(Menu):
    """ # Language menu
    @class
    
    Description :
    ---
        This class will be the
        
    Inheritances :
    ---
        :attribute:`Menu` : The tkinter menu class
    """
    instance: "ThemesMenu" = None

    def __init__(self, app: AppInterface):
        """ # Constructor
        @constructor
        
        Description :
        ---
            This function will initialize the language menu.
            
        Parameters :
        ---
            `AppInterface`:app: The app interface
        
        Returns :
        ---
            :rtype: None
        """
        super().__init__(app, tearoff=0)
        self.app = app

    #region Private functions ==================================================
    # -> Events -------------------------------------------------------------------
    def __change_theme(self, theme: str) -> None:
        """ # Change the theme
        @private
        
        Description :
        ---
            This function will change the theme.
            
        Parameters :
        ---
            `str`:theme: The theme to change
        """
        self.app.theme = theme
        self.app.update_theme()
    #endregion ________________________________________________________________

    #region Public functions ===================================================
    def setup(self) -> "ThemesMenu":
        """ # Setup the menu 
        @public

        Description :
        ---
            This function will setup the menu.

        Returns :
        ---
            :rtype: ThemesMenu
        """
        # Add the themes
        for theme in self.app.themes:
            self.add_command(label=theme.get("name"), command=lambda name=theme.get("name"): self.__change_theme(name))
        return self
    #endregion ________________________________________________________________

    #region Static methods ======================================================
    @staticmethod
    def get_instance(app: AppInterface) -> "ThemesMenu":
        """ # Get the instance
        @static
        
        Description :
        ---
            This function will get the instance of the menu.
            
        Parameters :
        ---
            `AppInterface`:app: The app interface
            
        Returns :
        ---
            :rtype: ThemesMenu
        """
        if not ThemesMenu.instance or not ThemesMenu.instance.winfo_exists():
            ThemesMenu.instance = ThemesMenu(app)
        return ThemesMenu.instance
    #endregion ________________________________________________________________