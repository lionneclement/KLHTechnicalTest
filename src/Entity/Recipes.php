<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RecipesRepository;
use Doctrine\ORM\Mapping as ORM;
Use App\Controller\Recipes\CreateRecipesController;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ApiResource(
 *      normalizationContext={"groups"={"readRecipes"}},
 *      denormalizationContext={"groups"={"writeRecipes"}},
 *      collectionOperations={
 *          "get"={
 *              "security"="is_granted('ROLE_ADMIN') or is_granted('my_recipes', object)"
 *          },
 *          "post"={
 *              "controller"=CreateRecipesController::class,
 *          }
 *      },
 *      itemOperations={
 *          "get"={"security"="is_granted('ROLE_ADMIN') or object.getUser() == user"},
 *          "delete"={"security"="is_granted('ROLE_ADMIN') or object.getUser() == user"},
 *          "put"={"security"="is_granted('ROLE_ADMIN') or object.getUser() == user"},
 *          "patch"={"security"="is_granted('ROLE_ADMIN') or object.getUser() == user"}
 *      }  
 * )
 * @ApiFilter(SearchFilter::class, properties={"user": "exact"})
 * @ORM\Entity(repositoryClass=RecipesRepository::class)
 */
class Recipes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Groups("readRecipes")
     * @Groups("writeRecipes")
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups("readRecipes")
     * @Groups("writeRecipes")
     */
    private $description;

    /**
     * @ORM\Column(type="array")
     * @Groups("readRecipes")
     * @Groups("writeRecipes")
     */
    private $ingredients = [];

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="recipes")
     * @Groups("readRecipes")
     * @Groups("writeRecipes")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIngredients(): ?array
    {
        return $this->ingredients;
    }

    public function setIngredients(array $ingredients): self
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
