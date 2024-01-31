var kodikos = document.getElementById("password");
var mikos = document.getElementById("mikos");


/* The logic is checking if the length is greater than or equal to 7.
If it is, it removes the "akyro" class and adds the "egyro" 
class to the length element. Otherwise, it does the opposite.
Η μέθοδος addEventListener στη JavaScript χρησιμοποιείται για την ενσωμάτωση
ενός προγράμματος χειρισμού συμβάντων σε ένα στοιχείο HTML. Αυτή η μέθοδος μας
επιτρέπει να καθορίσουμε μια συνάρτηση που θα εκτελείται όταν συμβεί ένα συγκεκριμένο
συμβάν στο καθορισμένο στοιχείο*/


  kodikos.addEventListener("kodikos", function () {
    // Check if the length of the password is valid
    if (kodikos.value.length >= 7) {
        // Set the message to valid
        mikos.textContent = "Έγκυρος κωδικός";
        mikos.classList.remove("akyro");
        mikos.classList.add("egyro");
    } else {
        // Set the message to invalid
        mikos.textContent = "Ο κωδικός πρέπει να έχει μέγεθος 7 τουλάχιστον";
        mikos.classList.remove("egyro");
        mikos.classList.add("akyro");
    }
});
