<?php

/**
 * Class TestEndpointsCest
 */
class TestEndpointsCest
{
    /**
     * @param ApiTester $I
     * @return void
     */
    public function _before(ApiTester $I)
    {
    }

    /**
     * @param ApiTester $I
     * @return void
     */
    public function _after(ApiTester $I)
    {
    }

    /**
     * @param ApiTester $I
     * @return void
     */
    public function testGetTestEndpoint(ApiTester $I)
    {
        $I->wantTo('Test endpoint returns 200');
        $I->sendGET('/test');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'status' => 200,
            'data'   => 'this is some test',
            'error'  => false
        ]);

    }
}
