<?php

namespace App\Service\EntityServices;

use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

abstract class AbstractService
{
    /**
     * @var ManagerRegistry
     */
    protected $registry;

    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }

    protected function deserialize($data, $class, $encoder = 'json')
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        return $serializer->deserialize($data, $class, $encoder);
    }

    protected function serialize($object, $encoder = 'json', $ignoredAttributes = ['createdAt', 'updatedAt', 'objectName'])
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getObjectName();
            },
        ];
        $objectNormalizer = new ObjectNormalizer(null, null, null, null, null, null, $defaultContext);

        $normalizers = [$objectNormalizer];
        $serializer = new Serializer($normalizers, $encoders);

        return $serializer->serialize($object, $encoder, [AbstractNormalizer::IGNORED_ATTRIBUTES => $ignoredAttributes]);
    }
}
