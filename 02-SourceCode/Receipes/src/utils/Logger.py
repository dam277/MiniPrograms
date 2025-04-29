import logging
from colorama import Fore
from enum import Enum

class Level(Enum):
    """ # Log levels
    @enum
    
    Description :
    ---
        This class will define the log levels for the logger.
        
    Attributes :
    ---
        DEBUG : int : The debug log level
        SUCCESS : int : The success log level
        INFO : int : The info log level
        WARNING : int : The warning log level
        ERROR : int : The error log level
        CRITICAL : int : The critical log level

    Inheritance :
    ---
        Enum : enum.Enum : Enumeration class
    """
    DEBUG = logging.DEBUG
    SUCCESS = 25  # Custom log level
    INFO = logging.INFO
    WARNING = logging.WARNING
    ERROR = logging.ERROR
    CRITICAL = logging.CRITICAL

class Logger:
    """ # Logger class
    @class
    
    Description :
    ---
        This class will handle
        
    Attributes :
    ---
        _instance : Logger : The instance of the Logger class
    """
    _instance = None

    def __init__(self):
        """ # Constructor
        @constructor
        
        Description :
        ---
            This function will initialize the Logger class.
        """
        pass

    #region Private functions ========================================================
    def __success(self, message: str, *args, **kwargs):
        """ # Log a success message
        @private
        
        Description :
        ---
            This function will log a success message using the logger.
        
        Arguments :
        ---
            :attribute:`message` : str : The message to log
            :attribute:`*args` : Any : The arguments to pass to the logger
            :attribute:`**kwargs` : Any : The keyword arguments to pass to the logger
            
        Returns :
        ---
            None
        """
        logger = logging.getLogger()
        if logger.isEnabledFor(Level.SUCCESS.value):
            logger._log(Level.SUCCESS.value, message, args, **kwargs)

    def __log(self, message: str, level: Level = None, console_display: bool = False) -> None:
        """ # Log a message
        @private

        Description :
        ---
            This function will log a message using the logger.

        Arguments :
        ---
            :attribute:`message` : str : The message to log
            :attribute:`level` : Level : The log level of the message
            :attribute:`console_display` : bool : Whether to display the message on the console

        Returns :
        ---
            None
        """
        display_message = ""
        match level:
            # Debug message
            case Level.DEBUG:
                display_message = f"{Fore.MAGENTA}DEBUG: {message}"
                log_function = logging.debug
            # Success message
            case Level.SUCCESS:
                display_message = f"{Fore.GREEN}SUCCESS: {message}"
                log_function = self.__success
            # Info message
            case Level.INFO:
                display_message = f"{Fore.BLUE}INFO: {message}"
                log_function = logging.info
            # Warning message
            case Level.WARNING:
                display_message = f"{Fore.YELLOW}WARNING: {message}"
                log_function = logging.warning
            # Error message
            case Level.ERROR:
                display_message = f"{Fore.LIGHTRED_EX}ERROR: {message}"
                log_function = logging.error
            # Critical message
            case Level.CRITICAL:
                display_message = f"{Fore.RED}CRITICAL: {message}"
                log_function = logging.critical
            case _:
                display_message = f"{Fore.LIGHTCYAN_EX}{message}"
                log_function = logging.info
        
        # Log the message
        log_function(message)

        # Display the message
        if console_display:
            print(display_message, Fore.RESET)
    #endregion ______________________________________________________________________
    
    #region Public functions ========================================================
    def default(self, message: str, console_display: bool = False):
        """ # Log a message
        @public

        Description :
        ---
            This function will log a message using the logger.
        
        Arguments :
        ---
            :attribute:`message` : str : The message to log
            :attribute:`console_display` : bool : Whether to display the message on the console

        Returns :
        ---
            None
        """
        self.__log(message, console_display=console_display)

    def debug(self, message: str, console_display: bool = False):
        """ # Log a debug message
        @public
        
        Description :
        ---
            This function will log a debug message using the logger.
            
        Arguments :
        ---
            :attribute:`message` : str : The message to log
            :attribute:`console_display` : bool : Whether to display the message on the console
            
        Returns :
        ---
            None
        """
        self.__log(message, Level.DEBUG, console_display)

    def info(self, message: str, console_display: bool = False):
        """ # Log an info message
        @public

        Description :
        ---
            This function will log an info message using the logger.
        
        Arguments :
        ---
            :attribute:`message` : str : The message to log
            :attribute:`console_display` : bool : Whether to display the message on the console

        Returns :
        ---
            None
        """
        self.__log(message, Level.INFO, console_display)

    def success(self, message: str, console_display: bool = False):
        """ # Log a success message
        @public
        
        Description :
        ---
            This function will log a success message using the logger.
            
        Arguments :
        ---
            :attribute:`message` : str : The message to log
            :attribute:`console_display` : bool : Whether to display the message on the console
            
        Returns :
        ---
            None
        """
        self.__log(message, Level.SUCCESS, console_display)

    def warning(self, message: str, console_display: bool = False):
        """ # Log a warning message
        @public

        Description :
        ---
            This function will log a warning message using the logger.
        
        Arguments :
        ---
            :attribute:`message` : str : The message to log
            :attribute:`console_display` : bool : Whether to display the message on the console

        Returns :
        ---
            None
        """
        self.__log(message, Level.WARNING, console_display)

    def error(self, message: str, console_display: bool = False):
        """ # Log an error message
        @public

        Description :
        ---
            This function will log an error message using the logger.
        
        Arguments :
        ---
            :attribute:`message` : str : The message to log
            :attribute:`console_display` : bool : Whether to display the message on the console

        Returns :
        ---
            None
        """
        self.__log(message, Level.ERROR, console_display)

    def critical(self, message: str, console_display: bool = False):
        """ # Log a critical message
        @public

        Description :
        ---
            This function will log a critical message using the logger.
        
        Arguments :
        ---
            :attribute:`message` : str : The message to log
            :attribute:`console_display` : bool : Whether to display the message on the console

        Returns :
        ---
            None
        """
        self.__log(message, Level.CRITICAL, console_display)
    #endregion ______________________________________________________________________

    #region Static functions ========================================================
    @staticmethod
    def get_instance():
        """ # Get instance of the Logger class
        @static
        
        Description :
        ---
            This function will return the instance of the Logger class. \n
            If the instance is not created, it will create the instance and set up the logger.
        
        Arguments :
        ---
            None
        
        Returns :
        ---
            :class:`Logger` : The instance of the Logger class
        """
        if Logger._instance is None:
            Logger._instance = Logger()
            Logger._instance.set_up()
        return Logger._instance

    @staticmethod
    def set_up() -> None:
        """ # Set up the logger
        @static

        Description :
        ---
            This function will set up the logger for the application. \n
            It will set the log level to DEBUG and format the log messages.
        
        Arguments :
        ---
            None
        
        Returns :
        ---
            None
        """
        print(Fore.CYAN + "Setting up the logger..." + Fore.RESET)
        logging.basicConfig(filename='logs.log', level=logging.DEBUG, format='%(levelname)s -> %(asctime)s : %(message)s', datefmt='%d-%m-%Y %H:%M:%S')
        logging.addLevelName(Level.SUCCESS.value, "SUCCESS")
    #endregion ______________________________________________________________________