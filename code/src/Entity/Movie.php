<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MovieRepository")
 */
class Movie extends BaseEntity
{
    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="movie", orphanRemoval=true)
     *
     * @var array|ArrayCollection|Comment[]
     */
    protected $movieComments;

    /**
     * @ORM\OneToMany(targetEntity="Rate", mappedBy="movie", orphanRemoval=true)
     *
     * @var array|ArrayCollection|Rate[]
     */
    protected $movieRates;

    /**
     * @ORM\Column(name="actors", nullable=true, type="string")
     */
    private $actors;

    /**
     * @ORM\Column(name="awards", nullable=true, type="string")
     */
    private $awards;

    /**
     * @ORM\Column(name="country", nullable=true, type="string")
     */
    private $country;

    /**
     * @ORM\Column(name="director", nullable=true, type="string")
     */
    private $director;

    /**
     * @ORM\Column(name="genre", nullable=true, type="string")
     */
    private $genre;

    /**
     * @ORM\Column(name="imdbID", nullable=true, type="string")
     */
    private $imdbID;

    /**
     * @ORM\Column(name="imdbRating", nullable=true, type="string")
     */
    private $imdbRating;

    /**
     * @ORM\Column(name="imdbVotes", nullable=true, type="string")
     */
    private $imdbVotes;

    /**
     * @ORM\Column(name="language", nullable=true, type="string")
     */
    private $language;

    /**
     * @ORM\Column(name="metascore", nullable=true, type="string")
     */
    private $metascore;

    /**
     * @ORM\Column(name="plot", nullable=true, type="string")
     */
    private $plot;

    /**
     * @ORM\Column(name="poster", nullable=true, type="string")
     */
    private $poster;

    /**
     * @ORM\Column(name="rated", nullable=true, type="string")
     */
    private $rated;

    /**
     * @ORM\Column(name="released", nullable=true, type="string")
     */
    private $released;

    /**
     * @ORM\Column(name="runtime", nullable=true, type="string")
     */
    private $runtime;
    /**
     * @ORM\Column(name="title", nullable=true, type="string")
     */
    private $title;

    /**
     * @ORM\Column(name="totalSeasons", nullable=true, type="string")
     */
    private $totalSeasons;

    /**
     * @ORM\Column(name="type", nullable=true, type="string")
     */
    private $type;

    /**
     * @ORM\Column(name="writer", nullable=true, type="string")
     */
    private $writer;

    /**
     * @ORM\Column(name="year", nullable=true, type="string")
     */
    private $year;

    /**
     * @return mixed
     */
    public function getActors()
    {
        return $this->actors;
    }

    /**
     * @return mixed
     */
    public function getAwards()
    {
        return $this->awards;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return mixed
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @return mixed
     */
    public function getImdbID()
    {
        return $this->imdbID;
    }

    /**
     * @return mixed
     */
    public function getImdbRating()
    {
        return $this->imdbRating;
    }

    /**
     * @return mixed
     */
    public function getImdbVotes()
    {
        return $this->imdbVotes;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return mixed
     */
    public function getMetascore()
    {
        return $this->metascore;
    }

    /**
     * @return array|ArrayCollection|Comment[]
     */
    public function getMovieComments()
    {
        return $this->movieComments;
    }

    /**
     * @return array|ArrayCollection|Rate[]
     */
    public function getMovieRates()
    {
        return $this->movieRates;
    }

    /**
     * @return string
     */
    public function getObjectName()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getPlot()
    {
        return $this->plot;
    }

    /**
     * @return mixed
     */
    public function getPoster()
    {
        return $this->poster;
    }

    /**
     * @return mixed
     */
    public function getRated()
    {
        return $this->rated;
    }

    /**
     * @return mixed
     */
    public function getReleased()
    {
        return $this->released;
    }

    /**
     * @return mixed
     */
    public function getRuntime()
    {
        return $this->runtime;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getTotalSeasons()
    {
        return $this->totalSeasons;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getWriter()
    {
        return $this->writer;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $actors
     *
     * @return Movie
     */
    public function setActors($actors)
    {
        $this->actors = $actors;

        return $this;
    }

    /**
     * @param mixed $awards
     *
     * @return Movie
     */
    public function setAwards($awards)
    {
        $this->awards = $awards;

        return $this;
    }

    /**
     * @param mixed $country
     *
     * @return Movie
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @param mixed $director
     *
     * @return Movie
     */
    public function setDirector($director)
    {
        $this->director = $director;

        return $this;
    }

    /**
     * @param mixed $genre
     *
     * @return Movie
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * @param mixed $imdbID
     *
     * @return Movie
     */
    public function setImdbID($imdbID)
    {
        $this->imdbID = $imdbID;

        return $this;
    }

    /**
     * @param mixed $imdbRating
     *
     * @return Movie
     */
    public function setImdbRating($imdbRating)
    {
        $this->imdbRating = $imdbRating;

        return $this;
    }

    /**
     * @param mixed $imdbVotes
     *
     * @return Movie
     */
    public function setImdbVotes($imdbVotes)
    {
        $this->imdbVotes = $imdbVotes;

        return $this;
    }

    /**
     * @param mixed $language
     *
     * @return Movie
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @param mixed $metascore
     *
     * @return Movie
     */
    public function setMetascore($metascore)
    {
        $this->metascore = $metascore;

        return $this;
    }

    /**
     * @param mixed $plot
     *
     * @return Movie
     */
    public function setPlot($plot)
    {
        $this->plot = $plot;

        return $this;
    }

    /**
     * @param mixed $poster
     *
     * @return Movie
     */
    public function setPoster($poster)
    {
        $this->poster = $poster;

        return $this;
    }

    /**
     * @param mixed $rated
     *
     * @return Movie
     */
    public function setRated($rated)
    {
        $this->rated = $rated;

        return $this;
    }

    /**
     * @param mixed $released
     *
     * @return Movie
     */
    public function setReleased($released)
    {
        $this->released = $released;

        return $this;
    }

    /**
     * @param mixed $runtime
     *
     * @return Movie
     */
    public function setRuntime($runtime)
    {
        $this->runtime = $runtime;

        return $this;
    }

    /**
     * @param mixed $title
     *
     * @return Movie
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param mixed $totalSeasons
     *
     * @return Movie
     */
    public function setTotalSeasons($totalSeasons)
    {
        $this->totalSeasons = $totalSeasons;

        return $this;
    }

    /**
     * @param mixed $type
     *
     * @return Movie
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param mixed $writer
     *
     * @return Movie
     */
    public function setWriter($writer)
    {
        $this->writer = $writer;

        return $this;
    }

    /**
     * @param mixed $year
     *
     * @return Movie
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }
}
