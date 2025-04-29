from tkinter import Menu, Tk
from ..interfaces.AppInterface import AppInterface

class FileMenu(Menu):
    """ # File menu
    @class
    
    Description :
    ---
        This class will be the
        
    Inheritances :
    ---
        :attribute:`Menu` : The tkinter menu class
    """
    instance: "FileMenu" = None

    def __init__(self, app: AppInterface|Tk):
        """ # Constructor
        @constructor
        
        Description :
        ---
            This function will initialize the file menu.
            
        Parameters :
        ---
            `AppInterface|Tk`:app: The app interface
            
        Returns :
        ---
            :rtype: None
        """
        super().__init__(app, tearoff=0)
        self.app = app

    #region Private functions ==================================================
    #endregion ________________________________________________________________

    #region Public functions ===================================================
    def setup(self) -> "FileMenu":
        """ # Setup the file menu
        @public
        
        Description :
        ---
            This function will setup the file menu.
            
        Returns :
        ---
            :rtype: FileMenu
        """
        self.add_command(label="delete")
        self.add_command(label="2")
        self.add_command(label="3")
        self.add_separator()
        self.add_command(label="Exit", command=self.app.quit)
        return self
    #endregion ________________________________________________________________
    
    #region Static functions ===================================================
    @staticmethod
    def get_instance(app: AppInterface) -> "FileMenu":
        """ # Get the instance
        @static
        
        Description :
        ---
            This function will return the instance of the file menu.
            
        Parameters :
        ---
            `AppInterface`:app: The app interface
            
        Returns :
        ---
            :rtype: FileMenu
        """
        if not FileMenu.instance or not FileMenu.instance.winfo_exists():
            FileMenu.instance = FileMenu(app)
        return FileMenu.instance
    #endregion ________________________________________________________________


        
