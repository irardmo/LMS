CREATE TABLE `schedules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher` varchar(255) NOT NULL,
  `room` varchar(255) NOT NULL,
  `day` varchar(255) NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `year` varchar(255) NOT NULL,
  `block` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `lec` INT DEFAULT NULL,
  `lab` INT DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `admin_load` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher` varchar(255) NOT NULL,
  `office` varchar(255) NOT NULL,
  `load` varchar(255) NOT NULL,
  `day` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `hours` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `employee_number` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `evaluation_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `category` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `evaluation_questions` (`question`, `category`) VALUES
('Taught without reading notes.', 'Mastery of the subject matter:'),
('Provide examples to illustrate difficult terms or concept.', 'Mastery of the subject matter:'),
('Gave accurate answers to student''s questions.', 'Mastery of the subject matter:'),
('Related the topic to real-life situations.', 'Mastery of the subject matter:'),
('Related the subject matter to other fields.', 'Mastery of the subject matter:'),
('The day''s lesson was drawn from the curriculum guide/syllabus.', 'Mastery of the subject matter:'),
('Used correct grammar in speaking (English or Tagalog).', 'Communication Skills:'),
('Maintained eye contact with the students.', 'Communication Skills:'),
('Considered and used students'' ideas and suggestions.', 'Communication Skills:'),
('Asking probing questions.', 'Communication Skills:'),
('Spoke in a voice that is clear and loud enough to be heard by everyone.', 'Communication Skills:'),
('Seating arrangement was in accordance with the seat plan.', 'Classroom Management:'),
('Orderliness and cleanliness of the classroom was maintained.', 'Classroom Management:'),
('Discipline was observed among the students.', 'Classroom Management:'),
('Instructional materials were in placed.', 'Classroom Management:'),
('The over-all atmosphere of the classroom is conducive to learning.', 'Classroom Management:');

CREATE TABLE `evaluations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_name` varchar(255) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `evaluation_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;