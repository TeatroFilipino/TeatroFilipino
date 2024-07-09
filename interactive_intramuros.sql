-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 13, 2024 at 07:40 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `interactive_intramuros`
--

-- --------------------------------------------------------

--
-- Table structure for table `accomodation`
--

CREATE TABLE `accomodation` (
  `acc_id` int(11) NOT NULL,
  `acc_type` varchar(35) NOT NULL,
  `acc_price` double NOT NULL,
  `acc_slot` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `accomodation`
--

INSERT INTO `accomodation` (`acc_id`, `acc_type`, `acc_price`, `acc_slot`) VALUES
(1, 'PACKAGE A', 350, 30),
(2, 'PACKAGE B', 390, 30),
(3, 'PACKAGE C', 390, 30),
(4, 'PACKAGE D', 490, 30),
(5, 'PACKAGE E', 600, 30),
(6, 'PACKAGE F', 600, 30);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password_hash`) VALUES
(1, 'supermarc', 'reymarc@gmail.com', '$2y$10$N/WxLZr2ko4ui2UK3j.NIeBuGPpG84fEimst5ZXOJ8RvPlGo88nzC');

-- --------------------------------------------------------

--
-- Table structure for table `booked`
--

CREATE TABLE `booked` (
  `book_id` int(11) NOT NULL,
  `book_by` varchar(50) NOT NULL,
  `book_contact` varchar(15) NOT NULL,
  `book_address` varchar(100) NOT NULL,
  `book_name` varchar(100) NOT NULL,
  `book_age` int(11) NOT NULL,
  `book_gender` varchar(15) NOT NULL,
  `book_departure` date NOT NULL,
  `dest_id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `origin_id` int(11) NOT NULL,
  `book_tracker` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `booked`
--

INSERT INTO `booked` (`book_id`, `book_by`, `book_contact`, `book_address`, `book_name`, `book_age`, `book_gender`, `book_departure`, `dest_id`, `acc_id`, `origin_id`, `book_tracker`) VALUES
(4, 'Reymarc Valenzuela', '09776202472', 'Tagalag, Valenzuela', 'Reymarc Valenzuela', 22, 'Male', '2024-02-14', 4, 4, 1, '65c2903f91d2c'),
(5, 'Jules Mae Roman', '09346689023', 'Palasan, Valenzuela', 'Juki Mae', 23, 'Female', '2024-02-22', 1, 6, 1, '65c2922703872'),
(6, 'Jules Mae Roman', '09346689023', 'Palasan, Valenzuela', 'Miriki Jose Matutina', 16, 'Male', '2024-02-22', 1, 6, 1, '65c2922703872'),
(7, 'Jules Mae Roman', '09346689023', 'Palasan, Valenzuela', 'Snowbiru Jose Dante', 18, 'Male', '2024-02-22', 1, 6, 1, '65c2922703872');

-- --------------------------------------------------------

--
-- Table structure for table `destination`
--

CREATE TABLE `destination` (
  `dest_id` int(11) NOT NULL,
  `dest_destination` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `destination`
--

INSERT INTO `destination` (`dest_id`, `dest_destination`) VALUES
(1, 'PACKAGE A'),
(2, 'PACKAGE B'),
(3, 'PACKAGE C'),
(4, 'PACKAGE D'),
(5, 'PACKAGE F'),
(6, 'Tour Guide\'s Choice');

-- --------------------------------------------------------

--
-- Table structure for table `origin`
--

CREATE TABLE `origin` (
  `origin_id` int(11) NOT NULL,
  `origin_desc` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `origin`
--

INSERT INTO `origin` (`origin_id`, `origin_desc`) VALUES
(1, 'Intramuros, Manila');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` varchar(20) NOT NULL,
  `title` varchar(50) NOT NULL,
  `image` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `image`) VALUES
('6zQRsklaYIO38cLIgYZN', 'FOODS', 'Food.png'),
('G6zDaxTTS0fV5UT4BQ46', 'CHURCH', 'Church.png'),
('h12FAnxY6JoXb51iDpda', 'PARKS', 'Parks.png'),
('hK2tgabAaK1c1FAak6UW', 'HISTORICAL SITES', 'Historical sites.png'),
('mMj2FWPRVWZPsfOsjSUL', 'MUSEUMS', 'Museum.png'),
('sRKX0vSREJbBzO07wM1H', 'TICKET BOOKING', 'Ticket booking.png');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` varchar(20) NOT NULL,
  `post_id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `rating` varchar(1) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `post_id`, `user_id`, `rating`, `title`, `description`, `date`) VALUES
('UyVbppJf7Xo5uLnuFLmc', '6zQRsklaYIO38cLIgYZN', 'lYv0lDsYarekoSGCZyBp', '1', 'Ang peke!', '', '2024-02-05'),
('J32EozaZA7fb8yq54etM', '6zQRsklaYIO38cLIgYZN', 'jtui1k35GAiKY4Euk6kj', '5', 'Perpek hooray!!', 'ang perpek ng kape nyo!', '2024-02-05'),
('50xseL08tKo6g0D3S7Pc', '6zQRsklaYIO38cLIgYZN', 'i5Dg5FL2uMuU8FeJvzoz', '5', 'SARAP NG FOODS HERE! @Ilustrado', 'Very accomodationg ang staff and ang sasarap ng foods ~ >^', '2024-02-07'),
('ZKPRLS0GBGEAlaMctf3j', 'h12FAnxY6JoXb51iDpda', 'ETzz6glmzX8iHzrcMDxR', '5', 'MALINIS', 'Ang linis ng parks nila grabe. Presko at maaliwalas tignan.', '2024-02-07'),
('sgzHAHdFEbQIrkw5hcw0', 'hK2tgabAaK1c1FAak6UW', '1xoueS8m7MhiDEEPmnRE', '4', 'FORT SANTIAGO', 'Da best maglibot dito w/ friends. Kaso mej mainit HAHAHAHAHAHAHAA', '2024-02-07'),
('1K2u2ekxy7EYBdJexBEh', '6zQRsklaYIO38cLIgYZN', 'FpHnnwEMfdCAZMIu6n9q', '5', 'BLACK SCOOP', 'SARAP!', '2024-02-07');

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE `site` (
  `site_Code` int(5) NOT NULL,
  `site_Name` varchar(80) NOT NULL,
  `site_Address` varchar(80) NOT NULL,
  `site_Class` enum('Site','Food') NOT NULL,
  `site_Category` varchar(30) NOT NULL,
  `site_Proximity` enum('Church','Museum','Site','Fine Dining','Restaurant','Fast Food','Eatery','Cafe') NOT NULL,
  `site_Desc` varchar(10000) NOT NULL,
  `S_itinerary_Code` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`site_Code`, `site_Name`, `site_Address`, `site_Class`, `site_Category`, `site_Proximity`, `site_Desc`, `S_itinerary_Code`) VALUES
(110020, 'Barbara’s Heritage Restaurant', 'Plaza San Luis Complex, Gen. Luna St.,', 'Food', 'fine dining', '', 'Barbara\'s heritage restaurant is known for its cultural music and dance performances and Spanish-inspired lunch and dinner buffets with two (2) main banquet halls; the Main Dining Hall built elegantly using adobe blocks, with a white lime finish, and the Sala Filipina made up of wood structure c. 1850.\n', 'A0001'),
(110021, 'Ilustrado', '744 Calle Real Del Palacio', 'Food', 'fine dining', '', 'Ilustrado is a family-run business with an ‘Old-Manila’ setting. One of Ilustrado’s key selling points is its Hispanic architecture fit for intimate luncheons and a memorable venue place for events. But what makes Ilustrado stand out the most is its food. Famed for many dishes such as the Paella Ilustrad and its very own Sampaguita ice cream, the restaurant has garnered loyal patrons. It is located at two-way, Cabildo Street Temporary Entrance & Exit to Ilustrado is along, Cabildo St, Intramuros, Manila, 1002\n', 'B0002'),
(110022, 'Patio de Conchita', '680 Beaterio St., Intramuros,', 'Food', 'fine dining', '', 'A quaint restaurant at 670 Beaterio St, Intramuros, Manila, 1002 Metro Manila, Patio de Conchita— takes the carenderia concept to a whole new level and is charmingly located in a Spanish house in Intramuros, Manila. Its ambiance and cheap price have made it a favorite amongst the workers and students in the area during lunchtime.', 'C0003'),
(110023, 'La Cathedral Café', 'Beaterio St 1002 Manila', 'Food', 'cafe', '', 'La Cathedral Cafe is a charming cafe located in Intramuros, Manila, with the beautiful Neo-Romanesque Manila Cathedral as its backdrop. The cafe is a great place to relax and unwind after a long day of exploring the historic city. Its is open from 8 A.M. to 9 P.M. on weekdays and from 8 A.M. to 10 P.M. on weekends and located at 636 Cabildo St, Intramuros, behind the Manila Cathedral.', 'D0004'),
(110024, 'Ciocclata Churros Café', 'G/F The Bayleaf, Muralla cor Victoria St.', 'Food', 'cafe', '', 'Large glass windows at this sunshine-filled café let you people-watch-Intramuros residents going about their day, college students walking to schools-while freshly-baked muffins and croissants sitting inside a small glass display quietly tempt you to stay for more than just a cup of coffee. Cold beverages and coffee cups sit atop tables, where college students have parked themselves. This is the scene inside Cioccolata Churros Café, located at the ground floor of the newly-opened boutique hotel, The Bayleaf Intramuros. Open from 7 a.m. to 10 p.m.', 'E0005'),
(110025, 'Belfy Café', 'Building, 1002 Sto. Tomas', 'Food', 'cafe', '', 'Aesthetically-pleasing cafés are opening left and right, in and around Metro Manila, but if you want to check out a place that’s both unique and Instagrammable, all you have to do is make your way to Intramuros and find the Belfry Café.Belfry Café is open from Tuesdays to Fridays, 9:00 a.m. to 8:00 p.m. and Saturdays and Sundays, 8:00 a.m. to 9:00 p.m. The café is closed every Monday.', 'E0005'),
(110026, 'Manila Cathedral', 'Cabildo, 132 Beaterio St', 'Site', 'church', '', 'The Mother of all Churches, Cathedrals and Basilicas of the Philippines. The Manila Cathedral-Basilica is the Premier Church of the Philippines because of all the Churches in the archipelago, it was the one chosen to become the Cathedral in 1581 when the Philippines was separated from the Archdiocese of Mexico and became a new diocese with its episcopal seat in Manila. It is the first Cathedral of the Philippines and located inside Intramuros, Manila.', 'A0001'),
(110027, 'San Agustin Church', 'General Luna St, Manila, 1002', 'Site', 'church', '', 'San Agustin Church, situated inside Intramuros walls, is the oldest church in the Philippines. The church, together with the monastery nearby, was the only structure left standing after World War II. The current structure is actually the third version of the church which survived several natural disasters through time.', 'B0002'),
(110028, 'San Fransisco Church ', 'Solana Street, Corner San Francisco', 'Site', 'church', '', 'The San Francisco Church (Spanish: Iglesia de San Francisco) is a defunct church along San Francisco and Solana Streets in the walled city of Intramuros, Manila, Philippines. The church, which used to be the center of the Franciscan missions in the Philippines, was destroyed during the Second World War. The site has been occupied by Mapúa University since the war.', 'C0003'),
(110029, 'San Nicolas Tolentino Church', 'Cabildo Street, Corner Recoletos St.', 'Site', 'church', '', 'It is a reformed branch of the Augustinian order. Recollects built their church and convent outside the walls as there were no more vacant lots in the city but with the assistance of the governor general they were given a lot along Calle Cabildo near the bastion de San Andres. The lot an imperfect triangle consisted of 12,000 varas quadras. Here they built a church and convent. Data on construction of this earlier structure is sketchy. The church suffered damage in an earthquake in 1658 but from thence on the church had apparently not experienced much damage until the early 18th century, when a sketch of it appears in the Roxas Fernandez map of 1727. But by 1781, a new church had to be built because the previous structure had been so weakened by earthquakes and was no longer safe.', 'D0004'),
(110030, 'San Ignacio Church', 'Anda St, Intramuros, Manila', 'Site', 'church', '', 'Iglesia de San Ignacio) San Ignacio church is located in the Intramuros district of Manila. The church was completed in 1899 by architect Felix Roxas, Sr. Its interiors, embellished with carvings, were designed by Isabelo Tampingco. The plans of the church and its adjacent school were kept at the Jesuit Archives in Manila, but plans did not reflect the actual construction as it was built at the former Jesuit compound.', 'E0005'),
(110031, 'Plaza Roma', 'Cabildo, 132 Beaterio St', 'Site', 'park', '', 'Plaza de Roma, also known as Plaza Roma, is one of three major public squares in Intramuros, Manila. It is bounded by Andres Soriano Avenue (formerly Calle Aduana) to the north, Cabildo Street to the east, Santo Tomas Street to the south, and General Antonio Luna Street (formerly Calle Real del Palacio) to the west. The plaza is considered to be the center of Intramuros.', 'A0001'),
(110032, 'Plazuela de Santa Isabel  ', 'HXRF+4PX, Manila, 1002 ', 'Site', 'park', '', 'The Plazuela de Santa Isabel is one of the less interesting tourist attractions in Intramuros, Manila. It was made part of the Santa Isabel College which lacked an open space characteristic of Spanish buildings. Empty lot called Sampalucan along Calle Anda joined to enlarge plazuela in the 18th century. Plazuela de Santa Isabel was restored in 1983. A monument dedicated to the non-combatant victims of the last war in the Philippines was erected in February 18, 1995 by Memorare – Manila 1945.', 'B0002'),
(110033, 'Rizal Park', 'Ermita, Manila, 1000 Metro Manila', 'Site', 'park', '', 'Rizal Park, widely known as Luneta Park is an iconic park that carries with it a rich history, as it is the location where the country’s National Hero, Dr. Jose Rizal was executed. The park was also formerly known as Bagumbayan during the Spanish Occupation in the Philippines. Rizal Park is one of the largest recreational parks in Asia. The 58-hectare park is situated at the northern part of Roxas Boulevard. It is surrounded by Taft Avenue, Padre Burgos Avenue and Kalaw Avenue. Aside from the Rizal Park, there are also nearby attractions like the National Museum, National Museum of Anthropology, Manila Ocean Park, Intramuros and a lot more.', 'C0003'),
(110034, 'Baluarte De San Diego', 'Sta. Lucia St, Manila, 1002', 'Site', 'park', '', 'Designed by the Jesuit priest and architect Antonio Sedeño and built from 1586-1587, the Fort Nstra. Sra. de Guia was a circular tower meant to defend Manila’s southern bayside boundary. In 1593, the upper portion of the tower was demolished after suffering from cracks. The rest of the structure was integrated into a new bulwark called Baluarte de San Diego.  Completed sometime between 1653 and 1663, Baluarte de San Diego is shaped like an ace of spades.  It was breached by the British forces with cannon fire in 1762, and was restored when the Spaniards returned.  The earthquake of 1863 destroyed the structure, leading to its abandonment. During the American occupation, the circular fort was buried under layers of soil which eventually saved it from destruction during the Battle of Manila in 1945 despite the damage sustained by the baluarte containing it.The circular fort was excavated in 1979 and the baluarte was restored by 1992. A garden was added at its base and the first stone fort in Manila is now an archeological park. The garden area – which was once the site of a foundry and soldier’s barracks – is today rented out for private functions.  ', 'D0004'),
(110035, 'Puerta Real Gardens', 'HXPG+8WH, Manila, 1002 ', 'Site', 'park', '', 'These small but lovely gardens are laid out by the remnants of the defensive moat that used to surround Intramuros. From here you catch a glimpse of Puerta Real, the royal gate that was reserved for stately processions, and a section of Intramuros\' moss-covered walls. With their highly evocative atmosphere, Puerta Real Gardens provide a fitting venue for Intramuros Evenings, a series of cultural shows staged annually under the management of the Intramuros Administration.', 'E0005'),
(110036, 'Fort Santiago', 'HXVC+M5V, Intramuros, Manila, 1002', 'Site', 'historical', '', 'Fort Santiago is the oldest Spanish bastion in the Philippines. Situated inside the walled city of Intramuros in Manila, the site witnessed many historical events of the Philippines.It can be visited anytime but it’s best to go during dry season. Fort Santiago is open daily from 8 a.m. to 11 p.m.', 'A0001'),
(110037, 'Former Site Of UST', '655, Intramuros, Manila, 1002, Metro Manila', 'Site', 'historical', '', 'The University of Santo Tomas is one of the oldest existing universities and holds the oldest extant university charter in the Philippines and in Asia. It was founded on April 28, 1611, by the third Archbishop of Manila, Miguel de Benavides, together with Frs. Domingo de Nieva and Bernardo de Santa Catalina. It was originally conceived as a school to prepare young men for the priesthood. Located Intramuros, it was first called Colegio de Nuestra Señora del Santísimo Rosario and later renamed Colegio de Santo Tomás in memory of Dominican theologian Saint Thomas Aquinas. In 1624, the Colegio was authorized to confer academic degrees in theology, philosophy and arts and now located at Espanya, Manila', 'B0002'),
(110038, 'Former Site Of Ateneo', '672, Intramuros, Manila, 1002, Metro ManilaHXQG+V52 Plaza San Luiz Complex, Gene', 'Site', 'historical', '', 'Here once stood the Ateneo de Manila. Founded in 1817 as Escuela Pia de Manila. Administered by government in 1831 and renamed Escuela Municipak de Manila. Turned over to the Jesuits in 1859. Renamed Ateneo Municipak de Manila in 1865. Exclusive ownership given to Jesuits in 1901. Named shortened to Ateneo de Manila. Gutted by fire in 1932. Grade school rebuilt in Intramuros while rest of the campus moved to Ermita, Manila. Destroyed during World War II. Moved to Loyola Heights, Quezon City in 1952.', 'C0003'),
(110039, 'Casa Manila', 'HXQG+V52 Plaza San Luiz Complex, General Luna St.', 'Site', 'historical', '', 'The Casa Manila or “Manila House” is a living museum that features the lifestyle of an affluent Filipino family during the late Spanish colonial period. The façade of Casa Manila was patterned after a house that once stood at Jaboneros Street in the Chinese district of Binondo in the 1850’s. The interior decor of the house follows the taste of the turn of the late 19th century where furniture and furnishings were sourced from Europe and China. Painted walls, crystal chandeliers, carved traceries, Chinese ceramics and gilded furniture shows the elegance and luxury of a 19th century Manila house. The operation time of the site is from 9:00AM to 6:00PM', 'D0004'),
(110040, 'La Intendencia', 'HXVF+HRX, Magallanes St, Intramuros,', 'Site', 'historical', '', 'The Aduana or also known as La Intendecia building is one of the most memorable and historical structures in the Philippines; it was the seat of government and political power when the Philippines was a component realm of the Spanish Empire. Spanish colonial structure in Manila, Philippines, that housed several government offices through the years. It is located in front of the BPI Intramuros (formerly the site of the old Santo Domingo Church) at Plaza España, Soriano (Aduana) Ave. corner Muralla St. in Intramuros.', 'E0005'),
(110041, 'Museo De Intramuros', 'HXQF+X98, Corner Arzobispo, Anda St', 'Site', 'museum', '', 'The Museo de Intramuros comprises two important reconstructions: the San Ignacio Church and the Mission House of the Society of Jesus. As the name denotes, the complex now houses the vast ecclesiastical collection of the Intramuros Administration.the Museo de Intramuros is a museum for the Philippine art of religious pieces. The country is the only Christian nation in Asia since it was introduced in 1565 by Spain.', 'A0001'),
(110042, 'Museo Filipino', '6th Floor, JS Contractor Building, 423 Magallanes St', 'Site', 'museum', '', 'Museo Filipino is a historical museum gallery in Intramuros, Manila (just behind Manila Cathedral) that gives tourists a birds-eye view (30-minute crash course) on Philippine history. Using illustrations procured from the early 19th century, pictures from the US Library of Congress, and other sources, Museo Filipino narrates Philippine history from the pre-colonial period until the present-day administration. It is a good jump off point in Intramuros because it also highlights the owners\' favorite places of interest in Intramuros, such as the Memorare, the gardens, the wall, the monuments of Queen Isabella and King Philip of Spain, etc. Entrance fees (with complimentary freshly-brewed coffee): Students - P80.00 Residents - P100.00 Non-residents - P200.00', 'B0002'),
(110043, 'Rizal Shrine at Fort Santiago', 'HXVC+M5V, Intramuros, Manila, 1002', 'Site', 'museum', '', 'This brick barracks, which was first built in the 16th century, has been in a ruined state since its destruction during the Battle of Manila in 1945. Here Jose Rizal was imprisoned for 56 days, from November 3 to December 29, 1896. The entire right wing of this building which contained his prison cell was reconstructed in 1953 as a museum and as a shrine dedicated to Jose Rizal. It was renovated in 1998 for the Philippine Independence Centennial, and subsequently modernized in 2014.', 'C0003'),
(110044, 'National Museum of Anthropology', 'HXPJ+3C6, P. Burgos Drive Rizal Park, Teodoro F. Valencia Cir, Ermita, Manila,', 'Site', 'museum', '', 'The National Museum of Anthropology stages the Philippine ethnographic and terrestrial and underwater archaeological collections narrating the story of the Philippines from the past, as presented through artifacts as evidences of its pre-history.the building is staging the Philippine ethnographic and terrestrial and underwater archaeological collections narrating the story of the Philippines from the past, as presented through artifacts as evidences of its pre-history and is now called the National Museum of Anthropology.', 'D0004'),
(110045, 'National Museum of Natural Science', 'Teodoro F. Valencia Cir, Ermita, Manila, 1000 Metro Manila', 'Site', 'museum', '', 'The National Museum of Natural History houses 12 permanent galleries that exhibit the rich biological and geological diversity of the Philippines. It includes creatively curated displays of botanical, zoological, and geological specimens that represent our unique natural history. Situated at the center of the museum is a “Tree of Life” structure that proudly connects all the unique ecosystems in the Philippines, from our magnificent mountain ridges to the outstanding marine reefs.', 'E0005'),
(110046, 'National Museum of Fine Arts', 'Padre Burgos Ave, Ermita, Manila, 1000 Metro Manila', 'Site', 'museum', '', 'The National Museum of Fine Arts is home to 29 galleries and hallway exhibitions comprising of 19th century Filipino masters, National Artists, leading modern painters, sculptors, and printmakers. Also on view are art loans from other government institutions, organizations, and individuals. National Museum of Fine Arts, is a home to 29 galleries and hallway exhibitions comprising of 19th century Filipino masters, National Artists, leading modern painters, sculptors, and printmakers. Also on view are art loans from other government institutions, organizations, and individuals.', 'A0001'),
(110053, 'La Sams', 'Palasan, Valenzuela', 'Site', 'Cafe', '', '', 'A0001');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `stat_id` int(11) NOT NULL,
  `stat_desc` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`stat_id`, `stat_desc`) VALUES
(1, 'Paid'),
(2, 'Refunded');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `trans_id` int(11) NOT NULL,
  `trans_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `trans_payment` double NOT NULL,
  `trans_passenger` varchar(100) NOT NULL,
  `trans_age` int(11) NOT NULL,
  `trans_gender` varchar(15) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `origin_id` int(11) NOT NULL,
  `dest_id` int(11) NOT NULL,
  `stat_id` int(11) DEFAULT 1,
  `trans_refunded` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`trans_id`, `trans_time`, `trans_payment`, `trans_passenger`, `trans_age`, `trans_gender`, `acc_id`, `origin_id`, `dest_id`, `stat_id`, `trans_refunded`) VALUES
(3, '2024-02-04 19:07:38', 390, 'Maven Brences', 15, 'Male', 3, 1, 1, 1, 0),
(4, '2024-02-04 19:08:43', 390, 'dsada', 12, 'Male', 3, 1, 1, 1, 0),
(5, '2024-02-07 08:27:15', 350, 'Gene Legaspi', 23, 'Male', 1, 1, 1, 1, 0),
(6, '2024-02-07 08:27:15', 350, 'Adi Bernardo', 20, 'Male', 1, 1, 1, 1, 0),
(7, '2024-02-13 10:03:12', 350, 'rey val', 21, 'Male', 1, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_account` varchar(50) NOT NULL,
  `user_password` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_account`, `user_password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'admin2', 'c84258e9c39059a89ab77d846ddab909');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`) VALUES
('jtui1k35GAiKY4Euk6kj', 'Reymarc Valenzuela', 'marcvalenzuela0123@gmail.com', '$2y$10$pCEW9hlv9tabmSm7ATVTDuiPprv/iFEB4JqAFeJbM43cRTY3Bgudq', '3amXYLYLejQnnNw03ePC.jpg'),
('lYv0lDsYarekoSGCZyBp', 'Gene Legaspi', 'geneadrianlegaspi@gmail.com', '$2y$10$T06xZGlM4dFmiZN0dwpy1ORwkbhbCYOJroQ.qq3Xrh4ybLAi.4BvC', 'dEsOFxSLFFBqEF2hCYEh.jpg'),
('i5Dg5FL2uMuU8FeJvzoz', 'Maven Brences', 'maven@gmail.com', '$2y$10$ciQ0uyh11gZdinXlSnSlrOfYPwcWucHwCTWheQh2JiwcNfxWUyB4q', ''),
('ETzz6glmzX8iHzrcMDxR', 'Genesis Legaspi', 'genesis@gmail.com', '$2y$10$2puT5YkhxPey1S0PNGCpNOfHjoXqc8RbZg/pNdWkhYLqcTzyjyHpi', ''),
('1xoueS8m7MhiDEEPmnRE', 'Adi Bernardo', 'adi@gmail.com', '$2y$10$iI3ArkqbG3JD6OpoRdKVd./KBO7hb9lAjoDAdfufnfwx4no.GJ9qC', ''),
('FpHnnwEMfdCAZMIu6n9q', 'Miki', 'miki@gmail.com', '$2y$10$.PId3iYpckrl1QGFXr3uoOo0lTiqbNQ9c40hHkAxqzpmjjWVsiftW', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accomodation`
--
ALTER TABLE `accomodation`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booked`
--
ALTER TABLE `booked`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `dest_id` (`dest_id`,`acc_id`),
  ADD KEY `acc_id` (`acc_id`),
  ADD KEY `origin_id` (`origin_id`);

--
-- Indexes for table `destination`
--
ALTER TABLE `destination`
  ADD PRIMARY KEY (`dest_id`);

--
-- Indexes for table `origin`
--
ALTER TABLE `origin`
  ADD PRIMARY KEY (`origin_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`site_Code`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`stat_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`trans_id`),
  ADD KEY `acc_id` (`acc_id`,`origin_id`,`dest_id`,`stat_id`),
  ADD KEY `origin_id` (`origin_id`),
  ADD KEY `dest_id` (`dest_id`),
  ADD KEY `stat_id` (`stat_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accomodation`
--
ALTER TABLE `accomodation`
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booked`
--
ALTER TABLE `booked`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `origin`
--
ALTER TABLE `origin`
  MODIFY `origin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `site`
--
ALTER TABLE `site`
  MODIFY `site_Code` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110054;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `stat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booked`
--
ALTER TABLE `booked`
  ADD CONSTRAINT `booked_ibfk_1` FOREIGN KEY (`dest_id`) REFERENCES `destination` (`dest_id`),
  ADD CONSTRAINT `booked_ibfk_2` FOREIGN KEY (`acc_id`) REFERENCES `accomodation` (`acc_id`),
  ADD CONSTRAINT `booked_ibfk_3` FOREIGN KEY (`origin_id`) REFERENCES `origin` (`origin_id`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`acc_id`) REFERENCES `accomodation` (`acc_id`),
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`origin_id`) REFERENCES `origin` (`origin_id`),
  ADD CONSTRAINT `transaction_ibfk_3` FOREIGN KEY (`dest_id`) REFERENCES `destination` (`dest_id`),
  ADD CONSTRAINT `transaction_ibfk_4` FOREIGN KEY (`stat_id`) REFERENCES `status` (`stat_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
