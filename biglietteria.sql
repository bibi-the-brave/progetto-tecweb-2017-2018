-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Creato il: Feb 11, 2018 alle 20:32
-- Versione del server: 10.0.33-MariaDB-0ubuntu0.16.04.1
-- Versione PHP: 7.0.25-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anfavero`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `biglietti`
--

CREATE TABLE `biglietti` (
  `id` int(11) NOT NULL,
  `utente_id` int(11) NOT NULL DEFAULT '0',
  `spettacolo_id` int(11) NOT NULL DEFAULT '0',
  `codice` char(13) NOT NULL,
  `posti` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `utilizzato` enum('si','no') NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `biglietti`
--

INSERT INTO `biglietti` (`id`, `utente_id`, `spettacolo_id`, `codice`, `posti`, `utilizzato`) VALUES
(1, 1, 1, '5a13607c335ff', 2, 'no'),
(2, 4, 1, '5a1360bd111a7', 1, 'no'),
(5, 1, 4, '5a1d9c7e5e7a1', 1, 'no'),
(41, 1, 2, '5a2fc7d7e9dda', 1, 'si'),
(47, 37, 3, '5a4e0b6354450', 2, 'no'),
(52, 1, 5, '5a4e10e775665', 2, 'no'),
(54, 1, 11, '5a4e114322bda', 4, 'si'),
(57, 42, 15, '5a7dd233e5fb5', 2, 'no'),
(58, 42, 16, '5a7dd238ed737', 3, 'no'),
(59, 42, 14, '5a7dd23e40a83', 4, 'no'),
(61, 42, 23, '5a7dd251003f1', 3, 'no'),
(62, 43, 15, '5a7dd283c5d20', 3, 'no'),
(64, 43, 17, '5a7dd28ae74f7', 3, 'no'),
(66, 43, 15, '5a7dd2e523210', 1, 'no'),
(67, 43, 18, '5a7dd2fa782ae', 1, 'no'),
(68, 43, 9, '5a7dd30feba5c', 1, 'no'),
(69, 1, 16, '5a7dd48d4d325', 1, 'no'),
(70, 1, 27, '5a7dd8708c7ad', 1, 'no'),
(71, 43, 2, '5a7dd8fb66907', 1, 'no'),
(72, 43, 11, '5a7dd9077b375', 1, 'no'),
(73, 43, 27, '5a7dd917c8823', 1, 'no'),
(74, 1, 29, '5a7ddac149061', 1, 'no'),
(75, 43, 29, '5a7ddad79f13c', 1, 'no');

--
-- Trigger `biglietti`
--
DELIMITER $$
CREATE TRIGGER `decrementa_posti` AFTER INSERT ON `biglietti` FOR EACH ROW UPDATE spettacoli
	SET spettacoli.posti_disponibili = spettacoli.posti_disponibili-NEW.posti
	WHERE spettacoli.id = NEW.spettacolo_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `incrementa_posti` AFTER DELETE ON `biglietti` FOR EACH ROW UPDATE spettacoli
	SET spettacoli.posti_disponibili = spettacoli.posti_disponibili+OLD.posti
    WHERE spettacoli.id = OLD.spettacolo_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nome` char(50) NOT NULL DEFAULT '0',
  `descrizione` longtext,
  `immagine` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `categorie`
--

INSERT INTO `categorie` (`id`, `nome`, `descrizione`, `immagine`) VALUES
(1, 'Cinema', 'Proiezioni cinematografiche', 'immagini/cinema.jpg'),
(2, 'Teatro', 'Spettacoli teatrali', 'immagini/teatro.png'),
(4, 'Musica', 'Concerti ed eventi musicali', 'immagini/musica.jpg'),
(5, 'Musei', 'Esposizioni di quadri e arte', 'immagini/musei.jpg'),
(6, 'Fiere', 'Fiere in centri fiere', 'immagini/fiere.jpg');

-- --------------------------------------------------------

--
-- Struttura della tabella `eventi`
--

CREATE TABLE `eventi` (
  `id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `nome` char(50) NOT NULL DEFAULT '0',
  `descrizione` longtext,
  `durata` time DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `eventi`
--

INSERT INTO `eventi` (`id`, `categoria_id`, `nome`, `descrizione`, `durata`) VALUES
(1, 1, 'Jurassic World 2', 'Secondo spin-off della leggendaria serie "Jurassic Park"', '02:17:00'),
(3, 6, 'Fiera del mobile', 'Fiera con esposizione e presentazione di prodotti creati artigianalmente dai migliori professionisti della regione.', '00:00:00'),
(4, 6, 'Fiera della caccia e della pesca', 'Salone delle attività  faunistiche, venatorie e della pesca.', '00:00:00'),
(6, 5, 'Esposizione di Van Gogh', 'Esposizione di quadri del celebre pittore impressionista Van Gogh', '00:00:00'),
(7, 2, 'Aida', 'Aida è una principessa etiope, catturata e fatta schiava dagli Egiziani. Ama, ricambiata, Radamès, un comandante dell\'esercito, che è a sua volta amato, ma invano, dalla figlia del faraone, la principessa  Amneris. L\'opera tratta della loro drammatica storia.', '03:20:00'),
(8, 4, 'Concerto di Madonna', 'Concerto musica della famosa cantante pop Madonna.', '03:15:00'),
(9, 1, 'Iron man 3', 'Terzo film della saga di Iron Man prodotta dalla Marvel. Questa volta Tony Stark si scontrerà  con le sue stesse armature.', '01:55:00'),
(11, 4, 'Gigi d\'Alessio tour', 'Tuor con varie tappe italiane di Gigi d\'Alessio che presenterà  il suo nuovo disco.', '03:00:00'),
(12, 2, 'La Bohème', 'Interpretazione della celebre opera di Puccini.', '03:30:00'),
(14, 1, 'Star Wars: Gli Ultimi Jedi', 'L\'attesissimo ottavo capitolo della celeberrima saga di fantascienza.', '02:30:00'),
(15, 1, 'Justice League', 'Film che narra le gesta del gruppo di supereroi creati dalla DC Comics.', '02:04:00'),
(16, 6, 'Fiera dell\'automobile d\'epoca', 'Fiera con numerose auto d\'epoca che ogni anno raduno appassionati da tutto il nord Italia.', '00:00:00'),
(17, 1, 'Cinquanta sfumature di Rosso', 'Quando un addolorato Christian Grey cerca di persuadere una cauta Ana Steele a tornare nella sua vita, lei esige un nuovo accordo in cambio di un’altra possibilità.\r\nI due iniziano così a ricostruire un rapporto basato sulla fiducia e a trovare un equilibrio, ma alcune figure misteriose provenienti dal passato di Christian accerchiano la coppia, decise ad annientare le loro speranze di un futuro insieme.', '01:30:00'),
(18, 1, 'Ore 15:17 - Attacco al treno', 'Nelle prime ore della sera del 21 agosto 2015, il mondo ha assistito stupefatto alla notizia divulgata dai media di un tentato attacco terroristico sul treno Thalys n. 9364 diretto a Parigi, sventato da tre coraggiosi giovani americani in viaggio attraverso l\'Europa.', '02:00:00'),
(20, 1, 'Il cavaliere oscuro - Il ritorno', 'Sono passati otto anni da quando Batman è svanito nella notte, trasformandosi in un istante da eroe a fuggitivo. Prendendosi la colpa della morte del procuratore Harvey Dent, il Cavaliere oscuro ha sacrificato tutto ciò per cui lui e il Commissario Gordon avevano lavorato. Per un po\' di tempo questa messa in scena ha funzionato e l\'attività criminale di Gotham City è stata schiacciata dalla legge anti-criminale di Dent. Ma tutto cambierà con l\'arrivo di un\'astuta ladra con un misterioso piano e l\'arrivo del ben più pericoloso Bane, un terrorista mascherato i cui spietati piani per Gotham costringono Bruce a uscire dal suo esilio volontario. Ma anche se indossa di nuovo il mantello e il cappuccio, Bane potrebbe rivelarsi un nemico troppo forte perfino per Batman.', '02:34:00'),
(21, 6, 'Logistica Verde', 'Il grande appuntamento della Logistica Sostenibile dove si incontrano efficienza e ambiente.\r\nUna fiera innovativa con i leader dell’Intermodalità, della Logistica industriale, dell’E-Commerce e dei servizi per una città smart. Tre giornate per: contatti face to face con le aziende espositrici; incontri, studi e analisi strategiche; campus espositivi per seminari, workshop, presentazioni, meeting.', '00:00:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `luoghi`
--

CREATE TABLE `luoghi` (
  `id` int(11) NOT NULL,
  `nome` char(50) NOT NULL,
  `indirizzo` longtext,
  `telefono` char(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `luoghi`
--

INSERT INTO `luoghi` (`id`, `nome`, `indirizzo`, `telefono`) VALUES
(1, 'The Space Cinema', 'Via Breda 11, Limena (PD)', '892 1112123'),
(2, 'Arena di Verona', 'Piazza Brá 1, Verona (VR)', '045 800 5151'),
(5, 'Centro fiere Vicenza', 'Via Oreficeria 16, Vicenza (VI)', '044 4969111'),
(6, 'Multisala MPX', 'Via Antonio Francesco Bonporti 22, Padova (PD)', '049 877 4325'),
(7, 'Musei civici agli Eremitani', 'Piazza Eremitani 8, Padova (PD)', '049 820 4551'),
(8, 'Prato della Valle', 'Piazza Prato della Valle, Padova (PD)', '049 2010080'),
(9, 'Porto Astra', 'Via Santa Maria Assunta 20, Padova (PD)', '199 3180091'),
(10, 'Teatro Verdi', 'Via Livello 32, Padova (PD)', '049 877 7011'),
(11, 'Fiera di Padova', 'Via Niccolo Tommaseo 59, Padova (PD)', '049 8401111');

-- --------------------------------------------------------

--
-- Struttura della tabella `spettacoli`
--

CREATE TABLE `spettacoli` (
  `id` int(11) NOT NULL,
  `evento_id` int(11) NOT NULL DEFAULT '0',
  `luogo_id` int(11) NOT NULL DEFAULT '0',
  `data_ora` datetime NOT NULL,
  `posti_disponibili` bigint(20) NOT NULL DEFAULT '0',
  `prezzo` decimal(7,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `spettacoli`
--

INSERT INTO `spettacoli` (`id`, `evento_id`, `luogo_id`, `data_ora`, `posti_disponibili`, `prezzo`) VALUES
(1, 1, 6, '2018-12-03 17:30:00', 100, '5.50'),
(2, 1, 9, '2018-12-03 19:30:00', 4, '5.50'),
(3, 15, 9, '2018-12-03 19:30:00', 43, '5.00'),
(4, 15, 6, '2018-03-15 22:30:00', 78, '7.50'),
(5, 7, 10, '2018-03-17 22:00:00', 300, '12.00'),
(7, 16, 11, '2018-10-03 08:00:00', 800, '5.00'),
(9, 16, 5, '2018-03-10 08:00:00', 998, '7.00'),
(11, 14, 9, '2019-01-01 11:11:00', 395, '8.00'),
(14, 17, 9, '2018-02-27 22:30:00', 146, '10.00'),
(15, 17, 6, '2018-02-27 22:00:00', 94, '8.00'),
(16, 18, 1, '2018-03-02 22:00:00', 196, '10.00'),
(17, 17, 1, '2018-03-03 22:00:00', 147, '5.00'),
(18, 18, 9, '2018-05-21 21:00:00', 249, '15.00'),
(19, 18, 9, '2018-03-03 22:30:00', 150, '5.00'),
(21, 20, 9, '2018-04-22 21:00:00', 150, '5.00'),
(22, 20, 9, '2018-03-29 23:15:00', 150, '5.00'),
(23, 3, 11, '2018-03-24 07:30:00', 3997, '0.00'),
(24, 7, 5, '2018-04-01 10:00:00', 200000, '0.00'),
(25, 3, 11, '2018-04-27 10:00:00', 200000, '0.00'),
(26, 7, 5, '2018-03-21 10:00:00', 50000, '0.00'),
(27, 21, 11, '2018-04-04 10:10:00', 1998, '2.00'),
(28, 21, 11, '2018-03-20 10:00:00', 20000, '2.00'),
(29, 14, 1, '2018-12-01 22:00:00', 57, '15.00'),
(30, 7, 2, '2018-02-20 21:00:00', 300, '35.00'),
(31, 6, 7, '2018-02-21 08:00:00', 400, '12.50'),
(32, 16, 5, '2018-03-01 07:30:00', 300, '11.00');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `id` int(11) NOT NULL,
  `username` char(50) NOT NULL,
  `luogo_id` int(11) DEFAULT NULL,
  `pass` char(50) NOT NULL,
  `nome` char(50) NOT NULL,
  `cognome` char(50) NOT NULL,
  `email` char(50) NOT NULL,
  `tipo` enum('U','O','A','L') NOT NULL DEFAULT 'U'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id`, `username`, `luogo_id`, `pass`, `nome`, `cognome`, `email`, `tipo`) VALUES
(1, 'admin', NULL, '*4ACFE3202A5FF5CF467898FC58AAB1D615029441', 'Amministratore', 'Utente1', 'admin@admin.it', 'A'),
(3, 'operatore', NULL, '*8EAB1F519FB24E2D4E796F2E6A9E0DB306701778', 'Francesco', 'Parolini', 'freppo96@gmail.com', 'O'),
(4, 'user', NULL, '*D5D9F81F5542DE067FFF5FF7A4CA4BDD322C578F', 'ciao', 'Gualtieri', 'gualtio@endri.it', 'U'),
(22, 'CentroFiereVicenza', 5, '*B14AD1539D6F551D8DA197FD784A0CED18FE7C44', 'CentroFiere', 'Vicenza', 'centrofierevicenza@esempio.it', 'L'),
(23, 'TeatroVerdi', 10, '*CEC0EFE8384B1065846C1145B273012EC0E5601C', 'TeatroVerdi', '1', 'TeatroVerdi1@esempio.it', 'L'),
(37, 'porto', 9, '*3EFBB19D861C1DC12D58F76FE82D3CBBBA85D8F7', 'porto', 'porto', 'porto@porto', 'L'),
(42, 'pippo', NULL, '*0F6188E353012D1D828CFA87047085E28AF17DD1', 'Pippo', 'Pippo', 'pippo@pippo.it', 'U'),
(43, 'pluto', NULL, '*DD13F5FCC25F5DCB9B6E3AB646E1B7B3B225BD9D', 'Pluto', 'Pluto', 'pluto@pluto.it', 'U'),
(44, 'fieraPD', 11, '*985B02DB8658A1D44A73268516AE900824314ABB', 'Andrew', 'NG', 'andrew@stanford.edu', 'L'),
(45, 'spaceCinema', 1, '*98E684C9A0FCB6BC392388A47D21DC09F9AF6C8C', 'spaceCinema', 'spaceCinema', 'spaceCinema@spaceCinema.it', 'L'),
(46, 'arena', 2, '*9FFDBF56EB43A05FD281E5A0AD57A3426E7AB9DB', 'arena', 'arena', 'arena@arena.it', 'L'),
(47, 'MPX', 6, '*87FEAFF540E5F6B10185780B0E3836429886EC8C', 'MPX', 'MPX', 'mpx@mpx.it', 'L'),
(48, 'eremitani', 7, '*349655261D3ACE86239FCCE0767303D2CBC34875', 'eremitani', 'eremitani', 'eremitani@eremitani.it', 'L'),
(49, 'prato', 8, '*782CDDD949FC2D0D582A7B5D775BAAADF802A650', 'prato', 'prato', 'prato@prato.it', 'L'),
(50, 'fieraPadova', 11, '*B9B4ADEF0512237C36E483686BE7955C8576FAF2', 'fieraPadova', 'fieraPadova', 'fieraPadova@fieraPadova.it', 'L');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `biglietti`
--
ALTER TABLE `biglietti`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codice` (`codice`),
  ADD KEY `spettacolo_id_fk` (`spettacolo_id`),
  ADD KEY `utente_id_fk` (`utente_id`);

--
-- Indici per le tabelle `categorie`
--
ALTER TABLE `categorie`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indici per le tabelle `eventi`
--
ALTER TABLE `eventi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id_fk` (`categoria_id`);

--
-- Indici per le tabelle `luoghi`
--
ALTER TABLE `luoghi`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `spettacoli`
--
ALTER TABLE `spettacoli`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evento_id_fk` (`evento_id`),
  ADD KEY `luogo_id_fk` (`luogo_id`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `fk_id_luogo` (`luogo_id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `biglietti`
--
ALTER TABLE `biglietti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT per la tabella `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT per la tabella `eventi`
--
ALTER TABLE `eventi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT per la tabella `luoghi`
--
ALTER TABLE `luoghi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT per la tabella `spettacoli`
--
ALTER TABLE `spettacoli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `biglietti`
--
ALTER TABLE `biglietti`
  ADD CONSTRAINT `spettacolo_id_fk` FOREIGN KEY (`spettacolo_id`) REFERENCES `spettacoli` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `utente_id_fk` FOREIGN KEY (`utente_id`) REFERENCES `utenti` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `eventi`
--
ALTER TABLE `eventi`
  ADD CONSTRAINT `categoria_id_fk` FOREIGN KEY (`categoria_id`) REFERENCES `categorie` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `spettacoli`
--
ALTER TABLE `spettacoli`
  ADD CONSTRAINT `evento_id_fk` FOREIGN KEY (`evento_id`) REFERENCES `eventi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `luogo_id_fk` FOREIGN KEY (`luogo_id`) REFERENCES `luoghi` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `utenti`
--
ALTER TABLE `utenti`
  ADD CONSTRAINT `fk_id_luogo` FOREIGN KEY (`luogo_id`) REFERENCES `luoghi` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
