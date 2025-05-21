import sys

class Console:
    last_length = 0

    @staticmethod
    def print_message(message: str, position: int = 0) -> None:
        """Prints a message in-place, overwriting the previous one."""
        # Erase previous message
        sys.stdout.write('\b' * Console.last_length)
        sys.stdout.write(' ' * Console.last_length)
        sys.stdout.write('\b' * Console.last_length)
        # Print new message
        sys.stdout.write(message)
        sys.stdout.flush()
        # Save length for next overwrite
        Console.last_length = len(message)