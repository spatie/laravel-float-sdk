<?php

namespace Spatie\FloatSdk\Data;

class TimeOffData
{
    public function __construct(
        public string $startDate,
        public string $endDate,
        public string $typeName,
        public bool $fullDay,
        public array $peopleIds,
        public string $timeoffTypeId,
        public ?int $repeatState,
        public ?string $repeatEnd,
    ) {}

    /** @param array<string, mixed> $response */
    public static function createFromResponse(array $response): self
    {
        return new self(
            startDate: $response['start_date'],
            endDate: $response['end_date'],
            typeName: $response['timeoff_type_name'],
            fullDay: (bool) $response['full_day'],
            peopleIds: $response['people_ids'],
            timeoffTypeId: $response['timeoff_type_id'],
            repeatState: $response['repeat_state'],
            repeatEnd: $response['repeat_end'],
        );
    }
}
