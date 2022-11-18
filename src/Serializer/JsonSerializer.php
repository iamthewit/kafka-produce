<?php


namespace App\Serializer;

use App\Event\EventInterface;
use App\Event\Occurrence;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Exception\MessageDecodingFailedException;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;

/**
 * Class JsonSerializer
 * @package App\Serializer
 */
class JsonSerializer implements SerializerInterface
{

    public function decode(array $encodedEnvelope): Envelope
    {
        $event = json_decode($encodedEnvelope['event'], true);

        return new Envelope(new Occurrence($event['value']));
    }

    public function encode(Envelope $envelope): array
    {
        /** @var EventInterface $event */
        $event = $envelope->getMessage();

        return [
            'key' => (string) $event->getValue(),
            'headers' => [
            ],
            'body' => json_encode([
                'event' => get_class($event),
                'data' => $event,
            ]),
        ];
    }
}