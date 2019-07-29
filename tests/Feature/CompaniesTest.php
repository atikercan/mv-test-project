<?php

namespace Tests\Feature;

use App\Company;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CompaniesTest extends TestCase
{
    use DatabaseTransactions;
    
    /** @test */
    public function it_shows_the_companies_page()
    {
        $response = $this->get('/companies');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_creates_a_company()
    {
		$data = [
            'name' => 'Hello', 'logo' => 'http://logo.com/logo.gif'
        ];
        $response = $this->json('POST', '/companies', $data);

        $response->assertStatus(200);

        // Add a database assertion here
		$this->assertDatabaseHas("companies", $data);
    }

	/** @test */
    public function it_creates_a_company_failure()
    {
		$data = [
           'nam'=>'abc','log'=>'http://logo.com/log.gif'
        ];
        $response = $this->json('POST', '/companies', $data);

        $response->assertStatus(400); 
    }
	
    /** @test */
    public function it_updates_a_company()
    {
		
		$newData = [
            'name' => 'Update test', 'logo' => 'http://logo.com/logo-test.gif'
        ];
		$company = factory(Company::class)->create();
 
		$response = $this->json('PUT', '/companies/'.$company->id, $newData);
			
		
		$response->assertStatus(200);
		
		
		$this->assertDatabaseHas("companies", $newData);
    }
	
	/** @test */
    public function it_updates_a_company_failure()
    {
		
		$newData = [
            'name1' => 'Update test', 'logo1' => 'http://logo.com/logo-test.gif'
        ];
		$company = factory(Company::class)->create();
 
		$response = $this->json('PUT', '/companies/'.$company->id, $newData);
		
		$response->assertStatus(400);
    }

    /** @test */
    public function it_deletes_a_company()
    {
        $company = factory(Company::class)->create();

        $response = $this->json('DELETE', '/companies/' . $company->id);
        $response->assertStatus(200);

        $this->assertDatabaseMissing('companies', ['id' => $company->id]);
    }
}
