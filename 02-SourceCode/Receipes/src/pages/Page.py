from tkinter import ttk
from abc import ABC, abstractmethod

from ..interfaces.AppInterface import AppInterface

class Page(ttk.Frame, ABC):
    """ # Page class
    @class
    
    Description :
    ---
        This class will be the
        
    Inheritances :
    ---
        :attribute:`Frame` : The tkinter frame class
        :attribute:`ABC` : The abstract class
    """
    def __init__(self, app: AppInterface):
        """ # Constructor
        @constructor
        
        Description :
        ---
            This function will initialize the page.
            
        Parameters :
        ---
            `AppInterface`:app: The app instance
        """
        super().__init__(app, style="TFrame")
        self.app = app
    
    #region Protected methods ========================================================
    def _display(self, widgets: list[dict]) -> None:
        """ # Display the widgets
        @protected
        
        Description :
        ---
            This function will display the widgets.
            
        Parameters :
        ---
            `list`:widgets: The list of widgets to display
        """
        for widget in widgets:
            widget.get("widget").pack(widget.get("pack"))

        self.pack(expand=True, fill="both")

    def _is_alive(self) -> bool:
        """ # Check if the page is alive 
        @protected

        Description :
        ---
            This function will check if the page is alive.

        Returns :
        ---
            `bool`: The result of the check
        """
        return self.winfo_exists()
    
    # -> Events -------------------------------------------------------------------
    def _event(self) -> None:
        """ # Event
        @protected
        
        Description :
        ---
            This function will be the event of the page.
        """
        pass
    #endregion ________________________________________________________________________
    
    #region Public methods ===========================================================
    def clear(self, destroy: bool = True) -> None:
        """ # Clear the page
        @public
        
        Description :
        ---
            This function will clear the page.
            
        Parameters :
        ---
            `bool`:destroy: Destroy the page

        Returns :
        ---
            `None`
        """
        # Check if the page need to be destroyed (If the new page is different than the current page) 
        if destroy:
            self.destroy()
        else:
            for widget in self.winfo_children():
                widget.destroy()
    #endregion ________________________________________________________________________
    
    #region Abstract methods =========================================================
    @abstractmethod
    def display(self) -> None:
        """ # Display the page
        @abstract
        
        Description :
        ---
            This function will display the page.
        """
        pass
    #endregion ________________________________________________________________________