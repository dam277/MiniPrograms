import EventType from "../../utils/enums/EventType";
import FirebaseSetup from "../firebaseSetup";

import { getFirestore, collection, getDocs, onSnapshot, addDoc } from "firebase/firestore";

class TimerEvent 
{
    static events = [];
    
    constructor({id, name, date, type = EventType.DEFAULT, description = ""}) 
    {
        this.id = id;
        this.name = name;
        this.date = date;
        this.type = type;
        this.description = description;
    }

    static fromJson(json)
    {
        return new TimerEvent({
            id: json.id,
            name: json.name,
            date: json.date,
            type: EventType[json.type?.toUpperCase()] || EventType.DEFAULT,
            description: json.description
        });
    }

    toJson()
    {
        return {
            id: this.id || this.generateUuid(),
            name: this.name,
            date: this.date,
            type: this.type,
            description: this.description
        };
    }

    generateUuid() {
        // Generate a simple UUID (not cryptographically secure)
        return 'xxxxxx'.replace(/[x]/g, function() {
            return (Math.random() * 16 | 0).toString(16);
        });
    }

    // Function to listen for real-time updates to events
    static listenForEvents(setEvents) 
    {
        const db = FirebaseSetup.getInstance().db;
        const eventsCol = collection(db, "events");
        const unsubscribe = onSnapshot(eventsCol, (snapshot) => 
        {
            const eventList = snapshot.docs.map(doc => ({ id: doc.id, ...doc.data() }));
            const timerEvents = eventList.map(e => TimerEvent.fromJson(e)).sort((a, b) => new Date(a.date) - new Date(b.date));
            setEvents(timerEvents);
        });

        // To stop listening later:
        // unsubscribe();
        return unsubscribe; // Return the unsubscribe function so you can stop listening later
    }

    static async addEvent(event)
    {
        const db = FirebaseSetup.getInstance().db;
        if (db) {
            const eventsCol = collection(db, "events");
            await addDoc(eventsCol, event);
        }
    }
}

export default TimerEvent;