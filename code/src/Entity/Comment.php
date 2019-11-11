<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Swagger\Annotations as SWG;

/**
 * @ORM\Entity
 */
class Comment extends BaseEntity
{
    /**
     * @ORM\ManyToOne(targetEntity="Movie", inversedBy="movieComments", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="movie_id", referencedColumnName="id", nullable=false, unique=false)
     * @SWG\Property(description="Movie parent object")
     *
     * @var Movie
     */
    protected $movie;
    /**
     * @var string
     * @ORM\Column(name="object_value", type="string", nullable=false)
     * @SWG\Property(description="MovieComment value (string)", example="Text of comment")
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
        return   $this->value;
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
     * @return Comment
     */
    public function setMovie(Movie $movie): Comment
    {
        $this->movie = $movie;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return Comment
     */
    public function setValue(string $value): Comment
    {
        $this->value = $value;

        return $this;
    }
}
