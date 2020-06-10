<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RecipesRepository;
use Doctrine\ORM\Mapping as ORM;
Use App\Controller\Recipes\CreateRecipesController;

/**
 * @ApiResource(
 *      collectionOperations={
 *          "get",
 *          "post"={
 *              "controller"=CreateRecipesController::class,
 *          }
 *      },
 *      itemOperations={
 *          "get",
 *          "delete",
 *          "put",
 *          "patch"
 *      }  
 * )
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
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="array")
     */
    private $ingredients = [];

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="recipes")
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
