<?php

namespace App\Domain\Basket\Entity;

use App\Domain\Item\Entity\Song;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass="App\Domain\Basket\Repository\ShoppingBasketRepository")
 */
class ShoppingBasket
{
    /**
     * @var UuidInterface
     *
     * @ORM\Id()
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $name;

    /**
     *  @var ArrayCollection
     *  @ORM\ManyToMany(targetEntity="App\Domain\Item\Entity\Song")
     *  @ORM\JoinTable(name="basket_item")
     */
    private $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id->toString();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): ShoppingBasket
    {
        $this->name = $name;

        return $this;
    }

    public function addSong(Song $song): ShoppingBasket
    {
        $this->items->add($song);

        return $this;
    }

    public function addRemove(Song $song): ShoppingBasket
    {
        $this->items->removeElement($song);

        return $this;
    }

    /**
     * @return ArrayCollection| PersistentCollection
     */
    public function getItems()
    {
        return $this->items;
    }
}
