SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `temperaturelog`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE IF NOT EXISTS `utenti` (
  `idutente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` char(30) NOT NULL,
  `cognome` char(30) NOT NULL,
  `datanascita` date NOT NULL,
  PRIMARY KEY (`idutente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `badge`
--

CREATE TABLE IF NOT EXISTS `badge` (
  `idbadge` int(11) NOT NULL AUTO_INCREMENT,
  `idutente` int(11) NOT NULL,
  `codice` char(8) NOT NULL COMMENT "codice univoco RFID",
  PRIMARY KEY (`idbadge`),
  FOREIGN KEY (`idutente`) REFERENCES utenti(`idutente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `temperature`
--

CREATE TABLE IF NOT EXISTS `temperature` (
  `idtemperatura` int(11) NOT NULL AUTO_INCREMENT,
  `idutente` int(30) NOT NULL,
  `temperatura` float NOT NULL,
  PRIMARY KEY (`idtemperatura`),
  FOREIGN KEY (`idutente`) REFERENCES utenti(`idutente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Indici per le tabelle scaricate
--

--
-- Limiti per le tabelle scaricate
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;