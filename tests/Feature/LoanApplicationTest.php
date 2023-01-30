<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\LoanApplication;

class LoanApplicationTest extends TestCase
{
    public function testLoanApplicationCreatedSuccessfully()
    {
        //$user = factory(User::class)->create();
        //$this->actingAs($user, 'api');

        $loanApplicationData = LoanApplication::factory()->raw();
        
        $this->json('POST', 'api/loan-application/store-loan-application', $loanApplicationData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "LoanApplication" => [
                    "loan_application_number",
                    "loan_amount"
                ],
                "message"
            ]);
    }


    public function testGetLoanApplicationById()
    {
        $loan_application_id = 1;
        $response = $this->json('GET', 'api/loan-application/get-loan-application/'.$loan_application_id, [], ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'LoanApplication'
                ]
            );
    }

    public function testTotalAnnualIncome()
    {
        $loan_application_id = 1;
        $response = $this->json('GET', 'api/loan-application/get-total-annual-income/'.$loan_application_id, [], ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'totalAnnualIncome',
                    'totalBankBalance',
                ]
            );
    }

    
}
