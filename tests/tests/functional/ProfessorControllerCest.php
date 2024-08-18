<?php

namespace Tests\Functional;

use Tests\Support\FunctionalTester;

class ProfessorControllerCest
{
    public function _before(FunctionalTester $I)
    {
        // Code to run before each test
    }

    // Test for the index method
    public function testIndexMethod(FunctionalTester $I)
    {
        // Visit the URL for the index method
        $I->amOnPage('/professor/index');
        
        // Check if the response contains certain text
        $I->see('Some Expected Content'); // Adjust this based on the actual content
    }

    // Test for the store method
    public function testStoreMethod(FunctionalTester $I)
    {
        // Send a POST request to the store method with form data
        $I->sendPOST('/professor/store', [
            'prof_name' => 'John Doe',
            'email'     => 'john.doe@example.com',
            'address'   => '123 Main St',
            'contact'   => '12345678901', // Adjust as needed
            'degree'    => 'PhD'
        ]);
        
        // Check if the response status is 200 and contains success message
        $I->seeResponseCodeIs(200);
        $I->seeResponseContains('success');
    }

    // Test for store method with validation errors
    public function testStoreMethodWithErrors(FunctionalTester $I)
    {
        // Send a POST request with missing fields or invalid data
        $I->sendPOST('/professor/store', [
            'prof_name' => '',
            'email'     => '',
            'address'   => '',
            'contact'   => '', // Invalid contact
            'degree'    => ''
        ]);
        
        // Check if the response status is 400
        $I->seeResponseCodeIs(400);

        // Verify the response contains validation errors
        $I->seeResponseContains('prof_name');
        $I->seeResponseContains('email');
        $I->seeResponseContains('address');
        $I->seeResponseContains('contact');
        $I->seeResponseContains('degree');
    }
}
