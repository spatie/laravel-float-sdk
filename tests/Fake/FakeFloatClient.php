<?php

namespace Spatie\FloatSdk\Tests\Fake;

use Illuminate\Support\Testing\Fakes\Fake;
use Spatie\FloatSdk\FloatClient;

class FakeFloatClient extends FloatClient implements Fake
{
    public function __construct()
    {
        parent::__construct('fake-token', 'fake-user_agent');
    }
}
