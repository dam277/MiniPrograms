import pyautogui
import sys
import time
from Mouse import Mouse

def main():
    x, y = pyautogui.position()
    mouse = Mouse(x, y)
    while True:
        x, y = pyautogui.position()
        mouse.set_position(x, y)
        time.sleep(0.1)  # Adjust the sleep time as needed
        mouse.check_if_moving()

if __name__ == "__main__":
    main()