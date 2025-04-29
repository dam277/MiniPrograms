function addTextInput(tagId)
{
    let parent = document.getElementById(tagId);
    console.log(parent);

    // Count the number of children in the parent
    let childrenNumber = parent.children.length + 1;


    let input = document.createElement("input");
    input.type = "text";
    input.name = "answer" + childrenNumber;
    input.id = "answer" + childrenNumber;
    input.placeholder = "Answer " + childrenNumber;
    input.className = "border p-2 w-full mb-2";

    parent.appendChild(input);
}