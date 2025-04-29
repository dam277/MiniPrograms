from tkinter import Menu
from ..interfaces.AppInterface import AppInterface
from ..utils.langs import Langs

class LangsMenu(Menu):
    """ # Language menu
    @class
    
    Description :
    ---
        This class will be the
        
    Inheritances :
    ---
        :attribute:`Menu` : The tkinter menu class
    """
    instance: "LangsMenu" = None

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
    def __change_language(self, lang: Langs) -> None:
        """ # Change the language
        @private
        
        Description :
        ---
            This function will change the language of the app.
            
        Parameters :
        ---
            `Langs`:lang: The language to change
        
        Returns :
        ---
            :rtype: None
        """
        self.app.change_language(lang)
    #endregion ________________________________________________________________

    #region Public functions ===================================================
    def setup(self) -> "LangsMenu":
        """ # Setup the language menu
        @public
        
        Description :
        ---
            This function will setup the language menu.
            
        Returns :
        ---
            :rtype: LangsMenu
        """
        # Add the languages
        for language in Langs:
            self.add_command(label=language.name, command=lambda lang=language: self.__change_language(lang))
        return self
    #endregion ________________________________________________________________

    #region Static methods ======================================================
    @staticmethod
    def get_instance(app: AppInterface) -> "LangsMenu":
        if not LangsMenu.instance or not LangsMenu.instance.winfo_exists():
            LangsMenu.instance = LangsMenu(app)
        return LangsMenu.instance
    #endregion ________________________________________________________________