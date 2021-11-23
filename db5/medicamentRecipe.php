<?php

class medicamentRecipe extends Model
{
    private int $medicamentId;
    private int $recipeId;

    public function __construct($medicamentId, $recipeId, $pdo)
    {
        $this->medicamentId = $medicamentId;
        $this->recipeId = $recipeId;
        $this->class = "medicamentRecipe";
        parent::__construct(0, $pdo);
    }
    public static function create($medicamentId, $recipeId, $pdo)
    {
        $pdo->query("INSERT medicamentRecipe(medicamentId, recipeId) VALUES ('$medicamentId', '$recipeId')");
        return new medicamentRecipe($medicamentId, $recipeId, $pdo);
    }
    public static function getAll(PDO $pdo)
    {
        $res = $pdo->query("SELECT * FROM medicamentRecipe");
        $all = array();
        foreach ($res as $row) {
            $all[] = new MedicamentRecipe(
                $row['medicamentId'],
                $row['recipeId'],
                $pdo
            );
        }
        return $all;
    }
    public function getMedicamentId(): int
    {
        return $this->medicamentId;
    }
    public function getRecipeId(): int
    {
        return $this->recipeId;
    }
}
