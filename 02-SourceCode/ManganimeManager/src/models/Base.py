# Get json files
import json
import os
from ..utils.data_interactions import load_data, write_data
from ..utils.Logger import Logger, Level

class Base:
    """ # Base
    @class
    
    Description :
    ---
        This class is the base class for all the models.
"""
    def __init__(self, id, name, rate):
        self.id = id
        self.name = name
        self.rate = rate

    # Protected functions --------------------------------------------------------------------------------------------
    def _add_entry(self, file_name: str) -> tuple[bool, str]:
        """ # Add entry
        @protected
        
        Description :
        ---
            Add an entry to the JSON file.  
        
        Arguments :
        ---
            :attribute:`file_name` : str : The name of the JSON file
        
        Returns :
        ---
            :rtype:`tuple` : The response of the addition
        """
        # Load the existing JSON data
        data = load_data(file_name)

        # Check if the entry already exists
        if self._check_if_exists(data):
            return (False, "This entry already exists")

        # Append the new entry to the existing data
        data.append(self.__dict__)

        # Write the updated data back to the JSON file
        write_data(file_name, data)

        return (True, "Entry added successfully")  
    
    def _update_entry(self, file_name: str) -> None:
        """ # Update entry
        @protected
        
        Description :
        ---
            Update an entry in the JSON file.
            
        Arguments :
        ---
            :attribute:`file_name` : str : The name of the JSON file
            
        Returns :
        ---
            :rtype:`tuple` : The response of the update
        """
        data = load_data(file_name)
        
        # Update the entry
        if data:
            for item in data:
                if item['id'] == self.id:
                    item.update(self.__dict__)
            write_data(file_name, data)
        
        # Check if the entry was updated
        if not self._check_if_exists(data):
            return (False, "Failed to update entry")
        return (True, "Entry updated successfully")

    def _delete_entry(self, file_name: str) -> tuple[bool, str]:
        """ # Delete entry
        @protected
        
        Description :
        ---
            Delete an entry from the JSON file.
            
        Arguments :
        ---
            :attribute:`file_name` : str : The name of the JSON file
            
        Returns :
        ---
            :rtype:`tuple` : The response of the deletion
        """
        data = load_data(file_name)

        # Check if the entry exists
        if not self._check_if_exists(data):
            return (False, "This entry does not exist")

        # Delete the entry
        if data:
            data = [item for item in data if item['id'] != self.id]
            write_data(file_name, data)

        # Check if the entry was deleted
        if self._check_if_exists(data):
            return (False, "Failed to delete entry")
        return (True, "Entry deleted successfully")
    
    def _check_if_exists(self, data: list) -> bool:
        """ # Check if exists
        @protected
        
        Description :
        ---
            Check if the entry exists in the JSON file.
            
        Arguments :
        ---
            :attribute:`data` : list : The data to check
            
        Returns :
        ---
            :rtype:`bool` : The result of the check
        """
        return any(item['name'] == self.name for item in data)
    
    # Static functions --------------------------------------------------------------------------------------------
    @staticmethod
    def get_entry_by_name(file_name: str, name: str):
        """ # Get entry by name
        @static
        
        Description :
        ---
            Get an entry by its name.
            
        Arguments :
        ---
            :attribute:`file_name` : str : The name of the JSON file
            :attribute:`name` : str : The name of the entry
            
        Returns :
        ---
            :rtype:`dict` : The entry
        """
        data = load_data(file_name)
        return next((item for item in data if item['name'] == name), None)

    @staticmethod
    def get_last_id(file_name: str) -> int:
        """ # Get last id
        @static
        
        Description :
        ---
            Get the last id of the list.
            
        Arguments :
        ---
            :attribute:`file_name` : str : The name of the JSON file
            
        Returns :
        ---
            :rtype:`int` : The last id
        """
        data = load_data(file_name)

        # Check if the data is not empty and return the last id
        if data:
            return max(item['id'] for item in data)
        return 0