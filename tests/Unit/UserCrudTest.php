<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Support\Facades\Schema;

class UserCrudTest extends TestCase
{
    use RefreshDatabase;

    // Menyiapkan pengujian
    public function setUp(): void
    {
        parent::setUp();

        // Hapus kolom terkait two-factor jika ada
        Schema::table('users', function ($table) {
            if (Schema::hasColumn('users', 'current_team_id')) {
                $table->dropColumn('current_team_id');
            }
            if (Schema::hasColumn('users', 'two_factor_secret')) {
                $table->dropColumn('two_factor_secret');
            }
            if (Schema::hasColumn('users', 'two_factor_recovery_codes')) {
                $table->dropColumn('two_factor_recovery_codes');
            }
        });
    }

    public function test_create_user()
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => 'password123',
        ];

        // Membuat pengguna baru tanpa kolom `current_team_id`
        $user = User::create($userData);

        // Memastikan pengguna ada di database
        $this->assertDatabaseHas('users', [
            'email' => 'john.doe@example.com',
        ]);

        // Memastikan password ter-enkripsi
        $this->assertTrue(Hash::check('password123', $user->password));
    }

    public function test_read_user()
    {
        // Membuat pengguna menggunakan factory
        $user = User::factory()->create([
            'name' => 'Jane Doe',
            'email' => 'jane.doe@example.com',
        ]);

        // Mendapatkan pengguna berdasarkan ID
        $retrievedUser = User::find($user->id);

        // Memastikan data pengguna sesuai
        $this->assertEquals($user->name, $retrievedUser->name);
        $this->assertEquals($user->email, $retrievedUser->email);
    }

    public function test_update_user()
    {
        // Membuat user pertama kali
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john.doe.as@example.com',
            'password' => bcrypt('password123'),
        ]);
    
        // Memastikan user sudah ada di database
        $this->assertDatabaseHas('users', [
            'email' => 'john.doe.as@example.com',
        ]);
    
        // Mengambil user yang sudah ada untuk update
        $userToUpdate = User::where('email', 'john.doe.as@example.com')->first();
    
        // Update user yang sudah ada, bukan membuat baru
        $userToUpdate->name = 'John Doe Updated'; // Mengubah nama
        $userToUpdate->email = 'john.doe.updated@example.com'; // Mengubah email
        $userToUpdate->save(); // Simpan perubahan
    
        // Memastikan user telah diupdate di database
        $this->assertDatabaseHas('users', [
            'email' => 'john.doe.updated@example.com', // Cek email yang sudah diubah
        ]);
    
        // Memastikan data lama tidak ada di database
        $this->assertDatabaseMissing('users', [
            'email' => 'john.doe.as@example.com', // Pastikan email lama tidak ada
        ]);
    }
    

    public function test_delete_user()
    {
        // Membuat user pertama kali
        $user = User::create([
            'name' => 'Jane Doe',
            'email' => 'jane.doe@example.com',
            'password' => bcrypt('password123'),
        ]);

        // Memastikan user sudah ada di database
        $this->assertDatabaseHas('users', [
            'email' => 'jane.doe@example.com',
        ]);

        // Menghapus user
        $user->delete();

        // Memastikan user telah dihapus
        $this->assertDatabaseMissing('users', [
            'email' => 'jane.doe@example.com',
        ]);
    }
}
