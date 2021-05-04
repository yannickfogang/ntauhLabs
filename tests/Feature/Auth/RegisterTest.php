<?php


namespace Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;

use NtauhLabs\User\Infrastructure\Repositories\EloquentUserRepository;
use Tests\TestCase;

class RegisterTest extends TestCase
{

    use RefreshDatabase;

    private EloquentUserRepository $userRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->refreshDatabase();
        $this->userRepository   =   new EloquentUserRepository();
    }

    public function test_is_display_register_form() {
        $response   =   $this->get('/register');
        $response->assertStatus(200);
        $response->assertViewIs('front::auth.register');
    }

    public function test_post_data_with_fake_email() {
        $response   =   $this->post('/register',
            [
                'email' =>  'test_myemail'
            ]
        );
        $response->assertSessionHasErrors(['email' => 'Cet adresse email n\'est pas valide']);
    }

    public function test_password_confirmation_fail() {
        $response   =   $this->post('/register',
            [
                'email' =>  'test@gmail.com',
                'password' => '123456',
                'password_confirmation' => '1234'
            ]
        );
        $response->assertSessionHasErrors(['password_confirmation' => 'La confirmation de votre mot de passe n\'est pas valide']);
    }

    public function test_min_length_password() {
        $response   =   $this->post('/register',
            [
                'email' =>  'test@gmail.com',
                'password' => 'te',
                'password_confirmation' => 'te'
            ]
        );
        $response->assertSessionHasErrors(['password' => 'Votre mot de passe doit contenir au moins 4 caractères']);
    }

    public function test_create_user_account() {
        $response   =   $this->post('/register',
            [
                'email' => 'test@gmail.com',
                'password' => '123456',
                'password_confirmation' => '123456'
            ]
        );

        $this->assertEquals('Un email de validation vous été envoyé par mail', $response->getOriginalContent()->getData()['viewModel']->messages['success']);
        $response->assertViewIs('front::home.index');
        $user   =   $this->userRepository->getUserByEmail('test@gmail.com');
        $this->assertEquals('test@gmail.com', $user->getEmail());
    }

}
