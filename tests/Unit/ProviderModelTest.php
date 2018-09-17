<?php
declare(strict_types=1);

namespace tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Provider\Provider;

final class ProviderModelTest extends TestCase {

    public function testFunctionGetHttpSuccessCodes () {


        $httpSuccessCodes = [200,202];

        $provider = $this->getMockBuilder(Provider::class)
                     ->disableOriginalConstructor()
                     ->setMethods(null)
                     ->getMock();

        $this->assertEquals($httpSuccessCodes, $provider->gethttpsuccesscodes());
    }
}