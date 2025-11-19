import Card from "./Card";

function App() 
{
  const languages = ['JavaScript', 'C++', 'C#', 'Python', 'PHP', "Dart", 'Java', "Rust", "Go", "Ruby", "Kotlin"];

  // Group frameworks by their primary language for clearer UI
  const frameworksByLanguage = {
    JavaScript: ['Electron', 'React', 'React native', 'Next', 'Vue', 'Astro', 'Nest', 'Nuxt', 'Svelte', 'Meteor'],
    'C++': ['OpenGL'],
    'C#': ['Maui', 'WPF', 'SFML', "ASP.NET"],
    Python: ['Flask', 'Django', 'PySide6'],
    PHP: ['Laravel', 'Symfony'],
    Dart: ['Flutter'],
    Java: ['Spring Boot', 'LWJGL', 'Android - jv'],
    Ruby: ['Rails'],
    Kotlin: ['Android - kt'],
    Rust: [],
    Go: [],
  };

  const projects = [
    { id: 1, name: 'NAS' },
    { 
      id: 2, 
      name: "CDN (Web)",
      languages: ["PHP", "JavaScript"],
      frameworks: ["Laravel", "Vue"],
    },
    { 
      id: 3,
      name: "Intranet (Web)", 
      languages: ["C#", "JavaScript"],
      frameworks: ["ASP.NET", "Nuxt"],
    },
    { 
      id: 4, 
      name: "Github manager (desktop)", 
      languages: ["Python", "JavaScript"],
      frameworks: ["Flask", "Electron"],
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
      name: "GestApp (Web, desktop, mobile)", 
      languages: ["PHP", "JavaScript", "C#", "Kotlin"],
      frameworks: ["Laravel", "React", "WPF", "Android - kt"],
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
      languages: ["Java", "JavaScript"],
      frameworks: ["Spring Boot", "Angular"],
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
      languages: ["C#"],
      frameworks: ["Maui"]
    },
    {
      id: 11,
      name: "PricePulse",
      languages: ["Python", "Javascript"],
      frameworks: ["Flask", "Meteor"]
    },
    {
      id: 12,
      name: "Portfolio website",
      languages: ["JavaScript"],
      frameworks: ["Astro"]
    },
    {
      id: 0,
      name: "School students manager",
      languages: ["Dart"],
      frameworks: ["Flutter"]
    },
    {
      id: 1,
      name: "Server monitor app",
      languages: ["JavaScript"],
      frameworks: ["Next"]
    },
    {
      id: 2,
      name: "Dashboard app",
      languages: ["JavaScript"],
      frameworks: ["Svelte"]
    },
    {
      id: 2,
      name: "Games launcher + subgames",
      languages: ["JavaScript"],
      frameworks: ["React native"]
    }
  ];

  // Determine which frameworks are used by at least one project
  const usedFrameworks = new Set(projects.flatMap(proj => proj.frameworks || []));

  // Determine unused languages (same logic as before)
  const unUsedLanguages = languages.filter(lang => !projects.some(proj => proj.languages && proj.languages.includes(lang)));

  projects.sort((a, b) => a.id - b.id);

  return (
    <div className="App bg-gray-800 min-h-screen p-8">
      <h1 className="text-white text-4xl font-bold text-left">Projects</h1>

      <h2 className="text-gray-300 text-lg mt-6">Languages</h2>
      <div className="flex items-center space-x-3 flex-wrap">
        {languages.map(language => (
          <span key={language} className={`${unUsedLanguages.includes(language) ? "text-red-600 line-through" : "text-green-500"}`}>{language}</span>
        ))}
      </div>

      <h2 className="text-gray-300 text-lg mt-6">Frameworks by Language</h2>
      <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
        {languages.map(language => {
          const frameworks = frameworksByLanguage[language] || [];
          return (
            <div key={language} className="bg-gray-700 p-4 rounded">
              <div className="flex items-center justify-between">
                <h3 className="text-white font-semibold">{language}</h3>
                <span className="text-sm text-gray-300">{frameworks.length} framework{frameworks.length !== 1 ? 's' : ''}</span>
              </div>

              {frameworks.length === 0 ? (
                <div className="text-gray-400 mt-2">No registered frameworks</div>
              ) : (
                <div className="flex flex-wrap items-center mt-3 space-x-3">
                  {frameworks.map(fw => {
                    const isUsed = usedFrameworks.has(fw);
                    return (
                      <span
                        key={`${language}-${fw}`}
                        className={`${isUsed ? "text-green-500" : "text-red-600 line-through"} text-sm`}
                        title={isUsed ? "Used in at least one project" : "Not used in any project yet"}
                      >
                        {fw}
                      </span>
                    );
                  })}
                </div>
              )}
            </div>
          );
        })}
      </div>

      <h2 className="text-gray-300 text-lg mt-8">Project List</h2>
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
