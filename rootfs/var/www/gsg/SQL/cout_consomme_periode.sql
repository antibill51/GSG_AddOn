SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE ALGORITHM=UNDEFINED  SQL SECURITY DEFINER VIEW `cout_consomme_periode`  AS  select concat(year((`domotique_granules_conso`.`time` - interval 8 month)),'/',(year((`domotique_granules_conso`.`time` - interval 8 month)) + 1)) AS `periode`,sum(`domotique_granules_conso`.`value`) AS `totalconso`,sum(`domotique_granules_stock`.`prixsac`) AS `totalcout` from (`domotique_granules_conso` join `domotique_granules_stock` on((`domotique_granules_conso`.`id_stock` = `domotique_granules_stock`.`id`))) group by concat(year((`domotique_granules_conso`.`time` - interval 8 month)),'/',(year((`domotique_granules_conso`.`time` - interval 8 month)) + 1)) ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
