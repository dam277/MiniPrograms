from tkinter import Label, Tk, ttk, Button
from colorama import Fore

class App:
    def __init__(self, title, width, height):
        self.window = Tk()
        self.title = title
        self.width = width
        self.height = height

    def set_window(self) -> Tk:
        self.window.title(self.title)
        self.window.geometry(f"{self.width}x{self.height}")
        self.window.configure(bg='black')

    def display(self):
        self.window.mainloop()

    def display_treeview(self, data: list, columns: list, title: str):
        # Configure the style for Treeview
        style = ttk.Style()
        style.theme_use("default")
        style.configure("Treeview", background="black", foreground="white", fieldbackground="black")
        style.configure("Treeview.Heading", background="black", foreground="white",font=('Arial', 10, 'bold'))
        style.map("Treeview.Heading", background=[('active', 'black')], foreground=[('active', 'white')])
        style.map("Treeview", background=[('selected', 'grey')], foreground=[('selected', 'white')])

        # add delete column
        columns.append('Delete')

        Label(self.window, text=title, bg='black', fg='white').pack()

        tree = ttk.Treeview(self.window, columns=columns, show='headings', style="Treeview")
        tree.pack(fill='x')

        for col in columns:
            tree.heading(col, text=col)

        for item in data:
            values = [value for value in item.values()]
            values.append("Delete")
            tree.insert('', 'end', values=values)

        # Add delete button to each row
        for child in tree.get_children():
            tree.item(child, tags=('row',))
            print("l'enfant", child)
            
            tree.tag_bind('row', '<Button-1>', lambda event, item=child: print("selection", tree.selection(), "item:", item))

        return tree
    
    def sort_treeview(self, tree, col, reverse):
        data = [(tree.set(child, col), child) for child in tree.get_children('')]
        data.sort(reverse=reverse, key=lambda x: (float(x[0]) if x[0].isdigit() else x[0]))

        for index, (val, child) in enumerate(data):
            tree.move(child, '', index)

        tree.heading(col, command=lambda: self.sort_treeview(tree, col, not reverse))
    