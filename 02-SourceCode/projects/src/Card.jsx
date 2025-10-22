import { useState } from "react";

function Card({ project }) 
{
    const [isExpanded, setIsExpanded] = useState(false);

    const toggleClasses = isExpanded
      ? "max-h-[1000px] opacity-100 mt-4"
      : "max-h-0 opacity-0";

    return (
        <div
            key={project.id + project.name}
            onClick={() => setIsExpanded(!isExpanded)}
            className="bg-gray-700 rounded-lg shadow-lg p-6 text-white hover:shadow-2xl transition-shadow cursor-pointer"
          >
            <div className="flex items-start justify-between">
              <div className="flex flex-col">
                <div>
                    <span className="text-2xl font-semibold">{project.name}</span>
                    <span className="ml-2 text-gray-400">{project.tasks && `${project.tasks.length} tasks`}</span>
                </div>
                <div className="mt-2 text-gray-300">
                  <span className="mr-4">
                    <strong className="text-gray-400">Languages:</strong>{" "}
                    {project.languages ? project.languages.map(lang => (
                        <span
                          key={lang}
                          className="inline-flex items-center px-2 py-0.5 rounded-full bg-gray-600 border border-gray-500 text-xs font-medium text-gray-100 mr-2 mb-2"
                        >
                          {lang}
                        </span>
                    )) : "None"}
                  </span>
                  <span>
                    <strong className="text-gray-400">Frameworks:</strong>{" "}
                    {project.frameworks ? project.frameworks.map(fw => (
                        <span
                          key={fw}
                          className="inline-flex items-center px-2 py-0.5 rounded-full bg-gray-600 border border-gray-500 text-xs font-medium text-gray-100 mr-2 mb-2"
                        >
                          {fw}
                        </span>
                    )) : "None"}
                  </span>
                </div>
              </div>
              <div className="text-sm text-gray-300 relative">
                <span className="text-gray-400 absolute left-full bottom-full">#{project.id}</span>
                <span className="mr-5 text-gray-400 text-3xl">{isExpanded ? "−" : "+"}</span>
              </div>
            </div>

            {/* animated container: transition max-height + opacity for smooth expand/collapse */}
            <div
              className={`overflow-hidden transition-all duration-300 ease-in-out ${toggleClasses}`}
              aria-hidden={!isExpanded}
            >
              <div className={`transform transition-opacity duration-200 ${isExpanded ? "opacity-100 translate-y-0" : "opacity-0 -translate-y-2"}`}>
                {project.tasks && project.tasks.length > 0 ? (
                    <ul className="space-y-2">
                      {project.tasks.map(task => (
                        <li key={task.id + task.name} className="flex items-center text-gray-200">
                          <span className="inline-block min-w-2 h-2 bg-green-400 rounded-full mr-3" />
                          <span className="text-lg">{task.name}</span>
                        </li>
                      ))}
                    </ul>
                ) : (
                    <div className="text-gray-400 italic">No tasks</div>
                )}
              </div>
            </div>
       </div>
    );
}

export default Card;