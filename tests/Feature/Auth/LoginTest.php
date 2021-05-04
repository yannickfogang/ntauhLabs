<?php


namespace Auth;


use Illuminate\Foundation\Testing\RefreshDatabase;
use NtauhLabs\SharedService\NativePasswordHash;
use NtauhLabs\User\Infrastructure\Models\User;
use Tests\TestCase;
use Tests\Unit\_Mock\SharedService\IdGeneratorMock;

class LoginTest extends TestCase
{

    use RefreshDatabase;

    private User $registeredUser;
    private IdGeneratorMock $idGenerator;
    private NativePasswordHash $passwordHash;

    public function setUp(): void
    {
        parent::setUp();
        $this->refreshDatabase();
        $this->idGenerator = new IdGeneratorMock();
        $this->passwordHash = new NativePasswordHash();

        $this->registeredUser   =   User::factory()->create(
            [
                'email'     => 'fogang24@gmail.com',
                'password'  => $this->passwordHash->hash('123456'),
                'uuid'      =>  $this->idGenerator->generate()
            ]
        );
    }

    public function test_display_login_form() {
        $response   =   $this->get('/login');
        $response->assertStatus(200);
        $response->assertViewIs('front::auth.login');
    }

    public function test_post_data_with_fake_email() {
        $response = $this->post('/login',
            ['email' => 'test.com', 'password' => '123466']
        );
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email' => 'votre adresse email n\'est pas valide']);
    }

    public function test_login_no_account_exist() {
        $response = $this->post('/login',
            ['email' => 'fogang@gmail.com', 'password' => '123456']
        );
        $this->assertEquals('Ce compte n\'existe pas',  $response->getOriginalContent()->getData()['viewModel']->messages['not_exist']);
        $response->assertViewIs('front::auth.login');
    }

    public function test_login_wrong_credentials() {
        $response = $this->post('/login',
            ['email' => 'fogang24@gmail.com', 'password' => '12345']
        );
        $this->assertEquals('Votre mot de passe est invalide',  $response->getOriginalContent()->getData()['viewModel']->messages['wrong_password']);
        $response->assertViewIs('front::auth.login');
    }

    public function test_login() {
        $response = $this->post('/login',
            ['email' => 'fogang24@gmail.com', 'password' => '123456']
        );
        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

}
