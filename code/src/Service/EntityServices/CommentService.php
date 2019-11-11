<?php

namespace App\Service\EntityServices;

use App\Entity\Comment;
use App\Entity\Movie;

class CommentService extends AbstractService
{
    public function addCommentByApiData(string $data): string
    {
        $entityManager = $this->registry->getManager();
        $arrayData = json_decode($data, true);
        /** @var Comment $comment */
        $comment = $this->deserialize($data, Comment::class);

        if (isset($arrayData['movieId']) && $movieId = $arrayData['movieId']) {
            try {
                /** @var null|Movie $movie */
                $movie = $entityManager->getRepository(Movie::class)->find($movieId);
                $comment->setMovie($movie);
            } catch (\Exception $exception) {
                return json_encode(['error' => 'Movie with provided ID does not exist']);
            }

            if (null !== $comment->getMovie() && null !== $comment->getValue()) {
                $entityManager->persist($comment);

                return $this->serialize($comment);
            }
        }

        return json_encode(['error' => 'Missing necessary fields']);
    }

    /**
     * @param null|int $movieId
     *
     * @return string
     */
    public function fetchCommentsByApiData($movieId = null): string
    {
        $commentRepository = $this->registry->getManager()->getRepository(Comment::class);
        if (null === $movieId) {
            $comments = $commentRepository->findBy([], ['movie' => 'ASC', 'id' => 'ASC']);
        } elseif (is_int($movieId)) {
            $comments = $commentRepository->findBy(['movie' => $movieId], ['movie' => 'ASC', 'id' => 'ASC']);
        } else {
            return json_encode(['error' => '"movieId" parameter must be int']);
        }

        return $this->serialize($comments);
    }
}
