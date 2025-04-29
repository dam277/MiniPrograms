from .Logger import Logger

routes = {}

# ROute decorator
def route(name: str) -> callable:
    """ # Route decorator
    @route
    
    Description :
    ---
        This decorator will create a route.
        
    Arguments :
    ---
        :attribute:`name` : str : The name of the route
        
    Returns :
    ---
        :rtype:`callable` : The wrapper function
    """
    # Decorator function
    def decorator(func: callable) -> callable:
        """ # Decorator function
        @decorator
        
        Description :
        ---
            This function will create the route.
            
        Arguments :
        ---
            :attribute:`func` : callable : The function to wrap
            
        Returns :
        ---
            :rtype:`callable` : The wrapper function
        """
        # Wrapper function
        def wrapper(*args, **kwargs) -> None:
            """ # Wrapper function
            @wrapper
            
            Description :
            ---
                This function will wrap the function.
                
            Arguments :
            ---
                :attribute:`*args` : The arguments
                :attribute:`**kwargs` : The keyword arguments
                
            Returns :
            ---
                Any
            """
            return func(*args, **kwargs)

        # Check if the route already exists
        if not routes.get(name):
            # Register the route and return the wrapper
            routes[name] = func
            Logger.get_instance().success(f"Route: {name} created")
            return wrapper
        
        Logger.get_instance().error(f"Route: {name} already exists")
        return
    return decorator

def call_route(name: str, app) -> callable:
    """ # Call route
    @open
    
    Description :
    ---
        This function will call the route.
        
    Arguments :
    ---
        :attribute:`name` : str : The name of the route
        :attribute:`app` : The application
        
    Returns :
    ---
        :rtype:`callable` : The route function
    """
    if routes.get(name):
        return routes[name](app)
    Logger.get_instance().error(f"Route: {name} does not exist")
    return