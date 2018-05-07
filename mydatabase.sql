-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 07 May 2018, 18:27:46
-- Sunucu sürümü: 10.1.31-MariaDB
-- PHP Sürümü: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `mydatabase`
--

DELIMITER $$
--
-- Yordamlar
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `completed` (IN `x` VARCHAR(255))  READS SQL DATA
BEGIN
SET @isnum = (SELECT x REGEXP '^[0-9]+$');
IF (@isnum=1) THEN

SELECT id i FROM project
INNER JOIN (SELECT DISTINCT project_id FROM projectmanager_project WHERE project_manager_id = CAST(x AS UNSIGNED)) t ON t.project_id = id WHERE EXISTS (SELECT * FROM task WHERE project_id = i) AND NOT EXISTS (SELECT * FROM task WHERE project_id = i AND date > NOW());

ELSEIF (x="ALL") THEN

SELECT id i FROM project WHERE EXISTS (SELECT * FROM task WHERE project_id = i) AND NOT EXISTS (SELECT * FROM task WHERE project_id = i AND date > NOW());

END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `incomplete` (IN `x` VARCHAR(255))  READS SQL DATA
BEGIN
SET @isnum = (SELECT x REGEXP '^[0-9]+$');
IF (@isnum=1) THEN

SELECT id i FROM project
INNER JOIN (SELECT DISTINCT project_id FROM projectmanager_project WHERE project_manager_id = CAST(x AS UNSIGNED)) t ON t.project_id = id WHERE EXISTS (SELECT * FROM task WHERE project_id = i) AND EXISTS (SELECT * FROM task WHERE project_id = i AND date > NOW());

ELSEIF (x="ALL") THEN

SELECT id i FROM project WHERE EXISTS (SELECT * FROM task WHERE project_id = i) AND EXISTS (SELECT * FROM task WHERE project_id = i AND date > NOW());

END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin5;

--
-- Tablo döküm verisi `admin`
--

INSERT INTO `admin` (`id`, `username`) VALUES
(1, 'admin');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin5;

--
-- Tablo döküm verisi `employee`
--

INSERT INTO `employee` (`id`, `name`) VALUES
(1, 'mustafa'),
(2, 'serkan'),
(3, 'özlem'),
(4, 'adem');

--
-- Tetikleyiciler `employee`
--
DELIMITER $$
CREATE TRIGGER `autounassign` AFTER DELETE ON `employee` FOR EACH ROW DELETE FROM employee_task WHERE employee_id = OLD.id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `employee_task`
--

CREATE TABLE `employee_task` (
  `employee_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin5;

--
-- Tablo döküm verisi `employee_task`
--

INSERT INTO `employee_task` (`employee_id`, `task_id`) VALUES
(1, 1),
(2, 3),
(2, 4),
(3, 5),
(4, 5);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `estimated_total_work_days` int(11) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin5;

--
-- Tablo döküm verisi `project`
--

INSERT INTO `project` (`id`, `name`, `start_date`, `estimated_total_work_days`, `area`, `status`) VALUES
(2, 'cmpe260project', '2018-04-30', 3, 'schemeprogramminglanguage', 'finished'),
(3, 'cmpe352twitterapi', '2018-05-08', 4, 'nodejs', 'will done'),
(11, 'cmpe321project', '2018-05-01', 10, 'database', 'finished');

--
-- Tetikleyiciler `project`
--
DELIMITER $$
CREATE TRIGGER `autoassign` AFTER INSERT ON `project` FOR EACH ROW BEGIN 
IF EXISTS (SELECT * FROM projectmanager) THEN
IF EXISTS( SELECT id FROM projectmanager WHERE id NOT IN (SELECT project_manager_id FROM projectmanager_project)) THEN
SET @id = (SELECT id FROM projectmanager WHERE id NOT IN (SELECT project_manager_id FROM projectmanager_project) LIMIT 1);
INSERT INTO projectmanager_project (project_manager_id,project_id) 
VALUES (@id,NEW.id);
ELSE
SET @id2 = (SELECT id FROM projectmanager,projectmanager_project WHERE id=project_manager_id GROUP BY id ORDER BY COUNT(id) LIMIT 1);
INSERT INTO projectmanager_project (project_manager_id,project_id) VALUES (@id2,NEW.id);
END IF;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `projectmanager`
--

CREATE TABLE `projectmanager` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin5;

--
-- Tablo döküm verisi `projectmanager`
--

INSERT INTO `projectmanager` (`id`, `username`) VALUES
(1, 'projectmanager1'),
(2, 'projectmanager2'),
(3, 'projectmanager3');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `projectmanager_project`
--

CREATE TABLE `projectmanager_project` (
  `project_manager_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin5;

--
-- Tablo döküm verisi `projectmanager_project`
--

INSERT INTO `projectmanager_project` (`project_manager_id`, `project_id`) VALUES
(2, 2),
(3, 3),
(1, 11);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `days` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin5;

--
-- Tablo döküm verisi `task`
--

INSERT INTO `task` (`id`, `name`, `date`, `days`, `project_id`) VALUES
(1, 'startproject', '2018-05-08', 3, 3),
(2, 'finalizeproject', '2018-05-12', 1, 3),
(3, 'submitproject', '2018-05-15', 1, 2),
(4, 'submitproject', '2018-05-07', 1, 11),
(5, 'gradeproject', '2018-05-31', 1, 11);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `employee_task`
--
ALTER TABLE `employee_task`
  ADD PRIMARY KEY (`task_id`,`employee_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Tablo için indeksler `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `projectmanager`
--
ALTER TABLE `projectmanager`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `projectmanager_project`
--
ALTER TABLE `projectmanager_project`
  ADD PRIMARY KEY (`project_id`,`project_manager_id`),
  ADD KEY `project_manager_id` (`project_manager_id`);

--
-- Tablo için indeksler `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_ibfk_1` (`project_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tablo için AUTO_INCREMENT değeri `projectmanager`
--
ALTER TABLE `projectmanager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `employee_task`
--
ALTER TABLE `employee_task`
  ADD CONSTRAINT `employee_task_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_task_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `projectmanager_project`
--
ALTER TABLE `projectmanager_project`
  ADD CONSTRAINT `projectmanager_project_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `projectmanager_project_ibfk_2` FOREIGN KEY (`project_manager_id`) REFERENCES `projectmanager` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
