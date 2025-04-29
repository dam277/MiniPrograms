import json
import os
from colorama import Fore

# File to store absences data
DATA_FILE = "./absences.json"

# Load data from JSON file
def load_data():
    if os.path.exists(DATA_FILE):
        with open(DATA_FILE, "r") as file:
            return json.load(file)
    return {"modules": {}, "absences": []}

# Save data to JSON file
def save_data(data):
    with open(DATA_FILE, "w") as file:
        json.dump(data, file, indent=4)

# Calculate absence percentage for each module
def calculate_absence_percentage(data):
    percentages = {}
    for module, max_periods in data["modules"].items():
        total_absences = sum(
            absence.get(module, 0) for absence in data["absences"]
        )
        percentages[module] = (total_absences / max_periods) * 100 if max_periods > 0 else 0
    return percentages

# Add a new absence
def add_absence(data):
    print("\nAdd a new absence:")
    absence = {}
    for module in data["modules"]:
        try:
            periods = int(input(f"Enter the number of periods absent for {module}: "))
            if periods > 0:
                absence[module] = periods
        except ValueError:
            print("Invalid input. Please enter a number.")
    if absence:
        data["absences"].append(absence)
        print("Absence added successfully!")
    else:
        print("No absence recorded.")

# Main program
def main():
    data = load_data()

    # Initialize modules if not already present
    if not data["modules"]:
        print("No modules found. Let's set them up.")
        while True:
            module_name = input("Enter module name (or press Enter to finish): ").strip()
            if not module_name:
                break
            try:
                max_periods = int(input(f"Enter the maximum number of periods for {module_name}: "))
                data["modules"][module_name] = max_periods
            except ValueError:
                print("Invalid input. Please enter a number.")

    while True:
        print("\nMenu:")
        print("1. View absence percentages")
        print("2. Add an absence")
        print("3. Exit")
        choice = input("Enter your choice: ").strip()

        if choice == "1":
            percentages = calculate_absence_percentage(data)
            print("\nAbsence Percentages:")
            for module, max_periods in data["modules"].items():
                total_absences = sum(
                    absence.get(module, 0) for absence in data["absences"]
                )
                percentage = percentages[module]
                if percentage < 9:
                    print(Fore.GREEN + f"{module}: {total_absences} / {max_periods} = {percentage:.1f}%" + Fore.RESET)
                elif percentage > 10:
                    print(Fore.RED + f"{module}: {total_absences} / {max_periods} = {percentage:.1f}%" + Fore.RESET)
                else:
                    print(Fore.YELLOW + f"{module}: {total_absences} / {max_periods} = {percentage:.1f}%" + Fore.RESET)
        elif choice == "2":
            add_absence(data)
        elif choice == "3":
            save_data(data)
            print("Data saved. Goodbye!")
            break
        else:
            print("Invalid choice. Please try again.")

if __name__ == "__main__":
    main()