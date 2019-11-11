<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Service\EntityServices\MovieService;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @SWG\Tag(name="movies")
 */
class MoviesController extends AbstractController
{
    /**
     * @Route("/api/movies", name="api_movies_get", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="GET movie",
     *     @SWG\Schema(type="array", @SWG\Items(ref=@Model(type=Movie::class))))
     * )
     *
     * @param MovieService $movieService
     *
     * @return Response
     */
    public function movieGet(MovieService $movieService)
    {
        return new JsonResponse($movieService->getMoviesForApi(), 200, [], true);
    }

    /**
     * @Route("/api/movies", name="api_movies_post", methods={"POST"})
     * @SWG\Response(
     *     response=200,
     *     description="POST movie",
     *     @SWG\Schema(type="object", @Model(type=Movie::class))
     * )
     * @SWG\Parameter(name="title", in="query", type="string", required=true, description="Title of movie")
     *
     * @param Request      $request
     * @param MovieService $movieService
     *
     * @return JsonResponse
     */
    public function moviePost(Request $request, MovieService $movieService)
    {
        $response = $movieService->addMovieFromApiByTitle($request->get('title'));
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse($response);
    }

    /**
     * @Route("/api/movies/top", name="api_movies_top", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="POST movie",
     *     @SWG\Schema(type="object", example={
     *              {
     *                  "movie_id": 3,
     *                  "total_comments": 2,
     *                  "rank": 2
     *              }
     *          }
     *     )
     * )
     * @SWG\Parameter(name="", in="query", type="string", required=false, description="Title of movie")
     * @SWG\Parameter(name="dateFrom", in="query", type="date", required=false, description="From date fo filter")
     * @SWG\Parameter(name="dateTo", in="query", type="date", required=false, description="To date fo filter")
     *
     * @param MovieService $movieService
     * @param null         $dateFrom
     * @param null         $dateTo
     *
     * @return JsonResponse
     */
    public function top(MovieService $movieService, $dateFrom = null, $dateTo = null)
    {
        $response = $movieService->getTopRating($dateFrom, $dateTo);

        return new JsonResponse($response);
    }
}
