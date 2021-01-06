# ADISE20_TavliPlakoto
Ο σύνδεσμος του παιχνιδιού:(#https://users.iee.ihu.gr/~it154510/ADISE20_TavliPlakoto/)

# Περιγραφή Παιχνιδιού

Το πλακωτό παίζεται ως εξής: Ο κάθε παίκτης έχει την περιοχή εκκίνησής του μπροστά του (κάτω δεξιά ή κάτω αριστερά) και απέναντί της βρίσκεται η περιοχή μαζέματος. Κινείται κανονικά από την περιοχή εκκίνησης στην περιοχή μαζέματος κυκλικά (ωρολογιακά ή αντιωρολογιακά). Η περιοχή εκκίνησης του ενός παίκτη είναι η περιοχή μαζέματος του άλλου.
Στην αρχική θέση δύο πούλια του παίχτη τοποθετούνται στην θέση α δηλαδή την πρώτη θέση της κίνησής τους (λέγεται μάνα) ενώ τα υπόλοιπα 13 είναι έξω από το ταμπλό(στο χέρι του)
τα οποία πρέπει να βάλει μέσα στο ταμπλό.Όταν ένα πούλι βρίσκεται μόνο του σε μια θέση ο αντίπαλος έχει το δικαίωμα να κινήσει σε αυτήν την θέση πούλι του πλακώνοντας το εχθρικό πούλι. Στην θέση αυτή ο παίκτης που πλάκωσε έχει την δυνατότητα να τοποθετεί όσα πούλια ακόμα θέλει σε αυτήν. Το πλακωμένο πούλι δεν έχει το δικαίωμα να κινηθεί από την θέση του. Τα πούλια που το πλακώνουν είναι ελεύθερα να κινηθούν από την θέση αυτή αν όμως φύγουν όλα από τη θέση τότε το πούλι ξεπλακώνεται και είναι ελεύθερο να κινηθεί κανονικά. Όλες οι κινήσεις γίνονται μέσω των ζαριών. Το παιχνίδι κερδίζει ο παίκτης που θα μαζέψει πρώτος όλα του τα πούλια ή αυτός που θα πλακώσει την μάνα του άλλου παίκτη.

Η βάση μας κρατάει τους εξής πίνακες και στοιχεία: Η βάση μας κρατάει τους εξής κανόνες και στοιχεία: Τον πίνακα board ο οποίος έχει τα στοιχεία x και y, το στοιχείο b_color, το στοιχείο pieces και τα στοιχεία first_piece και second_piece. Ο πίνακας board_empty έχει ακριβώς τα ίδια στοιχεία με τον board. Ο πίνακας game_status έχει τα στοιχεία status, p_turn, result και last_change. Ο πίνακας users έχει τα στοιχεία username, piece_color, token, last_action, moves_played και sum. Ο πίνακας repository έχει τα στοιχεία color, pieces και phase.

Η εφαρμογή απαπτύχθηκε μέχρι το σημείο: Η εφαρμογή έχει υλοποιημένες τις δυνατότητες οι παίκτες να βάζουν πούλια στο ταμπλό, να μετακινούν μέσα στο ταμπλό και να μαζεύουν πούλια από το ταμπλό, μόνο νόμιμα και με την χρήση των ζαριών. Υλοποιήθηκε ακόμα ο νόμιμος τερματισμός του παιχνιδιού. Υπάρχουν ακόμα οι δυνατότης αρχικοποίησης του παιχνιδιού και login χρήστη. Δεν υλοποιήθηκε ο κανόνας να ξεκινάει ο παίκτης του μάζεμά του όταν έχει βάλει όλα τα πούλια του στην περιοχή μαζέματος(δηλαδή από την θέση 6 του μαζέματος και μετά). Oi κινήσεις δίνονται μέσα από text με την μορφή x y x2 y2 για κίνηση, x y για τοποθέτηση πουλιού στο ταμπλό και x2 y2 για μάζεμα από το ταμπλό. Δεν υλοποιήθηκε η γραφική εμφάνιση όλων των πουλιών, μπορούν όμως να υπολογιστούν εύκολα αφού υπάρχει για κάθε θέση εμφάνιση του πρώτου και του δεύτερου πουλιού και του συνολικού αριθμού των πουλιών για την θέση αυτή. Γνωρίζουμε ότι αν έχουμε πάνω από δύο πούλια όλα πλήν του πρώτου θα έχουν σίγουρα το χρώμα του δεύτερου πουλιού. Τέλος δεν υπάρχει η δυνατότητα drag n drop.


Η παρακάτω είκόνα μπορέι να χρησιμοποιηθεί ως οδηγός για τις κινήσεις. Η κάτω δεξιά θέση είναι η x=1 y=1 ενώ η δίπλα της από αριστερά είναι η x=1 y=2 και όσο διατρέχουμε προς τα αριστερά το y παίρνει τιμές μέχρι το 12. Αντίστοιχα η θέση πάνω δεξιά είναι η x=2 y=1

![alt text](https://github.com/iee-ihu-gr-course1941/ADISE20_TavliPlakoto/blob/main/Squares_Manual.png?raw=true)


## Συντελεστές

Προγραμματιστής 1: Jquery, PHP API, Σχεδιασμός mysql


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
#### Ανάγνωση Θέσης/Πουλιού

```
GET /board/piece/:x/:y/
```

Κάνει την κίνηση του πουλιού από την θέση x,y στην νέα θέση. Προφανώς ελέγχεται η κίνηση αν είναι νόμιμη καθώς και αν είναι η σειρά του παίκτη να παίξει με βάση το token.
Επιστρέφει τα στοιχεία από το [Board](#Board-1) με συντεταγμένες x,y.
Περιλαμβάνει το χρώμα των πουλιών.

#### Μεταβολή Θέσης Πουλιού

```
PUT /board/piece/:x/:y/
```
Json Data:

| Field             | Description                 | Required   |
| ----------------- | --------------------------- | ---------- |
| `x`               | Η νέα θέση x                | yes        |
| `y`               | Η νέα θέση y                | yes        |

Επιστρέφει τα στοιχεία από το [Board](#Board-1) με συντεταγμένες x,y.
Περιλαμβάνει το χρώμα των πουλιών

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
| `x`                      | H συντεταγμένη x του τετραγώνου              | 1..2                                |
| `y`                      | H συντεταγμένη y του τετραγώνου              | 1..12                               |
| `b_color`                | To χρώμα του τετραγώνου                      | 'B','W'                             |
| `first_piece`            | To χρώμα του πρώτου πουλιού                  | 'B','W', null                       |
| `second_piece`           | To χρώμα του δεύτερου πουλιού                | ''B','W', null                      |
| `pieces`                 | Ο συνολικός αριθμός πουλιών                  | 0..30                               |


### Players
---------

O κάθε παίκτης έχει τα παρακάτω στοιχεία:


| Attribute                | Description                                  | Values                              |
| ------------------------ | -------------------------------------------- | ----------------------------------- |
| `username`               | Όνομα παίκτη                                 | String                              |
| `piece_color`            | To χρώμα που παίζει ο παίκτης                | 'B','W'                             |
| `token  `                | To κρυφό token του παίκτη. Επιστρέφεται μόνο τη στιγμή της εισόδου του παίκτη στο παιχνίδι | HEX |
| `last_action`            | Η στιγμή της τελευταίας ενέργειας του παίχτη  | timestamp |
| `moves_played`           | Ο αριθμός των κινήσεων(τετράγωνα) που έχει μετακινηθεί ο παίκτης την τρέχουσα σειρά  | 0..24 |
| `sum`                    | To άθροισμα των ζαριών στη τρέχουσα σειρά  | 0..24 |

### Game_status
---------

H κατάσταση παιχνιδιού έχει τα παρακάτω στοιχεία:


| Attribute                | Description                                  | Values                              |
| ------------------------ | -------------------------------------------- | ----------------------------------- |
| `status  `               | Κατάσταση             | 'not active', 'initialized', 'started', 'ended', 'aborded'     |
| `p_turn`                 | To χρώμα του παίκτη που παίζει        | 'B','W',null                              |
| `result`                 |  To χρώμα του παίκτη που κέρδισε |'B','W',null                              |
| `last_change`            | Τελευταία αλλαγή/ενέργεια στην κατάσταση του παιχνιδιού         | timestamp |

### Repository
---------

To αποθετήριο κάθε παίχτη έχει τα παρακάτω στοιχεία:


| Attribute                | Description                                  | Values                              |
| ------------------------ | -------------------------------------------- | ----------------------------------- |
| `color  `                | Το χρώμα του παίκτη                          | 'B','W'     |
| `pieces`                 | Ο συνολικός αριθμός των πουλιών στο αποθετήριο        | 0..15                      |
| `phase`                  | Η φάση του παιχνιδιού(τοποθέτηση ή μάζεμα)  |'start','end'                              |

