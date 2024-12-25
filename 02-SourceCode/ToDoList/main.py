from tasks import tasks, add_task, modify_task, delete_task, get_task_by_name, get_tasks_by_date, display_tasks
from colorama import Fore
import os

def main():
    # Make a loop that can be broken by the user
    leave = False
    while not leave:
        # Ask the user for input
        print(Fore.BLUE)
        print("-" * 10 + "CRUD" + "-" * 10)
        print("1. Add a new task")
        print("2. Modify a task")
        print("3. Delete a task")
        print("-" * 10 + "Search" + "-" * 10)
        print("4. Show all tasks")
        print("5. Search a task")
        print("-" * 10 + "Display" + "-" * 10)
        print("6. Show calendar")
        print("-" * 25)
        print("Type 'exit' to leave")

        user_input = input("Choice: ")
        
        match user_input:
            case "1":
                print(Fore.CYAN)
                print("Adding a new task")

                name = input("Name: ")
                description = input("Description: ")
                date = input("Date (YYYY-MM-DD): ")
                print(add_task(name, description, date))
            case "2":
                print(Fore.CYAN)
                print("Modifying a task")

                name = input("Name: ")
                description = input("Description: ")
                date = input("Date (YYYY-MM-DD): ")
                print(modify_task(name, description, date))
            case "3":
                print(Fore.CYAN)
                print("Deleting a task")

                name = input("Name: ")
                print(delete_task(name))
            case "4":
                print("Showing all tasks")
            case "5":
                print("Searching a task")
            case "6":
                print("Showing calendar")
            case "exit":
                print("Exiting")
                leave = True
            case _:
                print("Invalid choice")

        # Clear the text in the console
        os.system('cls' if os.name == 'nt' else 'clear')

if __name__ == '__main__':
    print("Welcome to the task manager")
    print(Fore.RESET)
    main()
    print(Fore.RESET)