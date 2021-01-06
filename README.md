# ADISE20_TavliPlakoto
Ο σύνδεσμος του παιχνιδιού:

# Περιγραφή Παιχνιδιού

Το πλακωτό παίζεται ως εξής: Ο κάθε παίκτης έχει την περιοχή εκκίνησής του μπροστά του (κάτω δεξιά ή κάτω αριστερά) και απέναντί της βρίσκεται η περιοχή μαζέματος. Κινείται κανονικά από την περιοχή εκκίνησης στην περιοχή μαζέματος κυκλικά (ωρολογιακά ή αντιωρολογιακά). Η περιοχή εκκίνησης του ενός παίκτη είναι η περιοχή μαζέματος του άλλου.
Στην αρχική θέση δύο πούλια του παίχτη τοποθετούνται στην θέση α δηλαδή την πρώτη θέση της κίνησής τους (λέγεται μάνα) ενώ τα υπόλοιπα 13 είναι έξω από το ταμπλό(στο χέρι του)
τα οποία πρέπει να βάλει μέσα στο ταμπλό.Όταν ένα πούλι βρίσκεται μόνο του σε μια θέση ο αντίπαλος έχει το δικαίωμα να κινήσει σε αυτήν την θέση πούλι του πλακώνοντας το εχθρικό πούλι. Στην θέση αυτή ο παίκτης που πλάκωσε έχει την δυνατότητα να τοποθετεί όσα πούλια ακόμα θέλει σε αυτήν. Το πλακωμένο πούλι δεν έχει το δικαίωμα να κινηθεί από την θέση του. Τα πούλια που το πλακώνουν είναι ελεύθερα να κινηθούν από την θέση αυτή αν όμως φύγουν όλα από τη θέση τότε το πούλι ξεπλακώνεται και είναι ελεύθερο να κινηθεί κανονικά. Όλες οι κινήσεις γίνονται μέσω των ζαριών. Το παιχνίδι κερδίζει ο παίκτης που θα μαζέψει πρώτος όλα του τα πούλια ή αυτός που θα πλακώσει την μάνα του άλλου παίκτη.

Η βάση μας κρατάει τους εξής πίνακες και στοιχεία: Η βάση μας κρατάει τους εξής κανόνες και στοιχεία: Τον πίνακα board ο οποίος έχει τα στοιχεία x και y, το στοιχείο b_color, το στοιχείο pieces και τα στοιχεία first_piece και second_piece. Ο πίνακας board_empty έχει ακριβώς τα ίδια στοιχεία με τον board. Ο πίνακας game_status έχει τα στοιχεία status, p_turn, result και last_change. Ο πίνακας users έχει τα στοιχεία username, piece_color, token, last_action, moves_played και sum. Ο πίνακας repository έχει τα στοιχεία color, pieces και phase.

Η εφαρμογή απαπτύχθηκε μέχρι το σημείο .....(αναφέρετε τι υλοποιήσατε και τι όχι)

## Συντελεστές

Περιγράψτε τις αρμοδιότητες της ομάδας.

Προγραμματιστής 1: Jquery

Προγραμματιστής 2: PHP API

Προγραμματιστής 3: Σχεδιασμός mysql

....


# Περιγραφή API

## Methods


### Board
#### Ανάγνωση Board

```
GET /board/
```

Επιστρέφει το [Board](#Board).

#### Αρχικοποίηση Board
```
POST /board/
```

Αρχικοποιεί το Board, δηλαδή το παιχνίδι. Γίνονται reset τα πάντα σε σχέση με το παιχνίδι.
Επιστρέφει το [Board](#Board).

### Piece
#### Ανάγνωση Θέσης/Πιονιού

```
GET /board/piece/:x/:y/
```

Κάνει την κίνηση του πιονιού από την θέση x,y στην νέα θέση. Προφανώς ελέγχεται η κίνηση αν είναι νόμιμη καθώς και αν είναι η σειρά του παίκτη να παίξει με βάση το token.
Επιστρέφει τα στοιχεία από το [Board](#Board-1) με συντεταγμένες x,y.
Περιλαμβάνει το χρώμα του πιονιού και τον τύπο.

#### Μεταβολή Θέσης Πιονιού

```
PUT /board/piece/:x/:y/
```
Json Data:

| Field             | Description                 | Required   |
| ----------------- | --------------------------- | ---------- |
| `x`               | Η νέα θέση x                | yes        |
| `y`               | Η νέα θέση y                | yes        |

Επιστρέφει τα στοιχεία από το [Board](#Board-1) με συντεταγμένες x,y.
Περιλαμβάνει το χρώμα του πιονιού και τον τύπο


### Player

#### Ανάγνωση στοιχείων παίκτη
```
GET /players/:p
```

Επιστρέφει τα στοιχεία του παίκτη p ή όλων των παικτών αν παραληφθεί. Το p μπορεί να είναι 'B' ή 'W'.

#### Καθορισμός στοιχείων παίκτη
```
PUT /players/:p
```
Json Data:

| Field             | Description                 | Required   |
| ----------------- | --------------------------- | ---------- |
| `username`        | Το username για τον παίκτη p. | yes        |
| `color`           | To χρώμα που επέλεξε ο παίκτης p. | yes        |


Επιστρέφει τα στοιχεία του παίκτη p και ένα token. Το token πρέπει να το χρησιμοποιεί ο παίκτης καθόλη τη διάρκεια του παιχνιδιού.

### Status

#### Ανάγνωση κατάστασης παιχνιδιού
```
GET /status/
```

Επιστρέφει το στοιχείο [Game_status](#Game_status).



## Entities


### Board
---------

Το board είναι ένας πίνακας, ο οποίος στο κάθε στοιχείο έχει τα παρακάτω:


| Attribute                | Description                                  | Values                              |
| ------------------------ | -------------------------------------------- | ----------------------------------- |
| `x`                      | H συντεταγμένη x του τετραγώνου              | 1..8                                |
| `y`                      | H συντεταγμένη y του τετραγώνου              | 1..8                                |
| `b_color`                | To χρώμα του τετραγώνου                      | 'B','W'                             |
| `piece_color`            | To χρώμα του πιονιού                         | 'B','W', null                       |
| `piece`                  | To Πιόνι που υπάρχει στο τετράγωνο           | 'K','Q','R','B','N','P', null       |
| `moves`                  | Πίνακας με τα δυνατά τετράγωνα (x,y) που μπορεί να μετακινηθεί το τρέχον πιόνι. Αν δεν υπάρχει πιόνι, ή δεν έχει κάνει login ο χρήστης, ή δεν έχει ξεκινήσει το παιχνίδι ή αν δεν υπάρχουν κινήσεις, τότε το πεδίο δεν υπάρχει. |   |


### Players
---------

O κάθε παίκτης έχει τα παρακάτω στοιχεία:


| Attribute                | Description                                  | Values                              |
| ------------------------ | -------------------------------------------- | ----------------------------------- |
| `username`               | Όνομα παίκτη                                 | String                              |
| `piece_color`            | To χρώμα που παίζει ο παίκτης                | 'B','W'                             |
| `token  `                | To κρυφό token του παίκτη. Επιστρέφεται μόνο τη στιγμή της εισόδου του παίκτη στο παιχνίδι | HEX |


### Game_status
---------

H κατάσταση παιχνιδιού έχει τα παρακάτω στοιχεία:


| Attribute                | Description                                  | Values                              |
| ------------------------ | -------------------------------------------- | ----------------------------------- |
| `status  `               | Κατάσταση             | 'not active', 'initialized', 'started', 'ended', 'aborded'     |
| `p_turn`                 | To χρώμα του παίκτη που παίζει        | 'B','W',null                              |
| `result`                 |  To χρώμα του παίκτη που κέρδισε |'B','W',null                              |
| `last_change`            | Τελευταία αλλαγή/ενέργεια στην κατάσταση του παιχνιδιού         | timestamp |

