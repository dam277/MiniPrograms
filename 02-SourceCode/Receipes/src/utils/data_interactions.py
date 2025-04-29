import os
import json
from .Logger import Logger

def load_data(file_name: str) -> list|dict:
    """ # Load data
    @open
    
    Description :
    ---
        This method will load the data from a file.
        
    Arguments :
    ---
        :attribute:`file_name` : str : The file name
        
    Returns :
    ---
        :rtype:`list` : The data
    """
    if os.path.exists(file_name):
            with open(file_name, 'r') as file:
                Logger.get_instance().info(f"Loading data from {file_name}")
                return json.load(file)
    return []

def write_data(file_name: str, data: list) -> None:
    """ # Write data
    @open
    
    Description :
    ---
        This method will write the data to a file.
        
    Arguments :
    ---
        :attribute:`file_name` : str : The file name
        :attribute:`data` : list : The data
        
    Returns :
    ---
        None
    """
    # Create the directory if it does not exist
    if not os.path.exists(os.path.dirname(file_name)):
        Logger.get_instance().info(f"Creating directory {os.path.dirname(file_name)}")
        os.makedirs(os.path.dirname(file_name))

    # Write the data to the file
    with open(file_name, 'w') as file:
        json.dump(data, file, indent=4)
        Logger.get_instance().success(f"Data written to {file_name}")