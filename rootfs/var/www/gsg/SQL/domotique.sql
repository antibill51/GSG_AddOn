SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `domotique_granules_stock` (
  `id` int(10) UNSIGNED NOT NULL,
  `stockIni` tinyint(4) UNSIGNED NOT NULL,
  `reliquat` tinyint(4) UNSIGNED NOT NULL,
  `prixsac` float NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


ALTER TABLE `domotique_granules_stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);


ALTER TABLE `domotique_granules_stock`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

CREATE TABLE `domotique_granules_entretiens` (
  `id` int(11) NOT NULL,
  `regulier` date NOT NULL,
  `mensuel` date NOT NULL,
  `annuel` date NOT NULL,
  `info` tinyint(1) NOT NULL,
  `PushingBox` tinytext NOT NULL,
  `PushingBoxTitre1` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `PushingBoxMsg1` text NOT NULL,
  `PushingBoxTitre2` text NOT NULL,
  `PushingBoxMsg2` text NOT NULL,
  `PushingBoxTitre3` text NOT NULL,
  `PushingBoxMsg3` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


ALTER TABLE `domotique_granules_entretiens`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `domotique_granules_entretiens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

CREATE TABLE `domotique_granules_conso` (
  `id` int(10) UNSIGNED NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `value` tinyint(3) UNSIGNED NOT NULL,
  `id_stock` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


ALTER TABLE `domotique_granules_conso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);


ALTER TABLE `domotique_granules_conso`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
