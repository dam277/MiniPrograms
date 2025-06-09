from datetime import date

class Test:
    def __init__(self, name: str, date: date, same_grade_as: str = None):
        self.name = name
        self.date = date
        self.grade = None
        self.same_grade_as = same_grade_as

    def set_grade(self, grade: float):
        if grade in [1, 1.5, 2, 2.5, 3, 3.5, 4, 4.5, 5, 5.5, 6]:
            self.grade = grade
            return self
        else:
            raise ValueError("Grade must be between 0 and 6")
        
    