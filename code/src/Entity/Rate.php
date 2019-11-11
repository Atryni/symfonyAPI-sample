<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Swagger\Annotations as SWG;

/**
 * @ORM\Entity
 */
class Rate extends BaseEntity
{
    /**
     * @ORM\ManyToOne(targetEntity="Movie", inversedBy="movieRates", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="movie_id", referencedColumnName="id", nullable=false, unique=false)
     * @SWG\Property(description="Movie parent object")
     *
     * @var Movie
     */
    protected $movie;
    /**
     * @var string
     * @ORM\Column(name="object_value", type="string", nullable=false)
     * @SWG\Property(description="MovieRate value (string)", example="Text of rate")
     */
    protected $value;

    /**
     * @return Movie
     */
    public function getMovie(): Movie
    {
        return $this->movie;
    }

    /**
     * @return string
     */
    public function getObjectName()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param Movie $movie
     *
     * @return Rate
     */
    public function setMovie(Movie $movie): Rate
    {
        $this->movie = $movie;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return Rate
     */
    public function setValue(string $value): Rate
    {
        $this->value = $value;

        return $this;
    }
}
