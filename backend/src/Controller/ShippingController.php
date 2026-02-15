<?php

namespace App\Controller;

use App\Application\Dto\ShippingRequest;
use App\Application\ShippingCalculator;
use App\Domain\Shipping\Exception\ValidationException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ShippingController extends AbstractController
{
    #[Route('/api/shipping/calculate', name: 'api_shipping_calculate', methods: ['POST'])]
    public function calculate(
        Request $request,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        ShippingCalculator $calculator,
    ): JsonResponse {
        $dto = $serializer->deserialize($request->getContent(), ShippingRequest::class, 'json');

        $errors = $validator->validate($dto);

        if (count($errors) > 0) {
            throw new ValidationException($errors);
        }

        $responseDto = $calculator->handle($dto);

        return $this->json($responseDto);
    }
}