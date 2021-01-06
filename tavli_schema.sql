-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 06 Ιαν 2021 στις 13:28:17
-- Έκδοση διακομιστή: 10.4.6-MariaDB
-- Έκδοση PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `tavli`
--

DELIMITER $$
--
-- Διαδικασίες
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `clean_board` ()  BEGIN
	replace into board select * from board_empty;
    UPDATE `players` SET username=NULL, token=NULL, 		moves_played=0;
	UPDATE `game_status` SET `status`='not active', `p_turn`=NULL, `result`=NULL;
    UPDATE `repository` SET `pieces` = 13, `phase`='start';
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `test_move` ()  BEGIN
SELECT * FROM
board B1 INNER JOIN board B2
WHERE B1.x=2 AND B1.y=2
AND (B2.`piece_color` IS NULL OR B2.`piece_color`<>B1.`piece_color`)
AND B1.x=B2.x AND B1.y<B2.y AND (B2.y-B1.y)<=2 ;
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `board`
--

CREATE TABLE `board` (
  `x` tinyint(1) NOT NULL,
  `y` tinyint(1) NOT NULL,
  `b_color` enum('B','W') NOT NULL,
  `first_piece` enum('W','B') DEFAULT NULL,
  `second_piece` enum('W','B') DEFAULT NULL,
  `pieces` tinyint(6) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `board`
--

INSERT INTO `board` (`x`, `y`, `b_color`, `first_piece`, `second_piece`, `pieces`) VALUES
(1, 1, 'B', 'B', 'B', 2),
(2, 1, 'W', 'W', 'W', 2),
(1, 2, 'W', NULL, NULL, 0),
(2, 2, 'B', NULL, NULL, 0),
(1, 3, 'B', NULL, NULL, 0),
(2, 3, 'W', NULL, NULL, 0),
(1, 4, 'W', NULL, NULL, 0),
(2, 4, 'B', NULL, NULL, 0),
(1, 5, 'B', NULL, NULL, 0),
(2, 5, 'W', NULL, NULL, 0),
(1, 6, 'W', NULL, NULL, 0),
(2, 6, 'B', NULL, NULL, 0),
(1, 7, 'B', NULL, NULL, 0),
(2, 7, 'W', NULL, NULL, 0),
(1, 8, 'W', NULL, NULL, 0),
(2, 8, 'B', NULL, NULL, 0),
(1, 9, 'B', NULL, NULL, 0),
(2, 9, 'W', NULL, NULL, 0),
(1, 10, 'W', NULL, NULL, 0),
(2, 10, 'B', NULL, NULL, 0),
(1, 11, 'B', NULL, NULL, 0),
(2, 11, 'W', NULL, NULL, 0),
(1, 12, 'W', NULL, NULL, 0),
(2, 12, 'B', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `board_empty`
--

CREATE TABLE `board_empty` (
  `x` tinyint(1) NOT NULL,
  `y` tinyint(1) NOT NULL,
  `b_color` enum('B','W') NOT NULL,
  `first_piece` enum('W','B') DEFAULT NULL,
  `second_piece` enum('W','B') DEFAULT NULL,
  `pieces` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `board_empty`
--

INSERT INTO `board_empty` (`x`, `y`, `b_color`, `first_piece`, `second_piece`, `pieces`) VALUES
(1, 1, 'B', 'B', 'B', 2),
(2, 1, 'W', 'W', 'W', 2),
(1, 2, 'W', NULL, NULL, 0),
(2, 2, 'B', NULL, NULL, 0),
(1, 3, 'B', NULL, NULL, 0),
(2, 3, 'W', NULL, NULL, 0),
(1, 4, 'W', NULL, NULL, 0),
(2, 4, 'B', NULL, NULL, 0),
(1, 5, 'B', NULL, NULL, 0),
(2, 5, 'W', NULL, NULL, 0),
(1, 6, 'W', NULL, NULL, 0),
(2, 6, 'B', NULL, NULL, 0),
(1, 7, 'B', NULL, NULL, 0),
(2, 7, 'W', NULL, NULL, 0),
(1, 8, 'W', NULL, NULL, 0),
(2, 8, 'B', NULL, NULL, 0),
(1, 9, 'B', NULL, NULL, 0),
(2, 9, 'W', NULL, NULL, 0),
(1, 10, 'W', NULL, NULL, 0),
(2, 10, 'B', NULL, NULL, 0),
(1, 11, 'B', NULL, NULL, 0),
(2, 11, 'W', NULL, NULL, 0),
(1, 12, 'W', NULL, NULL, 0),
(2, 12, 'B', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `game_status`
--

CREATE TABLE `game_status` (
  `status` enum('not active','initialized','started','\r\nended','aborded') NOT NULL DEFAULT 'not active',
  `p_turn` enum('W','B') DEFAULT NULL,
  `result` enum('B','W','D') DEFAULT NULL,
  `last_change` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `game_status`
--

INSERT INTO `game_status` (`status`, `p_turn`, `result`, `last_change`) VALUES
('not active', NULL, NULL, '2021-01-06 12:19:34');

--
-- Δείκτες `game_status`
--
DELIMITER $$
CREATE TRIGGER `game_status_update` BEFORE UPDATE ON `game_status` FOR EACH ROW BEGIN
    	SET NEW.last_change= NOW();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `players`
--

CREATE TABLE `players` (
  `username` varchar(20) DEFAULT NULL,
  `piece_color` enum('B','W') NOT NULL,
  `token` varchar(100) DEFAULT NULL,
  `last_action` timestamp NULL DEFAULT NULL,
  `moves_played` int(11) NOT NULL DEFAULT 0,
  `sum` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `players`
--

INSERT INTO `players` (`username`, `piece_color`, `token`, `last_action`, `moves_played`, `sum`) VALUES
(NULL, 'B', NULL, NULL, 0, 0),
(NULL, 'W', NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `repository`
--

CREATE TABLE `repository` (
  `color` enum('W','B') NOT NULL,
  `pieces` int(11) NOT NULL,
  `phase` enum('start','end') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `repository`
--

INSERT INTO `repository` (`color`, `pieces`, `phase`) VALUES
('W', 13, 'start'),
('B', 13, 'start');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `board`
--
ALTER TABLE `board`
  ADD PRIMARY KEY (`y`,`x`);

--
-- Ευρετήρια για πίνακα `board_empty`
--
ALTER TABLE `board_empty`
  ADD PRIMARY KEY (`y`,`x`);

--
-- Ευρετήρια για πίνακα `game_status`
--
ALTER TABLE `game_status`
  ADD PRIMARY KEY (`status`);

--
-- Ευρετήρια για πίνακα `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`piece_color`);

--
-- Ευρετήρια για πίνακα `repository`
--
ALTER TABLE `repository`
  ADD PRIMARY KEY (`color`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
