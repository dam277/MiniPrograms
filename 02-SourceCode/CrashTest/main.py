from notes.Module import Module
from notes.Test import Test
from datetime import date
from colorama import Fore, Style

def print_title(text: str):
    print(f"{Style.BRIGHT}{Fore.MAGENTA}{text}")
    print("-" * len(text))

def print_colored(text: str, color: str = Fore.WHITE, end: str = "\n"):
    print(f"{Style.NORMAL}{color}{text}{Style.RESET_ALL}", end=end)

def print_grade(grade: float):
    if grade < 4.0:
        print_colored(f"{grade:.2f}", Fore.RED)
    elif grade < 5.0:
        print_colored(f"{grade:.2f}", Fore.YELLOW)
    else:
        print_colored(f"{grade:.2f}", Fore.GREEN)

def main():
    module = Module("BRIT2")

    module.add_test(Test("Math TE1", date(2025, 3, 5)).set_grade(4.5))
    module.add_test(Test("Math TE2", date(2025, 4, 9)).set_grade(4.0))
    module.add_test(Test("Math TE3", date(2025, 5, 22)))
    module.add_test(Test("Math TE4", date(2025, 6, 24)))

    module.add_test(Test("Comm TE1", date(2025, 3, 12)).set_grade(6.0))
    module.add_test(Test("Comm TE2", date(2025, 6, 11)))
    module.add_test(Test("Comm TE3", date(2025, 6, 11)))

    module.add_test(Test("Angl TE1", date(2025, 2, 24)).set_grade(4.0))
    module.add_test(Test("Angl TE2", date(2025, 3, 28)).set_grade(4.0))
    module.add_test(Test("Angl TE3", date(2025, 6, 2)))

    # Print the current average
    print_title(f"Module: {module.name}")
    print_average(module)

    # Get the needed points to reach the target average
    needed_points = module.calculate_missing_points()
    print_colored(f"Needed points : {needed_points:.2f}", Fore.CYAN)

    print_separator()

    # Get the minimal grades needed to reach the target average
    (base, minimal) = module.get_minimal_grades_to_reach_missing_points()
    grades = base + minimal

    # Print the minimal grades
    print_minimal_grades(module, grades, base)

    # Print the average with the generated grades
    print_average(module, grades)

def print_separator():
    print("-" * 25)

def print_minimal_grades(module: Module, grades: list[float], base: list[float]):
    for i, grade in enumerate(grades):
        if i < len(base):
            print_colored(f"Grade (base) {i + 1}: ", Fore.LIGHTBLACK_EX, end="")
        else:
            print_colored(f"Grade (mini) {i + 1}: ", Fore.LIGHTBLUE_EX, end="")
        
        print_grade(grade)

    print_separator()

def print_average(module: Module, grades: list[Test] = None):
    average = module.calculate_average_grade(grades)
    if average is not None:
        print_colored(f"Average : ", Fore.WHITE, end="",)
        print_grade(average)
    else:
        print_colored(f"No grades available for the module.", Fore.RED)
    
    print_separator()

if __name__ == "__main__":
    main()