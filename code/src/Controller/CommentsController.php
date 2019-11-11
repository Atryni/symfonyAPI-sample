<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Movie;
use App\Service\EntityServices\CommentService;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @SWG\Tag(name="comments")
 */
class CommentsController extends AbstractController
{
    /**
     * @Route("/api/comments", name="api_comments_get", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="GET comment",
     *     @SWG\Schema(type="array", @SWG\Items(ref=@Model(type=Comment::class))))
     * )
     * @SWG\Parameter(name="movieId", in="query", type="integer", required=false, description="Provide additional query parameter to filter comments for specific movie")
     *
     * @param CommentService $commentService
     * @param null           $movieId
     *
     * @return Response
     */
    public function commentGet(CommentService $commentService, $movieId = null)
    {
        return new JsonResponse($commentService->fetchCommentsByApiData($movieId), 200, [], true);
    }

    /**
     * @Route("/api/comments", name="api_comments_post", methods={"POST"})
     * @SWG\Response(
     *     response=200,
     *     description="POST comment",
     *     @SWG\Schema(type="object", @Model(type=Comment::class))
     * )
     * @SWG\Parameter(name="data", in="body",
     *      @SWG\Schema(
     *          type="object",
     *          example={
     *                  "value": "Text of comment",
     *                  "movieId": 1,
     *              }
     *          )
     *      )
     * )
     *
     * @param Request        $request
     * @param CommentService $commentService
     *
     * @return JsonResponse
     */
    public function commentPost(Request $request, CommentService $commentService)
    {
        $response = $commentService->addCommentByApiData($request->getContent());
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse($response, 200, [], true);
    }
}
