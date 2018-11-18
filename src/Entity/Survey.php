<?php
declare(strict_types=1);

namespace ListRestAPI\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use DateTimeInterface;

/**
 * @ORM\Entity()
 * @ORM\Table("survey")
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Survey
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
     *
     * @ORM\Column(name="question", type="string", nullable=false)
     *
     * @Serializer\Type("string")
     * @Serializer\Expose()
     */
    private $question;

    /**
     * @var DateTimeInterface
     *
     * @ORM\Column(name="open_at", type="datetime", nullable=false)
     *
     * @Serializer\Type("DateTime")
     * @Serializer\Expose()
     */
    private $openAt;

    /**
     * @var DateTimeInterface

     * @ORM\Column(name="close_at", type="datetime", nullable=false)
     *
     * @Serializer\Type("DateTime")
     * @Serializer\Expose()
     */
    private $closeAt;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", columnDefinition="ENUM('active', 'inactive')")
     *
     * @Serializer\Type("string")
     * @Serializer\Expose()
     */
    private $status;

    /**
     * @var Partner
     *
     * @ORM\ManyToOne(targetEntity="Partner", inversedBy="surveys")
     */
    private $partner;

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
     * @return Survey
     */
    public function setId(int $id): Survey
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getQuestion(): string
    {
        return $this->question;
    }

    /**
     * @param string $question
     *
     * @return Survey
     */
    public function setQuestion(string $question): Survey
    {
        $this->question = $question;

        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getOpenAt(): DateTimeInterface
    {
        return $this->openAt;
    }

    /**
     * @param DateTimeInterface $openAt
     *
     * @return Survey
     */
    public function setOpenAt(DateTimeInterface $openAt): Survey
    {
        $this->openAt = $openAt;

        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getCloseAt(): DateTimeInterface
    {
        return $this->closeAt;
    }

    /**
     * @param DateTimeInterface $closeAt
     *
     * @return Survey
     */
    public function setCloseAt(DateTimeInterface $closeAt): Survey
    {
        $this->closeAt = $closeAt;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @return Survey
     */
    public function setStatus(string $status): Survey
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Partner
     */
    public function getPartner(): Partner
    {
        return $this->partner;
    }

    /**
     * @param Partner $partner
     *
     * @return Survey
     */
    public function setPartner(Partner $partner): Survey
    {
        $this->partner = $partner;

        return $this;
    }
}
