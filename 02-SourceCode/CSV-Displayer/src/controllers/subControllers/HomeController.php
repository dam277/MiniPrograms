<?php
require_once(__DIR__ . "/../Controller.php");
require_once(__DIR__ . "/../../models/tables/File.php");
require_once(__DIR__ . "/../../models/tables/FileRow.php");

class HomeController extends Controller
{
    /**
     * Constructor for the HomeController class.
     * This constructor can be overridden by child classes to implement specific initialization logic.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Displays the home page.
     *
     * @return Response The response containing the view and variables for the home page.
     */
    public function home(): Response
    {
        $view = View::getView(viewName: "home");

        $data = File::getAll();

        return new Response(httpCode: 200, view: $view, variables: 
        [
            "files" => $data,
            "title" => "Home",
        ]);
    }

    public function details(array $params): Response
    {
        $id = $params["id"] ?? null;

        $view = View::getView(viewName: "details");

        $rows = FileRow::getAllByFileId(fileId: $id);
        $file = File::getById(id: $id);

        if ($file === null) 
            return new Response(httpCode: 404, view: View::getView(viewName: "error"), variables: ["message" => "File not found."]);

        return new Response(httpCode: 200, view: $view, variables:
        [
            "file" => $file[0],
            "rows" => $rows,
            "title" => "Details"
        ]);
    }
}
?>