from src.App import App
from src.utils.decorators import call_route

if __name__ == "__main__":
    app = App.get_instance()
    app.setup()
    call_route("home", app)
    app.mainloop()