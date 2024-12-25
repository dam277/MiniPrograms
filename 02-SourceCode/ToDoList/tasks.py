from colorama import Fore

tasks: dict[str, dict] = {} # Name, description, date, done

# --- CRUD functions ---
def add_task(name: str, description: str, date: str, done: bool = False) -> str:
    if not name in tasks:
        tasks[name] = { "description": description, "date": date, "done": done }
        return "Task added"
    
    return "Task already exists"
        
def modify_task(name: str, description: str, date: str, done: bool = False) -> str:
    if name in tasks:
        tasks[name] = { "description": description, "date": date, "done": done }
        return "Task modified"
    
    return "Task does not exist"

def delete_task(name: str) -> str:
    if name in tasks:
        del tasks[name]
        return "Task deleted"
    
    return "Task does not exist"

# --- Search functions ---
def get_task_by_name(name: str) -> dict:
    if name in tasks:
        return tasks.get(name)
    
    return {}

def get_tasks_by_date(date: str) -> dict:
    return {name: task for name, task in tasks.items() if task.get('date') == date}

# --- Display functions ---
def display_tasks(tasks: dict) -> None:
    if len(tasks) > 0:
        for name, task in tasks.items():
            print(Fore.GREEN if task.get('done') else Fore.RED)
            print(f"{'-'*10} {name} {'-'*10}")
            print(f"Description: {task.get('description')}")
            print(f"Date: {task.get('date')} {Fore.RESET}")

    else:
        print("No tasks found")

# print(add_task("Task 1", "Description 1", "2021-01-01"))
# print(add_task("Task 2", "Description 2", "2021-01-01", True))
# print(add_task("Task 3", "Description 3", "2021-01-02", True))
# print(get_tasks_by_date("2021-01-02"))
# display_tasks(tasks)
    