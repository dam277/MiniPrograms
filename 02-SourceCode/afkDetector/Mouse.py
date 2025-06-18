import sys
from Console import Console
import pyautogui
from Popup import Popup
import time
import threading

class Mouse:
    def __init__(self, x: int, y: int):
        self.x = x
        self.y = y
        self.is_moving = False
        threading.Thread(target=self.display_popup, args=("The mouse is moving.",)).start()

    def set_position(self, x: int, y: int):
        self.x = x
        self.y = y

    def check_if_moving(self) -> bool: 
        """Checks if the mouse is moving and returns a boolean."""
        current_x, current_y = pyautogui.position()
        self.is_moving = (self.x != current_x) or (self.y != current_y)

        # Display the mouse position in the console
        Console.print_message(f"Mouse position: ({self.x}, {self.y})" + (" (Moving)" if self.is_moving else ""))
        return self.is_moving
    
    def display_popup(self, message: str): 
        print("Popup displayed.")  
        popup = Popup()
        thread = threading.Thread(target=popup.run_popup, args=(message,))
        print (thread.is_alive())
        
        while True:  
            print("Checking if popup is alive...")
            if self.is_moving and not popup.is_alive() and not thread.is_alive():
                thread.start()
            else:
                time.sleep(5)
                thread = threading.Thread(target=popup.run_popup, args=(message,))
                popup.hide_popup()

            time.sleep(0.1)  # Adjust the sleep time as needed