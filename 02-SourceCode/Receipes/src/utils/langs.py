from enum import Enum
import os
from .data_interactions import load_data

LANGS_FILES = {
    "en": "en.json",
    "fr": "fr.json"
}

class Langs(Enum):
    """ # Langs enumeration
    @enum

    Description :
    ---
        This enumeration will hold the supported languages for the application.
    """
    EN = "en"
    FR = "fr"

def get_translations(lang: Langs) -> dict:
    """ # Get translations
    @open

    Description :
    ---
        This method will return the traductions for the given language.
    
    Arguments :
    ---
        :attribute:`lang` : Langs : The language

    Returns :
    ---
        :rtype:`dict` : The traductions
    """
    return load_data(os.path.join("src", "data", "langs", LANGS_FILES.get(lang.value)))