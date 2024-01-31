/* Tο παρακατω κομμάτι προσθέτει ένα επίπεδο πλακιδίων (tile layer) στον χάρτη. Τα πλακίδια είναι μικρές εικόνες που συνθέτουν τον χάρτη.
Η διεύθυνση URL που δίνουμε αντιστοιχεί σε πλακίδια του OpenStreetMap.
Οι {s}, {z}, {x}, και {y} είναι μεταβλητές που αντικαθίστανται από το Leaflet με συγκεκριμένες τιμές για να φορτώσει τα σωστά πλακίδια στον χάρτη σου.*/
// Θέση Βασης
var patrasLatitude = 38.2466;
var patrasLongitude = 21.7346;

// Δημιουργία χάρτη
var map = L.map('map').setView([patrasLatitude, patrasLongitude], 13);

// Προσθήκη χάρτη OpenStreetMap
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

var userLatitude = 38.2468;
var userLongitude = 21.7348;
var userLatitudee = 38.2470;
var userLongitudee = 21.7351;
var userLatitudeee = 38.2449;
var userLongitudeee = 21.7340;


// Προσθήκη marker για τη θέση του χρήστη
var userMarker = L.marker([userLatitude, userLongitude]).addTo(map);
userMarker.bindPopup("Alex(1ος διασώστης)!").openPopup();

var userMarker = L.marker([userLatitudee, userLongitudee]).addTo(map);
userMarker.bindPopup("Νικόλας(2ος διασώστης)!").openPopup();

var userMarker = L.marker([userLatitudeee, userLongitudeee]).addTo(map);
userMarker.bindPopup("Kendrick(3ος διασώστης)!").openPopup();


// Προσθήκη markers για αιτήματα από δεδομένα του server
fetch('marker_request.php')
    .then(response => response.json())
    .then(data => {
        var requestMarkers = [];
        data.forEach(request => {
            var marker = L.marker([request.latitude, request.longitude]).addTo(map);
            marker.bindPopup(
                "Αίτημα:<br>" +
                "Ημερομηνία καταχώρησης: " + request.request_time + "<br>" +
                "Είδος: " + request.request_title + "<br>" +
                "Ποσότητα: " + request.number_of_people + "<br>" +
                "Κατάσταση: " + request.request_status + "<br>" +
                "Ονοματεπώνυμο: " + request.onomateponimo + "<br>" +
                "Τηλέφωνο: " + request.tilefono

            );
            requestMarkers.push(marker);
        });
    })
    .catch(error => console.error('Error fetching data:', error));


var myIcon = L.icon({
    iconUrl: 'red_marker.png', // Το URL της εικόνας του προσαρμοσμένου marker
    iconSize: [30, 30], // Το μέγεθος της εικόνας
    iconAnchor: [16, 32], // Το σημείο στο οποίο θα εφαρμοστεί το marker
    popupAnchor: [0, -32] // Το σημείο στο οποίο θα εμφανίζεται το παράθυρο πληροφοριών (popup)
});


// Προσθήκη markers για ανακοινώσεις-προσφορές απο τον αντμιν
fetch('marker_offers.php')
    .then(response => response.json())
    .then(data => {
        var offerMarkers = [];
        data.forEach(offer => {
            var marker_offer = L.marker([offer.latitude, offer.longitude], {icon: myIcon}).addTo(map);
            marker_offer.bindPopup(
                "Ανακοινώσεις-Προσφορές:<br>" +
                "Τίτλος: " + offer.title + "<br>" +
                "Όνομα χρήστη: " +  offer.username + "<br>" +
                "Ποσότητα: " + offer.offer_amount + "<br>" +
                "Ανακοίνωση: " + offer.announcement_title
            );
            offerMarkers.push(marker_offer);
        });
    })
    .catch(error => console.error('Error fetching data:', error));




// Ορίζουμε μια συνάρτηση για την αποθήκευση των συντεταγμένων στα cookies
function setBaseLocationToCookies(location) {
    document.cookie = `baseLocation=${location.lat},${location.lng}`;
}

// Ορίζουμε μια συνάρτηση για την ανάκτηση των συντεταγμένων από τα cookies
function getBaseLocationFromCookies() {
    const cookies = document.cookie.split(';');
    for (const cookie of cookies) {
        const [name, value] = cookie.split('=');
        if (name.trim() === 'baseLocation') {
            const [lat, lng] = value.split(',').map(Number);
            return { lat, lng };
        }
    }
    return null;
}

// Συντεταγμένες της βάσης
var initialBaseLocation = getBaseLocationFromCookies() || [patrasLatitude, patrasLongitude];

// Δημιουργούμε τον marker της βάσης με τις αρχικές συντεταγμένες
var patrasBaseMarker = L.marker(initialBaseLocation, { draggable: true }).addTo(map);
patrasBaseMarker.bindPopup("Εδώ είναι η Πάτρα και η βάση μας!").openPopup();

// Κώδικας για τη μετακίνηση της βάσης
patrasBaseMarker.on('dragend', function (event) {
    var newBaseLocation = event.target.getLatLng();
    var warningMessage = confirm("Θέλετε να αλλάξετε τη θέση της βάσης;");

    if (!warningMessage) {
        // Αναίρεση της μετακίνησης και επαναφορά στις αρχικές συντεταγμένες
        event.target.setLatLng(initialBaseLocation).openPopup();
    } else {
        alert("Η νέα θέση της βάσης είναι: " + newBaseLocation);
        map.removeLayer(patrasBaseMarker);
        // Αποθήκευση των νέων συντεταγμένων της βάσης στα cookies
        setBaseLocationToCookies(newBaseLocation);
        // Αποθήκευση των νέων συντεταγμένων της βάσης
        patrasBaseMarker = L.marker(newBaseLocation, { draggable: true }).addTo(map);
        patrasBaseMarker.bindPopup("Εδώ είναι η νέα θέση της βάσης!").openPopup();
        // Κώδικας για την ανταλλαγή της dragend με τις νέες συντεταγμένες
        patrasBaseMarker.on('dragend', function (event) {
            var newBaseLocation = event.target.getLatLng();
            alert("Η νέα θέση της βάσης είναι: " + newBaseLocation);
    });
    }
});

