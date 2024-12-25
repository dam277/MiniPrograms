from colorama import Fore
import os

from src.menu import menu, get_data, execute_command
from src.commands.Command import Command
from src.utils.Logger import Logger

def main() -> None:
    """ # Main function
    
    Description :
    ---
        The main function of the application. It will show the menu and execute the command chosen by the user.
    
    Arguments :
    ---
        None
    
    Returns :
    ---
        None
    """  
    # Get the data
    app_values = get_data()

    leave = False
    while not leave:
        try:
            # Show the menu
            choice, option = menu(app_values)

            # Check if the user wants to exit
            if choice == "Exit":
                Logger.get_instance().default("Exiting the application...", True)
                leave = True
                continue
            elif choice == "Back":
                continue

            # Get the command
            command = Command.get_command(option)

            # Execute the command
            print(Fore.CYAN, "-"*20, f"{option} {choice}", "-"*20, Fore.RESET)
            execute_command(command, choice)
            input("Press enter to continue...")

            # Clear the screen
            os.system("cls")
        except Exception as e:
            Logger.get_instance().error(f"An error occurred: {str(e)}", True)

if __name__ == "__main__":
    print(Fore.RESET)
    main()
    print(Fore.RESET)