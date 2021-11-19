--
-- Task 1
--
-- [Sub SELECT]
SELECT *
FROM medicament
WHERE id IN (
    SELECT medicamentId
    FROM medicamentRecipe
    WHERE recipeId IN (
        SELECT id
        FROM recipe
        WHERE inspectionId IN (
            SELECT id
            FROM inspection
            WHERE patientId = 2
          )
      )
  );
-- [JOIN]
SELECT *
FROM medicament
  JOIN medicamentRecipe ON medicament.id = medicamentRecipe.medicamentId
  JOIN recipe ON medicamentRecipe.recipeId = recipe.id
  JOIN inspection ON recipe.inspectionId = inspection.id
WHERE inspection.patientId = 2;
--
-- Task 2
--
-- [Sub SELECT]
SELECT *
FROM patient
WHERE id IN (
    SELECT patientId
    FROM inspection
    WHERE id IN (
        SELECT inspectionId
        FROM recipe
        WHERE id IN (
            SELECT recipeId
            FROM medicamentRecipe
            WHERE medicamentId = 2
          )
      )
  );
-- [JOIN]
SELECT *
FROM patient
  JOIN inspection ON patient.id = inspection.patientId
  JOIN recipe ON inspection.id = recipe.inspectionId
  JOIN medicamentRecipe ON recipe.id = medicamentRecipe.recipeId
WHERE medicamentRecipe.medicamentId = 2;
--
-- Task 3
--
-- [Sub SELECT]
SELECT *
FROM patient
WHERE id IN (
    SELECT patientId
    FROM inspection
    WHERE id IN (
        SELECT inspectionId
        FROM recipe
        WHERE id IN (
            SELECT recipeId
            FROM medicamentRecipe
            WHERE medicamentId IN (
                SELECT id
                FROM medicament
                WHERE title LIKE '%название%'
              )
          )
      )
  );
-- [JOIN]
SELECT *
FROM patient
  JOIN inspection ON patient.id = inspection.patientId
  JOIN recipe ON inspection.id = recipe.inspectionId
  JOIN medicamentRecipe ON recipe.id = medicamentRecipe.recipeId
  JOIN medicament ON medicamentRecipe.medicamentId = medicament.id
WHERE medicament.title LIKE '%название%';
--
-- Task 4
--
-- [Sub SELECT]
SELECT *
FROM medicament
WHERE id IN (
    SELECT medicamentId
    FROM medicamentRecipe
    WHERE recipeId IN (
        SELECT id
        FROM recipe
        WHERE inspectionId = 2
      )
  );
-- [JOIN]
SELECT *
FROM medicament
  JOIN medicamentRecipe ON medicament.id = medicamentRecipe.medicamentId
  JOIN recipe ON medicamentRecipe.recipeId = recipe.id
WHERE recipe.inspectionId = 2;
--
-- Task 5
--
-- [Sub SELECT]
SELECT *
FROM recipe
WHERE inspectionId IN (
    SELECT id
    FROM inspection
    WHERE doctorId IN (
        SELECT id
        FROM doctor
        WHERE name LIKE '%Мархаток%'
      )
  );
-- [JOIN]
SELECT *
FROM recipe
  JOIN inspection ON recipe.inspectionId = inspection.id
  JOIN doctor ON inspection.doctorId = doctor.id
WHERE doctor.name LIKE '%Мархаток%';
--
-- Task 6
--
-- [Sub SELECT]
SELECT *
FROM doctor
WHERE id IN (
    SELECT doctorId
    FROM inspection
    WHERE patientId IN (
        SELECT id
        FROM patient
        WHERE name LIKE '%Былинский%'
      )
  );
-- [JOIN]
SELECT *
FROM doctor
  JOIN inspection ON doctor.id = inspection.doctorId
  JOIN patient ON inspection.patientId = patient.id
WHERE patient.name LIKE '%Былинский%';