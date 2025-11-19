import { useEffect, useState } from "react";
import TimerEvent from "./firebase/models/TimerEvent";
import EventType from "./utils/enums/EventType";
import EventComponent from "./views/components/EventComponent";

function App() 
{
  const [events, setEvents] = useState([]);

  // Load events once on component mount
  useEffect(() => 
  {
    async function fetchEvents() 
    {
      TimerEvent.listenForEvents(setEvents);
    }
    fetchEvents();
  }, []);

  return (
    <div className="App bg-gradient-to-br from-gray-900 via-gray-800 to-black">
      <header className="App-header">
        <div className="w-full flex justify-end px-4 py-2">
          <span className="text-[6px] text-gray-400">Daniel est con (1m10)</span>
        </div>
      </header>
      <main className="min-h-screen flex flex-col items-center justify-center text-white">
        <h1 className="text-4xl font-bold mb-8">Event Countdown</h1>
        <div className="w-full max-w-4xl px-4">
          {events.length === 0 ? (
            <p className="text-center text-gray-400">No events available.</p>
          ) : (
            <div className="flex flex-wrap -mx-2">
              {events.map(event => (
                <div key={event.id} className="w-full sm:w-2/3 md:w-1/2 px-2 mb-4">
                  <EventComponent event={event} />
                </div>
              ))}
            </div>
          )}
        </div>
      </main>
    </div>
  );
}

export default App;
