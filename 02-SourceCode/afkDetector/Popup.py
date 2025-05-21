import tkinter as tk
import threading
import time

class Popup:
    instance = None
    thread: threading.Thread = None

    def __new__(cls):
        if cls.instance is None:
            cls.instance = super(Popup, cls).__new__(cls)
        return cls.instance

    def __init__(self):
        self.root = None

    def run_popup(self, message: str):
        self.root = tk.Tk()
        self.root.overrideredirect(True)
        self.root.configure(bg='black')
        self.root.attributes('-topmost', True)
        self.root.attributes('-alpha', 0.0)

        width, height = 300, 100
        screen_width = self.root.winfo_screenwidth()
        screen_height = self.root.winfo_screenheight()
        x = screen_width - width - 30
        y = screen_height - height - 60
        self.root.geometry(f"{width}x{height}+{x}+{y}")

        label = tk.Label(self.root, text=message, font=("Helvetica", 11), fg="white", bg="black", wraplength=280)
        label.pack(expand=True, fill="both", padx=20, pady=20)

        # Fade-in
        for i in range(0, 11):
            self.root.attributes('-alpha', i / 10)
            time.sleep(0.03)

        self.root.mainloop()

    def hide_popup(self):
        if self.root:
            # Fade-out
            for i in reversed(range(0, 11)):
                self.root.attributes('-alpha', i / 10)
                time.sleep(0.03)
            self.root.quit()
            self.root = None

    def is_alive(self) -> bool:
        """Check if the popup is alive."""
        return self.root is not None and self.root.winfo_exists()

# === Test ===
if __name__ == "__main__":
    popup = Popup()
    threading.Thread(target=popup.run_popup, args=("The mouse is moving.",)).start()
    time.sleep(5)
    popup.hide_popup()
