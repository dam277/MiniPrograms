import { initializeApp } from "firebase/app";
import { getFirestore, collection, getDocs, onSnapshot } from "firebase/firestore";

class FirebaseSetup 
{
    /** @type {FirebaseSetup} */
    static instance = null;

    constructor() 
    {
        const firebaseConfig = 
        {
            apiKey: "AIzaSyC24GLZReXIWPOaBAEfWISmVa2F5ZsaEkM",
            authDomain: "paris-event-c0290.firebaseapp.com",
            projectId: "paris-event-c0290",
            storageBucket: "paris-event-c0290.firebasestorage.app",
            messagingSenderId: "253996883325",
            appId: "1:253996883325:web:5d0f6557b4681265af4014"
        };

        this.app = initializeApp(firebaseConfig);
        this.db = getFirestore(this.app);
    }

    /**
     * 
     * @returns {FirebaseSetup}
     */
    static getInstance()
    {
        if (FirebaseSetup.instance === null)
            FirebaseSetup.instance = new FirebaseSetup();
        
        return FirebaseSetup.instance;
    }
}

export default FirebaseSetup;