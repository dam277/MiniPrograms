from tkinter import *
from tkinter import ttk

from ..utils.langs import get_translations, Langs
from ..utils.data_interactions import load_data
from ..utils.decorators import call_route
from .Page import Page
from ..interfaces.AppInterface import AppInterface

class Receipes(Page):
    """ # Receipes page class
    @class
    
    Description :
    ---
        This class will be the Receipes page of the app.
        
    Inheritances :
    ---
        :attribute:`Page` : The page class
    """
    instance: "Receipes" = None

    def __init__(self, app: AppInterface):
        """ # Constructor
        @constructor
        
        Description :
        ---
            This function will initialize the Receipes page.
            
        Parameters :
        ---
            `AppInterface`:app: The app instance
        """
        super().__init__(app)

    #region Private methods ========================================================
    # -> Events -------------------------------------------------------------------
    def __item_selected(self, event) -> None:
        print(self.tree.item(self.tree.selection()))
        # print(self.selected_item)
        # # delete the selected item
        # self.tree.delete(self.tree.selection())

    def __on_double_click(self, event) -> None:
        print("Double click")
    #endregion ______________________________________________________________________

    #region Public methods ========================================================
    def display_test(self) -> None:
        """ # Display the Receipes page
        @public
        
        Description :
        ---
            This function will display the Receipes page.
    
        Returns :
        ---
            :rtype: None
        """
        # Display the Receipes page
        translations = get_translations(Langs[self.app.language])

        # Create widgets
        receipes: list[dict] = load_data("src/data/receipes.json")
        entry = ttk.Frame(self)
        entry.pack()

        widgets = []
        for receipe in receipes:
            border = {"widget": ttk.Frame(self, style="Receipe.Border.TFrame"), "pack": {"expand": False, "fill": "x", "side": "top"}}
            frame = {"widget": ttk.Frame(border.get("widget"), style="Receipe.TFrame"), "pack": {"expand": False, "fill": "x", "pady": 1}}
            lbl_name = {"widget": ttk.Label(frame.get("widget"), text=receipe.get("name"), style="Receipe.Title.TLabel"), "pack": {}}
            lbl_description = {"widget": ttk.Label(frame.get("widget"), text=f"Description : {receipe.get("description")}", style="Receipe.TLabel"), "pack": {}}

            widgets.extend([border, frame, lbl_name, lbl_description])
            
        self._display(widgets)

    def display(self) -> None:
        translations = get_translations(Langs[self.app.language])

        # Create a frame to hold the treeview and scrollbar
        frame = ttk.Frame(self)
        frame.pack(fill="both", expand=True)

        # Create a treeview with a vertical scrollbar
        self.tree = ttk.Treeview(frame, columns=("name", "description"), style="Receipes.Treeview", show="headings")
        scrollbar = ttk.Scrollbar(frame, orient="vertical", command=self.tree.yview)
        self.tree.configure(yscrollcommand=scrollbar.set)

        # Define the columns
        self.tree.heading("name", text="Name", anchor="w")
        self.tree.heading("description", text="Description", anchor="w")

        # Load the data and insert into the treeview
        receipes: list[dict] = load_data("src/data/receipes.json")
        for receipe in receipes:
            self.tree.insert("", "end", values=(receipe.get("name"), receipe.get("description")))

        # Bind the event
        self.tree.bind("<<TreeviewSelect>>", lambda event: self.__item_selected(event))
        self.tree.bind("<Double-1>", lambda event: self.__on_double_click(event))

        # Display the widgets
        widgets = [{ "widget": self.tree, "pack": {"side": "left", "fill": "both", "expand": True} }, { "widget": scrollbar, "pack": {"side": "right", "fill": "y"} }]
        self._display(widgets)
    #endregion ______________________________________________________________________

    #region Static methods ========================================================
    @staticmethod
    def get_instance(app: AppInterface) -> "Receipes":
        """ # Get the instance of the Receipes page
        @staticmethod
        
        Description :
        ---
            This function will return the instance of the Receipes page.
            
        Parameters :
        ---
            `AppInterface`:app: The app instance
            
        Returns :
        ---
            :rtype: Receipes
            :return: The instance of the Receipes page
        """
        if not Receipes.instance or not Receipes.instance._is_alive():
            Receipes.instance = Receipes(app)
        return Receipes.instance
    #endregion ______________________________________________________________________
    
