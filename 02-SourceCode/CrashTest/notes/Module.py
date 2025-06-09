from notes.Test import Test

class Module:
    _valid_grades = [1, 1.5, 2, 2.5, 3, 3.5, 4, 4.5, 5, 5.5, 6]

    def __init__(self, name: str, description: str = None):
        self.name: str = name
        self.description: str = description
        self.tests: list[Test] = []

    def add_test(self, test: Test):
        self.tests.append(test)

    def get_tests(self, has_grade: bool = True) -> list[Test]:
        if has_grade:
            return [test for test in self.tests if test.grade is not None]
        else:
            return [test for test in self.tests if test.grade is None]
    
    def calculate_average_grade(self, grades: list[float] = None) -> float | None:
        if not self.tests:
            return None
        
        total = sum(test.grade for test in self.tests if test.grade is not None) if grades is None else sum(grades)
        count = sum(1 for test in self.tests if test.grade is not None) if grades is None else len(grades)
        return total / count if count > 0 else None
    
    def calculate_missing_points(self, target_average: float = 4.0, _tests_without_grades: list[Test] = None) -> float | None:
        tests_with_grades = self.get_tests()
        tests_without_grades = self.get_tests(has_grade=False) if _tests_without_grades is None else _tests_without_grades

        total_points = sum(test.grade for test in tests_with_grades)
        total_tests = len(tests_with_grades) + len(tests_without_grades)

        target_average_needed_points = target_average * total_tests
        needed_points = target_average_needed_points - total_points

        return needed_points
    
    def get_minimal_grades_to_reach_missing_points(self, target_average: float = 4.0) -> tuple[list[float], list[float]] | None:
        # Getting the tests
        tests_without_grades = self.get_tests(has_grade=False)
        tests_with_grades = self.get_tests()

        # Get the total tewsts and the minimum grades needed with a 4.0
        total_tests = len(tests_with_grades) + len(tests_without_grades)
        minimum_grades_to_reach_four = total_tests / 2 + 1
        
        # Set the obliged grades
        obliged_grades: list[Test] = []
        while len(tests_with_grades) + len(obliged_grades) < minimum_grades_to_reach_four:
            obliged_grades.append(tests_without_grades.pop().set_grade(4.0))

        # Calculate the needed points
        needed_points = self.calculate_missing_points(target_average, tests_without_grades) 
        num_tests_without_grades = len(tests_without_grades)

        # Calaculate the minimal grades
        minimal_grade = needed_points / num_tests_without_grades
        minimal_grades = [max(minimal_grade, min(self._valid_grades))] * num_tests_without_grades

        # Get the base grades
        base_grades = [test.grade for test in tests_with_grades]
        minimal_grades.extend([test.grade for test in obliged_grades])

        return (base_grades, minimal_grades)

        