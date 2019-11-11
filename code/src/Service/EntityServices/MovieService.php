<?php

namespace App\Service\EntityServices;

use App\Entity\Movie;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class MovieService extends AbstractService
{
    /**
     * @param $movieTitle
     *
     * @return array|mixed
     */
    public function addMovieFromApiByTitle($movieTitle)
    {
        $OMDBApiClient = new Client(['base_uri' => 'https://www.omdbapi.com/']);

        try {
            $response = $OMDBApiClient->request('GET', '', [
                'query' => [
                    'apikey' => '',
                    't' => $movieTitle,
                ],
            ]);
            $data = json_decode($response->getBody(), true);
            if (isset($data['Response']) && 'False' === $data['Response']) {
                return $data;
            }
            $movie = $this->deserialize($response->getBody(), Movie::class);
            $this->registry->getManager()->persist($movie);

            return $data;
        } catch (GuzzleException $e) {
            return ['error' => 'fetch error'];
        }
    }

    /**
     * @return string
     */
    public function getMoviesForApi(): string
    {
        $movieRepository = $this->registry->getManager()->getRepository(Movie::class);
        $movies = $movieRepository->findBy([], ['title' => 'ASC', 'id' => 'ASC']);

        return $this->serialize($movies);
    }

    /**
     * @param null $dateFrom
     * @param null $dateTo
     *
     * @return array
     */
    public function getTopRating($dateFrom = null, $dateTo = null): array
    {
//        $entityManager = $this->registry->getManager();
//        $topRatingQueryBuilder = $entityManager->getRepository(Movie::class)->getTopRatingQueryBuilder($dateFrom = null, $dateTo = null);
//        $objects=$topRatingQueryBuilder->getQuery()->getResult()
        return $this->convertObjectsToTopRatingData([]);
    }

    private function convertObjectsToTopRatingData($objects)
    {
        return [];
    }
}
