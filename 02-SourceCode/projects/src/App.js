import Card from "./Card";

function App() 
{
  const languages = ['JavaScript', 'C++', 'C#', 'Python', 'PHP', "Dart", 'Java', "Rust", "Go", "Ruby"];
  const frameworks = ['Electron', 'React', 'Next', 'Angular', 'Vue', 'Astro', 'Nest', 'Svelte', "Meteor", 'Tree', 'Rails', 'Flask', 'Django', 'PySide6', 'Spring Boot', 'Laravel', "Symfony", "Flutter", "Maui", "SFML", "WPF", "LWJGL", "OpenGL"];

  const projects = [
    { id: 1, name: 'NAS' },
    { 
      id: 2, 
      name: "CDN",
      languages: ["JavaScript", "PHP"],
      frameworks: ["Vue", "Laravel"],
    },
    { id: 3, name: "Intranet website" },
    { 
      id: 4, 
      name: "Github manager", 
      languages: ["JavaScript", "Python"],
      frameworks: ["React", "Electron", "Flask"],
      tasks: [
        { id: 1, name: "Connect to GitHub API" },
        { id: 2, name: "List repositories" },
        { id: 3, name: "Clone/Create repositories" },
        { id: 4, name: "Manage files" },
        { id: 5, name: "Page to manage all repositories : folders, progression, status, to do list with the order of priority" },
        { id: 6, name: "Dashboard with general informations and a synthesis about what languages and frameworks to learn t compare to which are used in projects and courses. Make easier to know what languages must be learned."}
      ]
    },
    { 
      id: 5, 
      name: "GestApp", 
      languages: ["JavaScript", "PHP", "C#"],
      frameworks: ["Next", "Laravel", "Maui"],
      tasks:[
        { id: 1, name: "BASE -- Authentication system" },
        { id: 2, name: "ME - Games library : Achievements, hours played, dlc, characters, genre, platforms..." },
        { id: 3, name: "ME - Streaming library : Animes, films, series, youtube videos/channels, characters, genre, music" },
        { id: 4, name: "ME - Book management system : Authors, Genres, Books, Reviews, Quotes" },
        { id: 5, name: "ME - Tier list maker for Streaming, games, book, etc..." },
        { id: 4, name: "EDU - School management system : Schools, Modules, Courses, Tests, Homeworks" },
        { id: 5, name: "PRO - Company, Job, Employees management system" },
        { id: 5, name: "PRO - Project management system : Projects (with UI customization : url embeds, Widgets), Tasks, Tokens (for example, API or Github manager public API token for integrations), multiple users, roles (permissions) + Integrate the WorkDiary's project inside : charts, etc..." },
        { id: 6, name: "ALL - Dashboard with general informations" },
        { id: 6, name: "ALL - Binder to structurate files" },
        { id: 6, name: "ALL - Calendar with reminders and notifications" },
        { id: 6, name: "ALL - Todo list with folders" },
        { id: 7, name: "ALL - Notes taking system with markdown support for multiple uses + comments. Recursive notes + slash commands for integrations" },
        { id: 8, name: "ALL - Settings page to manage all the application settings" }
      ] 
    },
    { 
      id: 6, 
      name: "Budget manager", 
      languages: ["JavaScript", "Java"],
      frameworks: ["Angular", "Spring Boot"],
      tasks:[
        { id: 1, name: "User authentication system" },
        { id: 2, name: "Dashboard" },
        { id: 3, name: "Journal of expenses and income" },
        { id: 4, name: "Subscriptions management" },
        { id: 5, name: "Reports and statistics" },
        { id: 6, name: "Accounts management" },
        { id: 7, name: "Budget planning" },
        { id: 8, name: "Money goals" }
      ]
    },
    {
      id: 7,
      name: "Procedural dungeon",
      languages: ["Java"],
      frameworks: ["LWJGL"],
    },
    {
      id: 8,
      name: "Solar System",
      languages: ["C#"],
      frameworks: ["SFML"]
    },
    {
      id: 9,
      name: "Task manager",
      languages: ["Python"],
      frameworks: ["PySide6"]
    },
    {
      id: 10,
      name: "Converso",
      languages: ["Dart"],
      frameworks: ["Flutter"]
    },
    {
      id: 11,
      name: "Portfolio website",
      languages: ["JavaScript"],
      frameworks: ["Astro"]
    }
  ];

  const unUsedLanguages = languages.filter(lang => !projects.some(proj => proj.languages && proj.languages.includes(lang)));
  const unUsedFrameworks = frameworks.filter(fw => !projects.some(proj => proj.frameworks && proj.frameworks.includes(fw)));

  return (
    <div className="App bg-gray-800 min-h-screen p-8">
      <h1 className="text-white text-4xl font-bold text-left">Projects</h1>
      <h2 className="text-gray-300 text-lg mt-2">Languages</h2>
      <div className="flex items-center space-x-3 flex-wrap">
        {languages.map(language => (
          <span key={language} className={`${unUsedLanguages.includes(language) ? "text-red-600 line-through" : "text-green-500"}`}>{language}</span>
        ))}
      </div>

      <h2 className="text-gray-300 text-lg mt-2">Frameworks</h2>
      <div className="flex items-center space-x-3 flex-wrap">
        {frameworks.map(framework => (
          <span key={framework} className={`${unUsedFrameworks.includes(framework) ? "text-red-600 line-through" : "text-green-500"}`}>{framework}</span>
        ))}
      </div>

      <div className="grid grid-cols-1 gap-6 mt-6">
        {projects.map(project => (
          <Card key={project.id + project.name} project={project}  />
        ))}
      </div>
      <div className="mt-8">
        <span className="text-gray-400">Total projects: {projects.length}</span>
      </div>
      <div className="mt-2">
        <span className="text-gray-400">Total tasks: {projects.reduce((acc, proj) => acc + (proj.tasks ? proj.tasks.length : 0), 0)}</span>
      </div>
    </div>
  );
}

export default App;
