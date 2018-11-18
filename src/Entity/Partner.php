<?php
declare(strict_types=1);

namespace ListRestAPI\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass="ListRestAPI\Repository\PartnerRepository")
 * @ORM\Table("partner")
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Partner
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer", unique=true)
     *
     * @Serializer\Type("int")
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", nullable=false)
     *
     * @Serializer\Type("string")
     * @Serializer\Expose()
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="icon", type="string", nullable=false)
     *
     * @Serializer\Type("string")
     * @Serializer\Expose()
     */
    private $icon;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Survey", mappedBy="partner")
     *
     * @Serializer\Type("ArrayCollection<ListRestAPI\Entity\Survey>")
     * @Serializer\Expose()
     */
    private $surveys;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return Partner
     */
    public function setId(int $id): Partner
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Partner
     */
    public function setName(string $name): Partner
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     *
     * @return Partner
     */
    public function setIcon(string $icon): Partner
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getSurveys(): Collection
    {
        return $this->surveys;
    }

    /**
     * @param Collection $surveys
     *
     * @return Partner
     */
    public function setSurveys(Collection $surveys): Partner
    {
        $this->surveys = $surveys;

        return $this;
    }
}
