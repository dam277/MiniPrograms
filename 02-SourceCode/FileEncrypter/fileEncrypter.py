from PIL import Image
from cryptography.fernet import Fernet
import io
import os
import tkinter as tk
from tkinter import filedialog
from dotenv import load_dotenv

# ---------------------------- Key -------------------------------  
# Load environment variables from .env file
load_dotenv('.env')
KEY = os.getenv('KEY')

# ---------------------------- Encryption -------------------------
def image_to_bytes(input_path: str):
    with Image.open(input_path) as img:
        img_byte_arr = io.BytesIO()
        img.save(img_byte_arr, format=img.format)
        return img_byte_arr.getvalue()

def bytes_to_image(image_bytes, output_path: str):
    img_byte_arr = io.BytesIO(image_bytes)
    img = Image.open(img_byte_arr)
    img.save(output_path)

def encrypt_image(input_path: str, output_path: str, output_file: str):
    # Set the output path
    output = os.path.join(output_path, output_file)

    # Encrypt the image
    cipher = Fernet(KEY)
    image_bytes = image_to_bytes(input_path)
    encrypted_bytes = cipher.encrypt(image_bytes)
    
    # Save the encrypted bytes to a file and create folder if needed
    create_folders(output)
    with open(output, 'wb') as f:
        f.write(encrypted_bytes)

    # Delete the input file
    delete_input_file(input_path)

def decrypt_image(encrypted_path: str, output_path: str|None, output_file: str):
    # Decrypt the image
    cipher = Fernet(KEY)
    with open(encrypted_path, 'rb') as f:
        encrypted_bytes = f.read()
    decrypted_bytes = cipher.decrypt(encrypted_bytes)
    
    # Save the decrypted bytes to a file or display the image in the screen based on the output path
    if output_path is not None:
        # Set the output path
        output = os.path.join(output_path, output_file)

        # Save the encrypted bytes to a file and create folder if needed
        create_folders(output)
        bytes_to_image(decrypted_bytes, output)
    else:
        # Display the image in the screen
        img_byte_arr = io.BytesIO(decrypted_bytes)
        img = Image.open(img_byte_arr)
        img.show()

# ---------------------------- Utils ------------------------------
def get_file_infos(file_path):
    # Get the file name and extension
    file_name = os.path.basename(file_path).split(".")[0]
    file_ext = os.path.basename(file_path).split(".")[1]
    return file_name, file_ext

def create_folders(output_path: str):
    # Create the folder if needed
    if not os.path.exists(os.path.dirname(output_path)):
        os.makedirs(os.path.dirname(output_path))

def delete_input_file(input_path: str):
    # Delete the input file
    os.remove(input_path)

def is_encrypted(file_path: str):
    # Check if the file is encrypted : *.*.dec
    return file_path.endswith(".dec")
    
# ---------------------------- Selects ----------------------------
def select_mode():
    # Ask the user to select the mode
    print("Select the mode:")
    print("1. Encrypt")
    print("2. Decrypt")
    return input("Enter mode (1 or 2): ")

def select_output_path():
    # Ask the user to select the output path
    return filedialog.askdirectory(initialdir="D:/Images")

def select_option():
    # Ask the user if he wants to save or see the images in the screen
    print("Do you want to save the decrypted image or see it in the screen?")
    print("1. Save")
    print("2. See")
    return input("Enter option (1 or 2): ")

def select_files():
    # Ask the user to select the images to encrypt or decrypt
    root = tk.Tk()
    root.withdraw()
    file_paths = filedialog.askopenfilenames(filetypes=[("all", "*.*"), ("PNG files", "*.png"), ("JPEG files", "*.jpg"), ("Encrypted files", "*.dec")], initialdir="D:/Images")
    if not file_paths:
        print("No file selected.")
        exit()
    return file_paths

# ---------------------------- Main -------------------------------
def main():
    # Select the mode
    mode = select_mode()

    # Set the input paths and output path
    input_paths = select_files()
    output_path: str|None = None

    # Encrypt or decrypt the images based on the mode selected
    if mode == "1":
        # Ask the user to select the output path
        output_path = select_output_path()

        # Encrypt the images
        for input_path in input_paths:
            # Get the file name and extension
            file_name, file_ext = get_file_infos(input_path)
            if not is_encrypted(input_path):
                encrypt_image(input_path, output_path, f"{file_name}.{file_ext}.dec")
            else:
                print(f"The file {file_name}.{file_ext} is already encrypted.")
    elif mode == "2":
        # Ask for the option to save or see the image to the user
        option = select_option()
        if option == "1":
            # Ask the user to select the output path
            output_path = select_output_path()

        for input_path in input_paths:
            # Get the file name and extension
            file_name, file_ext = get_file_infos(input_path)

            # Check if the file is encrypted
            if is_encrypted(input_path):
                decrypt_image(input_path, output_path, f"{file_name}.{file_ext}")
            else:
                print(f"The file {file_name}.{file_ext} is not encrypted.")
    else:
        print("Invalid mode selected.")
        exit()

if __name__ == "__main__":
    keepLoop = True
    # Keep the loop running
    while keepLoop:
        main()
        # # Ask the user if he wants to continue
        # print("Do you want to continue?")
        # print("1. Yes")
        # print("2. No")
        # response = input("Enter response (1 or 2): ")
        # if response == "2":
        #     keepLoop = False