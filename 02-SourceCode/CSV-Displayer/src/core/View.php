<?php
class View
{
    /**
     * @var ?array<string, View> $views
     * An associative array of view names and their corresponding View objects.
     */
    private static ?array $views = null;


    private string $path;
    public function getpath(): string { return $this->path; }

    /**
     * Constructor for the View class.
     * Initializes the view with the given path.
     *
     * @param string $path The path to the view file.
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * Gets the content of a view file.
     *  @param string $view The name of the view file to load.
     *   @return ?View Returns the View object if found, null otherwise.
     */
    public static function getView(string $viewName): ?View
    {
        $view = array_key_exists($viewName, self::$views) ? self::$views[$viewName] : null;
        return $view;
    } 

    public static function scanViewsRecursively(): void
    {
        $baseViewPath = __DIR__ . "/../Views/";
        self::$views = [];

        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($baseViewPath)
        );

        foreach ($iterator as $file) 
            if ($file->isFile() && preg_match('/(.+)\.view\.php$/', $file->getFilename(), $matches)) 
                self::$views[$matches[1]] = new self(path: $file->getPathname());
    }

    public function render(int $code = 200): void
    {
        http_response_code($code);
        header("Content-Type: text/html; charset=UTF-8");

        include_once $this->getpath();
    }
}
?>