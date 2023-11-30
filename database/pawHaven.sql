-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2023 at 04:39 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pawheaven`
--
CREATE DATABASE IF NOT EXISTS `pawheaven` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pawheaven`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `user` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `user`, `pass`) VALUES
(1, 'Admin', 'Admin123');

-- --------------------------------------------------------

--
-- Table structure for table `admin_address_infos`
--

CREATE TABLE `admin_address_infos` (
  `address_id` int(11) NOT NULL,
  `business_address` varchar(255) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_address_infos`
--

INSERT INTO `admin_address_infos` (`address_id`, `business_address`, `admin_id`) VALUES
(1, 'Km6 La Trinidad Benguet', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_contacts_infos`
--

CREATE TABLE `admin_contacts_infos` (
  `contacts_id` int(11) NOT NULL,
  `contacts` varchar(255) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_contacts_infos`
--

INSERT INTO `admin_contacts_infos` (`contacts_id`, `contacts`, `admin_id`) VALUES
(1, '09285025154', 1),
(2, '09688791877', 1);

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `animals_id` int(11) NOT NULL,
  `animal_name` varchar(255) NOT NULL,
  `breed` varchar(255) NOT NULL,
  `species` varchar(255) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `birthdate` date NOT NULL,
  `age` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `customer_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `animals_archive`
--

CREATE TABLE `animals_archive` (
  `animals_id` int(11) NOT NULL,
  `animal_name` varchar(255) NOT NULL,
  `breed` varchar(255) NOT NULL,
  `species` varchar(255) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `birthdate` date NOT NULL,
  `age` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `customer_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `animals_archive`
--

INSERT INTO `animals_archive` (`animals_id`, `animal_name`, `breed`, `species`, `gender`, `birthdate`, `age`, `quantity`, `customer_id`) VALUES
(0, 'Crocodiles', 'none', 'Fish', 'Male', '0000-00-00', '', 12, 'BAYRONJO');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointment_id` int(11) NOT NULL,
  `appointment_service` varchar(255) DEFAULT NULL,
  `appointment_status` varchar(255) DEFAULT NULL,
  `start_event_date` datetime DEFAULT NULL,
  `end_event_date` datetime DEFAULT NULL,
  `payment_status` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `animals_id` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `customer_id` varchar(255) DEFAULT NULL,
  `referral_no` int(11) DEFAULT NULL COMMENT 'for walk in customers',
  `appoint_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appointment_archive`
--

CREATE TABLE `appointment_archive` (
  `appointment_id` int(11) NOT NULL,
  `appointment_service` varchar(255) DEFAULT NULL,
  `appointment_status` varchar(255) DEFAULT NULL,
  `start_event_date` datetime DEFAULT NULL,
  `end_event_date` datetime DEFAULT NULL,
  `payment_status` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `animals_id` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `customer_id` varchar(255) DEFAULT NULL,
  `referral_no` int(11) DEFAULT NULL COMMENT 'for walk in customers',
  `appoint_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `MI` varchar(3) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `verify_token` varchar(191) NOT NULL,
  `verify_status` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_contact_infos`
--

CREATE TABLE `customer_contact_infos` (
  `customer_contact_id` int(11) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `customer_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_profile_infos`
--

CREATE TABLE `customer_profile_infos` (
  `customer_profile_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `customer_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `services_id` int(11) NOT NULL,
  `services_title` varchar(20) DEFAULT NULL,
  `services_description` text DEFAULT NULL,
  `services_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`services_id`, `services_title`, `services_description`, `services_image`) VALUES
(1, 'Vaccination', 'A vaccine is a biological preparation that stimulates the immune system to recognize and defend against specific pathogens, such as viruses or bacteria. It typically contains weakened or inactivated forms of the targeted microorganisms or their components. Administered through injection or oral means, vaccines prompt the immune system to produce antibodies and memory cells, providing protection against future infections. Vaccination is a crucial tool in preventing and controlling the spread of infectious diseases, contributing to public health worldwide.', 'pet-vaccine.png'),
(2, 'Treatment', 'Treatment refers to the interventions and strategies employed to alleviate, manage, or cure a medical condition, disorder, or disease. The goal of treatment is to improve a person\'s health, alleviate symptoms, and enhance their overall well-being. Treatment approaches vary widely depending on the nature and severity of the condition.\r\n\r\nMedical treatments often involve pharmaceutical interventions, such as medications or vaccines. For infectious diseases, antibiotics or antiviral medications may be prescribed, while chronic conditions like diabetes may require long-term medication management. Surgical interventions may be necessary for conditions that don\'t respond to other treatments, such as certain cancers or orthopedic issues.\r\n\r\nIn addition to conventional medical treatments, various alternative and complementary therapies exist. These may include acupuncture, chiropractic care, herbal supplements, or mindfulness practices. Mental health conditions are often addressed through psychotherapy, counseling, and psychiatric medications.\r\n\r\nThe concept of treatment extends beyond the physical realm, encompassing rehabilitation, physical therapy, occupational therapy, and lifestyle modifications. Prevention is also a crucial aspect of treatment, involving measures like vaccination, healthy lifestyle choices, and early detection screenings.\r\n\r\nUltimately, the choice of treatment depends on the specific diagnosis, individual factors, and the collaborative decision-making between patients and healthcare professionals. Regular monitoring and adjustments to the treatment plan are common to ensure its effectiveness and address any emerging issues. Overall, treatment is a dynamic and personalized approach aimed at restoring or maintaining optimal health.', 'pet-treatment.webp'),
(3, 'Consultation', 'Consultation is a process of seeking advice, guidance, or expertise from a professional or expert in a particular field. It plays a pivotal role in various contexts, including healthcare, business, legal matters, and education.\r\n\r\nIn healthcare, a medical consultation involves a patient seeking advice or diagnosis from a healthcare professional, such as a doctor or specialist. It is a crucial step in understanding and addressing health concerns, as it allows for a comprehensive evaluation of symptoms, medical history, and potential treatment options. Effective communication between the patient and healthcare provider is essential during a consultation to ensure a thorough understanding of the situation and the development of a suitable treatment plan.\r\n\r\nIn the business world, consultation often occurs when organizations seek expert advice to improve efficiency, solve problems, or implement strategic initiatives. Management consultants, for example, offer guidance on organizational structure, business processes, and overall business strategy. This collaborative approach can lead to informed decision-making and positive outcomes for the organization.\r\n\r\nLegal consultations involve individuals seeking advice from lawyers or legal experts. During these sessions, individuals discuss legal issues, receive guidance on potential courses of action, and gain an understanding of their rights and responsibilities.\r\n\r\nIn education, consultation can occur between teachers, parents, and educational specialists to address the unique needs of students, develop individualized education plans (IEPs), and ensure academic success.\r\n\r\nOverall, consultation serves as a valuable mechanism for accessing expertise, fostering collaboration, and making informed decisions across various professional domains.', 'pet-consultation.png'),
(4, 'Surgery', 'Surgery is a medical intervention involving manual or instrumental procedures to treat injuries, diseases, or abnormalities. It aims to repair, remove, or replace damaged tissue, restore normal bodily function, or alleviate symptoms. Surgical procedures can range from minor, such as stitches for wounds, to major, such as organ transplants. Surgeons utilize advanced techniques, anesthesia, and sterile environments to ensure patient safety. Preoperative assessment, precise execution of the procedure, and postoperative care are integral aspects of surgical interventions, with the ultimate goal of improving the patient\'s health and well-being.', 'pet-surgery.png'),
(5, 'Grooming', 'Grooming encompasses a range of personal care activities that individuals undertake to maintain their appearance, hygiene, and overall well-being. This multifaceted practice is not only about physical cleanliness but also involves attention to one\'s clothing, hairstyle, and general presentation. Grooming is a cultural and social phenomenon influenced by societal standards, personal preferences, and situational contexts.\r\n\r\n**1. ** Hygiene:\r\nAt its core, grooming emphasizes hygiene. Regular bathing or showering is fundamental to remove dirt, bacteria, and odors. Dental hygiene, including brushing teeth and using dental floss, contributes not only to oral health but also to overall well-being. Proper handwashing helps prevent the spread of germs and infections.\r\n\r\n**2. ** Skin Care:\r\nSkin care is a significant aspect of grooming. This includes cleansing, moisturizing, and protection from the sun. Facial care may involve shaving for men or makeup application for women. Skin care routines often vary based on skin type and individual preferences.\r\n\r\n**3. ** Hair Care:\r\nHair grooming involves washing, conditioning, and styling. Haircuts or trims contribute to a neat appearance. Hairstyles can be a form of self-expression and may vary widely, influenced by trends, cultural norms, and personal style.\r\n\r\n**4. ** Clothing and Fashion:\r\nSelecting appropriate clothing is a key component of grooming. It involves choosing outfits that align with the occasion, weather, and personal style. Fashion trends influence clothing choices, but individual expression often plays a significant role in creating a unique and personal look.\r\n\r\n**5. ** Personal Care Products:\r\nThe use of personal care products, such as deodorants, perfumes, and colognes, is common in grooming practices. These products not only enhance personal hygiene but also contribute to an individual\'s scent, which can be a subtle yet influential aspect of personal presentation.\r\n\r\n**6. ** Nail Care:\r\nNail grooming involves trimming, shaping, and cleaning the nails. Some individuals may opt for nail polish or other decorative elements. Proper nail care is not only aesthetically pleasing but also contributes to overall hygiene.\r\n\r\n**7. ** Grooming for Special Occasions:\r\nCertain occasions may call for additional or specialized grooming. This could include applying formal attire and makeup for special events, ensuring a polished appearance for professional engagements, or adhering to cultural practices for ceremonies and celebrations.\r\n\r\n**8. ** Grooming for Men:\r\nWhile grooming is universal, specific practices may differ between genders. For men, grooming often includes facial hair management, whether through shaving or maintaining a beard or mustache. Skincare routines may also differ based on individual needs.\r\n\r\n**9. ** Grooming and Mental Well-being:\r\nBeyond physical benefits, grooming has psychological and emotional implications. Taking the time to groom oneself can boost confidence, enhance mood, and contribute to a positive self-image. It is an act of self-care that extends beyond mere appearance.\r\n\r\n**10. ** Cultural and Social Influences:\r\nGrooming practices are influenced by cultural norms and societal expectations. Different cultures may place varying emphasis on specific aspects of grooming, and societal standards of beauty can shape individual behaviors and preferences.\r\n\r\nIn conclusion, grooming is a holistic practice that goes beyond mere physical appearance. It encompasses a range of activities aimed at maintaining personal hygiene, presenting oneself appropriately, and expressing individuality. From skincare routines to clothing choices, grooming is a dynamic and culturally influenced aspect of daily life that contributes to both physical and mental well-being.', 'pet-grooming.png');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `MI` varchar(3) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `position` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `verify_token` varchar(191) NOT NULL,
  `verify_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_birthdate_infos`
--

CREATE TABLE `staff_birthdate_infos` (
  `staff_birthdate_id` int(11) NOT NULL,
  `birthdate` date NOT NULL,
  `staff_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_contact_infos`
--

CREATE TABLE `staff_contact_infos` (
  `staff_contact_id` int(11) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `staff_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_profiles_infos`
--

CREATE TABLE `staff_profiles_infos` (
  `staff_profiles_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `walk_in_customers`
--

CREATE TABLE `walk_in_customers` (
  `referral_no` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `middleinitials` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contacts` varchar(11) NOT NULL,
  `animal_name` varchar(255) NOT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `breed` varchar(255) DEFAULT NULL,
  `species` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `admin_address_infos`
--
ALTER TABLE `admin_address_infos`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `admin_contacts_infos`
--
ALTER TABLE `admin_contacts_infos`
  ADD PRIMARY KEY (`contacts_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`animals_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`),
  ADD UNIQUE KEY `referal_no` (`referral_no`),
  ADD KEY `animals_id` (`animals_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `appointment_archive`
--
ALTER TABLE `appointment_archive`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `pass` (`pass`);

--
-- Indexes for table `customer_contact_infos`
--
ALTER TABLE `customer_contact_infos`
  ADD PRIMARY KEY (`customer_contact_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `customer_profile_infos`
--
ALTER TABLE `customer_profile_infos`
  ADD PRIMARY KEY (`customer_profile_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`services_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `pass` (`pass`);

--
-- Indexes for table `staff_birthdate_infos`
--
ALTER TABLE `staff_birthdate_infos`
  ADD PRIMARY KEY (`staff_birthdate_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `staff_contact_infos`
--
ALTER TABLE `staff_contact_infos`
  ADD PRIMARY KEY (`staff_contact_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `staff_profiles_infos`
--
ALTER TABLE `staff_profiles_infos`
  ADD PRIMARY KEY (`staff_profiles_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `walk_in_customers`
--
ALTER TABLE `walk_in_customers`
  ADD PRIMARY KEY (`referral_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_address_infos`
--
ALTER TABLE `admin_address_infos`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admin_contacts_infos`
--
ALTER TABLE `admin_contacts_infos`
  MODIFY `contacts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `animals_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `customer_contact_infos`
--
ALTER TABLE `customer_contact_infos`
  MODIFY `customer_contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `customer_profile_infos`
--
ALTER TABLE `customer_profile_infos`
  MODIFY `customer_profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `services_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `staff_birthdate_infos`
--
ALTER TABLE `staff_birthdate_infos`
  MODIFY `staff_birthdate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `staff_contact_infos`
--
ALTER TABLE `staff_contact_infos`
  MODIFY `staff_contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `staff_profiles_infos`
--
ALTER TABLE `staff_profiles_infos`
  MODIFY `staff_profiles_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `walk_in_customers`
--
ALTER TABLE `walk_in_customers`
  MODIFY `referral_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_address_infos`
--
ALTER TABLE `admin_address_infos`
  ADD CONSTRAINT `admin_address_infos_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`admin_id`);

--
-- Constraints for table `admin_contacts_infos`
--
ALTER TABLE `admin_contacts_infos`
  ADD CONSTRAINT `admin_contacts_infos_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`admin_id`);

--
-- Constraints for table `animals`
--
ALTER TABLE `animals`
  ADD CONSTRAINT `animals_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`animals_id`) REFERENCES `animals` (`animals_id`),
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`),
  ADD CONSTRAINT `appointment_ibfk_3` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  ADD CONSTRAINT `appointment_ibfk_4` FOREIGN KEY (`referral_no`) REFERENCES `walk_in_customers` (`referral_no`);

--
-- Constraints for table `customer_contact_infos`
--
ALTER TABLE `customer_contact_infos`
  ADD CONSTRAINT `customer_contact_infos_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);

--
-- Constraints for table `customer_profile_infos`
--
ALTER TABLE `customer_profile_infos`
  ADD CONSTRAINT `customer_profile_infos_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);

--
-- Constraints for table `staff_birthdate_infos`
--
ALTER TABLE `staff_birthdate_infos`
  ADD CONSTRAINT `staff_birthdate_infos_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`);

--
-- Constraints for table `staff_contact_infos`
--
ALTER TABLE `staff_contact_infos`
  ADD CONSTRAINT `staff_contact_infos_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`);

--
-- Constraints for table `staff_profiles_infos`
--
ALTER TABLE `staff_profiles_infos`
  ADD CONSTRAINT `staff_profiles_infos_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
