-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Listage des données de la table caissesavplus.articles : ~11 rows (environ)
INSERT INTO `articles` (`id`, `nom_article`, `prix`, `type_prix`, `nombre_par_duree`, `duree`, `categorie_id`, `created_at`, `updated_at`) VALUES
	(1, 'Stater', 10000, 'base', 1, 'mois', 3, '2024-03-19 23:04:31', NULL),
	(2, 'Standard', 15000, 'base', 1, 'mois', 3, '2024-03-19 23:06:13', NULL),
	(3, 'Personnalisee', 25000, 'base', 1, 'mois', 3, '2024-03-19 23:06:50', NULL),
	(4, 'Atelier', 50000, 'base', 1, 'jour', 2, '2024-03-19 23:07:36', NULL),
	(5, 'Certification', 65000, 'base', 1, 'jour', 2, '2024-03-19 23:08:06', NULL),
	(6, 'Formation Express', 155000, 'base', 1, 'semaine', 2, '2024-03-19 23:08:44', NULL),
	(7, 'Formation Longue', 200000, 'base', 1, 'mois', 2, '2024-03-19 23:09:07', NULL),
	(8, 'Basique', 25000, 'base', 1, 'mois', 1, '2024-03-19 23:10:03', NULL),
	(9, 'Performance', 50000, 'base', 1, 'mois', 1, '2024-03-19 23:10:31', NULL),
	(10, 'Boost', 100000, 'base', 1, 'mois', 1, '2024-03-19 23:10:55', NULL),
	(11, 'Boost +', 150000, 'base', 1, 'mois', 1, '2024-03-19 23:11:03', NULL);

-- Listage des données de la table caissesavplus.article_transactions : ~0 rows (environ)

-- Listage des données de la table caissesavplus.categories : ~2 rows (environ)
INSERT INTO `categories` (`id`, `nom`, `created_at`, `updated_at`) VALUES
	(1, 'Sites web', '2024-03-19 23:01:07', NULL),
	(2, 'Formation', '2024-03-19 23:01:28', NULL),
	(3, 'IT', '2024-03-20 00:01:31', NULL),
	(4, 'Autres', '2024-03-20 00:01:29', NULL);

-- Listage des données de la table caissesavplus.transactions : ~0 rows (environ)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
