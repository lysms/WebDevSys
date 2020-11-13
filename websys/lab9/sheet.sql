
-- -- 1. Add address fields (street, city, state, zip) to the students table
-- ALTER TABLE `students` ADD `street` VARCHAR(255) NOT NULL AFTER `phone`, ADD `city` VARCHAR(255) NOT NULL AFTER `street`, ADD `state` VARCHAR(255) NOT NULL AFTER `city`, ADD `zip` INT(5) NOT NULL AFTER `state`;

-- -- 2. Add section and year fields to the courses table
-- ALTER TABLE `courses` ADD `section` VARCHAR(255) NOT NULL AFTER `title`, ADD `year` INT(10) NOT NULL AFTER `section`;

-- 3. CREATE a grades table containing id (int primary key, auto increment), crn (foreign key), RIN (foreign key), and grade (int 3 not null)
-- CREATE TABLE `grades` (
--   `id` int(11) NOT NULL,
--   `crn` int(11) NOT NULL,
--   `RIN` int(9) NOT NULL,
--   `grade` int(3) NOT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 4. INSERT at least 4 courses into the courses table
INSERT INTO `courses` (`crn`, `prefix`, `number`, `title`, `section`, `year`) VALUES
(40375, 'CSCI', 1100, 'Computer Science 1', 4, 'S21'),
(40380, 'CSCI', 1200, 'Data Structures', 4, 'S21'),
(43694, 'ITWS', 1100, 'Intro To IT & Web Science', 1, 'S21'),
(44051, 'ITWS', 4310, 'Managing IT Resources', 1, 'S21');

-- 5. INSERT at least 4 students into the students table
INSERT INTO `students` (`RIN`, `RCSID`, `first name`, `last name`, `alias`, `phone`, `street`, `city`, `state`, `zip`) VALUES
(661924000, 'smithj1', 'John', 'Smith', 'Jonny', 2016967777, '2122 Burdett Ave', 'Troy', 'New York', 12180),
(661949001, 'axep23', 'Peter', 'Axe', 'Peter', 2124443679, '1761 15th St', 'Troy', 'New York', 12180),
(661931234, 'goldbj', 'Jane', 'Goldberg', 'Jane', 8417852089, '112 Tenafly Rd', 'Tenafly', 'New Jersey', 07670),
(661932903, 'pommew', 'William', 'Pommel', 'Billy', 2816781293, '20 W 34th St', 'New York', 'New York', 10001);

-- 6. ADD 10 grades into the grades table
INSERT INTO `grades` (`id`, `crn`, `RIN`, `grade`) VALUES
(1, 40375, 661924000, 80),
(2, 40375, 661949001, 90),
(3, 40375, 661931234, 95),
(4, 40380, 661924000, 87),
(5, 40380, 661949001, 92),
(6, 40380, 661931234, 71),
(7, 43694, 661931234, 67),
(8, 43694, 661949001, 80),
(9, 43694, 661924000, 92),
(10, 44051, 661931234, 91);
-- 7. List all students in the following sequences; in lexicographical order by RIN, last name, RCSID, and first name. Remember that lexicographical order is determined by your collation.
SELECT * FROM `students` ORDER BY `RIN`, `last name`, `RCSID`, `first name`;

-- 8. List all students RIN, name, and address if their grade in any course was higher than a 90
SELECT 
    s.RIN, 
    CONCAT(s.`first name`,' ', s.`last name`) as name, 
    CONCAT(s.street, ', ', s.city, ', ', s.state, ', ', s.zip) as address
FROM 
    `grades` g
    INNER JOIN `students` s
    ON g.RIN = s.RIN 
WHERE 
    grade > 90;

-- 9. List out the average grade in each course
SELECT
    c.crn,
    AVG(g.grade) as avg_grade 
FROM 
    `grades` g 
    INNER JOIN `courses` c
    ON g.crn = c.crn
GROUP BY
    c.crn; 

-- 10. List out the number of students in each course
SELECT
    g.crn,
    COUNT(*) as num_students 
FROM 
    `grades` g
    INNER JOIN `students` s
    ON g.RIN = s.RIN 
GROUP BY
    g.crn; 
