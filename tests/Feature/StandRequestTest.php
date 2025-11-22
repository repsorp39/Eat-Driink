<?php

use App\Mail\ApprovedStandEmail;
use App\Models\Stand;
use App\Models\User;
use Database\Factories\StandFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StandRequestTest extends TestCase {
    use RefreshDatabase;

    /** @test */
    public function stand_is_saved(){
        $data = [
            "business_name"  => "Mon super business",
            "email"          => "azaprosper25@gmail.com",
            "password"       => "password1234",
            "owner_fullname" =>"Jean Dupont",
            "stand_name" => "My great Stand",
            "description" => "Un super stand pour un super business",
        ];
        $response = $this->post('/stand',$data);
        $response->assertRedirect("/login");
    }

    /** @test */
    public function is_some_required_fields_missing(){
        $data = [
            "business_name"  => "Mon super business",
            "email"          => "azaprosper25@gmail.com",
            "stand_name" => "My great Stand",
            "description" => "Un super stand pour un super business",
        ];

        $response = $this->post('/stand',$data);
        $response->assertSessionHasErrors(["password","owner_fullname"]);
    }

     /** @test */
    public function has_duplicate_email(){
        $data = Stand::factory()->create();
        $email = $data->user->email;

        $this->assertDatabaseHas("users",[
            "email" => $email
        ]);

        
        $data = [
            "business_name"  => "Mon super business",
            "email"          => $email,
            "password"       => "password1234",
            "owner_fullname" =>"Jean Dupont",
            "stand_name" => "My great Stand",
            "description" => "Un super stand pour un super business",
         ];

         $response = $this->post('/stand',$data);
         $response->assertSessionHasErrors(["email"]);

    }

        /** @test */
    public function can_upload_images(){
        Storage::fake('local');

        $uploadedImage = UploadedFile::fake()->image("image.png");
        var_dump($uploadedImage);
        $data = [
            "business_name"  => "Mon super business",
            "email"          => "azaprosper25@gmail.com",
            "stand_name" => "My great Stand",
            "description" => "Un super stand pour un super business",
            "business_img" => $uploadedImage,
            "password"  => "password1234",
             "owner_fullname" =>"Jean Dupont",
        ];

        $response = $this->post('/stand',$data);
        $response->assertRedirect("/login");
        // Storage::disk('local')->assertExists($uploadedImage->hashName());
    }

      /** @test */
     public function is_mail_sent(){
        Mail::fake();

        $admin = User::factory()->admin()->create();

        $stand = Stand::factory()->create();
        $user = $stand->user;

        $response = $this->actingAs($admin)->get("/admin/approved?id=".$user->id);

        $response->assertRedirect("/admin");

        Mail::assertQueued(ApprovedStandEmail::class);
     }
}