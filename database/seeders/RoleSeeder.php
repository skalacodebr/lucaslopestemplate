<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Super Administrador',
                'slug' => 'super-admin',
                'description' => 'Acesso total ao sistema',
                'permissions' => [
                    'access_admin',
                    'manage_users',
                    'manage_professionals',
                    'manage_consultations',
                    'manage_payments',
                    'manage_system',
                    'view_reports',
                    'manage_roles',
                    'manage_permissions',
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Administrador',
                'slug' => 'admin',
                'description' => 'Administrador do sistema',
                'permissions' => [
                    'access_admin',
                    'manage_users',
                    'manage_professionals',
                    'manage_consultations',
                    'view_reports',
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Profissional de Saúde',
                'slug' => 'professional',
                'description' => 'Profissional médico ou de saúde',
                'permissions' => [
                    'access_consultations',
                    'manage_own_profile',
                    'manage_own_schedule',
                    'view_patient_records',
                    'create_prescriptions',
                    'update_consultation_status',
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Paciente',
                'slug' => 'patient',
                'description' => 'Usuário paciente do sistema',
                'permissions' => [
                    'book_consultations',
                    'view_own_records',
                    'manage_own_profile',
                    'view_consultation_history',
                    'upload_documents',
                    'receive_prescriptions',
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Moderador',
                'slug' => 'moderator',
                'description' => 'Moderador de conteúdo e suporte',
                'permissions' => [
                    'access_admin',
                    'moderate_content',
                    'provide_support',
                    'view_basic_reports',
                ],
                'is_active' => true,
            ],
        ];

        foreach ($roles as $roleData) {
            Role::firstOrCreate(
                ['slug' => $roleData['slug']],
                $roleData
            );
        }
    }
}
