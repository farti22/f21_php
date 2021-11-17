--
-- Task 1
--
SELECT COUNT(*)
FROM `inspection`
WHERE date = '2021-10-21';
--
-- Task 2
--
SELECT COUNT(*)
FROM `inspection`
WHERE diagnosis LIKE 'J04.0';
--
-- Task 3
--
SELECT sideEffects
FROM `medicament`
WHERE title = 'Азитромивел';
--
-- Task 4
--
INSERT INTO `medicament`(`title`, `description`, `sideEffects`)
VALUES (
        'Любое название',
        'Описание',
        'Какие-либо побочные эффекты'
    )