import firebase from 'firebase';
// Initialize Firebase
var config = {
    apiKey: "AIzaSyCHH2plTAM-ItRx05YrAY_4ezL4bCjqL7M",
    authDomain: "time-wasted-pieterdirix.firebaseapp.com",
    databaseURL: "https://time-wasted-pieterdirix.firebaseio.com",
    projectId: "time-wasted-pieterdirix",
    storageBucket: "time-wasted-pieterdirix.appspot.com",
    messagingSenderId: "90406146673"
};
firebase.initializeApp(config);

export default firebase