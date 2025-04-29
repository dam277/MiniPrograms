from tkinter import Tk
from ..utils.langs import Langs
from tkinter import Menu

from abc import ABC, abstractmethod

class AppInterface(ABC):
    """ # App interface
    @interface
    
    Description :
    ---
        This interface will be used to define the main application class.

    Inheritances :
    ---
        :attribute:`ABC` : Define the class as an abstract class
    """
    language: str
    current_page: object
    menu: Menu
    theme: str
    themes: list[dict]

    def __init__(self):
        pass
    
    #region Abstract functions =================================================
    @abstractmethod
    def setup(self) -> None:
        pass

    @abstractmethod
    def update_theme(self) -> None:
        pass
    
    @abstractmethod
    def change_language(self, language: Langs) -> None:
        pass

    # -> Pages -------------------------------------------------------------------
    @abstractmethod
    def home(self):
        pass
    #endregion ______________________________________________________________

