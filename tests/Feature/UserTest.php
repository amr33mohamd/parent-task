<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testFilters(): void
    {
          

        $jsonFilePath = storage_path('app/DataProviderY.json'); // Adjust the path as needed
        $file = UploadedFile::fake()->createWithContent('DataProviderY.json', file_get_contents($jsonFilePath));
        // Perform the file upload
        $response = $this->post('/api/users?currency=USD', [
            'DataProviderY' => $file,
        ]);

        // Assert the response status
        $response->assertStatus(200);

        // Assert the specific response content
        $response->assertJson([  [
            "provider"=> "DataProviderY",
            "status"=> "authorised",
            "balance"=> 300,
            "currency"=> "USD",
            "id"=>"4fc2-a8asdasd1",
            "created_at"=> "2018-12-22"
        ]]);    
    }
}
