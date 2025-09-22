<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\ProfessionalProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProfessionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $professionals = [
            [
                'name' => 'Dr. Ana Silva',
                'email' => 'ana.silva@telemedicina.com',
                'profile' => [
                    'first_name' => 'Ana',
                    'last_name' => 'Silva',
                    'birth_date' => '1985-03-15',
                    'cpf' => '12345678901',
                    'phone' => '(11) 98765-4321',
                    'gender' => 'Feminino',
                ],
                'professional' => [
                    'license_number' => 'CRM-SP-123456',
                    'license_type' => 'CRM',
                    'specialty' => 'Clínico Geral',
                    'subspecialties' => ['Medicina Preventiva', 'Geriatria'],
                    'bio' => 'Médica clínica geral com mais de 10 anos de experiência. Especialista em medicina preventiva e cuidados geriátricos.',
                    'years_experience' => 10,
                    'education' => [
                        'Graduação em Medicina - USP (2008)',
                        'Residência em Clínica Médica - Hospital das Clínicas (2011)',
                        'Especialização em Geriatria - UNIFESP (2013)'
                    ],
                    'certifications' => [
                        'Título de Especialista em Clínica Médica - AMB',
                        'Certificação em Telemedicina - CFM'
                    ],
                    'languages' => ['Português', 'Inglês'],
                    'consultation_fee' => 150.00,
                    'rating' => 4.8,
                    'total_reviews' => 89,
                    'is_verified' => true,
                    'is_available' => true,
                    'availability_schedule' => [
                        'monday' => ['09:00-12:00', '14:00-18:00'],
                        'tuesday' => ['09:00-12:00', '14:00-18:00'],
                        'wednesday' => ['09:00-12:00', '14:00-18:00'],
                        'thursday' => ['09:00-12:00', '14:00-18:00'],
                        'friday' => ['09:00-12:00', '14:00-17:00'],
                        'saturday' => [],
                        'sunday' => []
                    ],
                    'max_daily_consultations' => 12,
                    'status' => 'active',
                    'verified_at' => now(),
                    'last_active_at' => now(),
                ]
            ],
            [
                'name' => 'Dr. Carlos Mendes',
                'email' => 'carlos.mendes@telemedicina.com',
                'profile' => [
                    'first_name' => 'Carlos',
                    'last_name' => 'Mendes',
                    'birth_date' => '1978-07-22',
                    'cpf' => '23456789012',
                    'phone' => '(11) 97654-3210',
                    'gender' => 'Masculino',
                ],
                'professional' => [
                    'license_number' => 'CRM-SP-234567',
                    'license_type' => 'CRM',
                    'specialty' => 'Cardiologia',
                    'subspecialties' => ['Ecocardiografia', 'Cardiologia Intervencionista'],
                    'bio' => 'Cardiologista experiente com foco em prevenção e tratamento de doenças cardiovasculares. Atua há 15 anos na área.',
                    'years_experience' => 15,
                    'education' => [
                        'Graduação em Medicina - UNIFESP (2003)',
                        'Residência em Cardiologia - InCor (2006)',
                        'Fellowship em Cardiologia Intervencionista - Hospital Sírio-Libanês (2007)'
                    ],
                    'certifications' => [
                        'Título de Especialista em Cardiologia - SBC',
                        'Certificação em Ecocardiografia - SBC'
                    ],
                    'languages' => ['Português', 'Inglês', 'Espanhol'],
                    'consultation_fee' => 280.00,
                    'rating' => 4.9,
                    'total_reviews' => 156,
                    'is_verified' => true,
                    'is_available' => true,
                    'availability_schedule' => [
                        'monday' => ['08:00-12:00', '13:00-17:00'],
                        'tuesday' => ['08:00-12:00', '13:00-17:00'],
                        'wednesday' => ['08:00-12:00', '13:00-17:00'],
                        'thursday' => ['08:00-12:00', '13:00-17:00'],
                        'friday' => ['08:00-12:00'],
                        'saturday' => ['09:00-13:00'],
                        'sunday' => []
                    ],
                    'max_daily_consultations' => 10,
                    'status' => 'active',
                    'verified_at' => now(),
                    'last_active_at' => now(),
                ]
            ],
            [
                'name' => 'Dra. Mariana Costa',
                'email' => 'mariana.costa@telemedicina.com',
                'profile' => [
                    'first_name' => 'Mariana',
                    'last_name' => 'Costa',
                    'birth_date' => '1990-11-08',
                    'cpf' => '34567890123',
                    'phone' => '(11) 96543-2109',
                    'gender' => 'Feminino',
                ],
                'professional' => [
                    'license_number' => 'CRM-SP-345678',
                    'license_type' => 'CRM',
                    'specialty' => 'Dermatologia',
                    'subspecialties' => ['Dermatologia Estética', 'Tricologia'],
                    'bio' => 'Dermatologista especializada em cuidados com a pele e tratamentos estéticos. Atendimento humanizado e personalizado.',
                    'years_experience' => 8,
                    'education' => [
                        'Graduação em Medicina - PUC-SP (2012)',
                        'Residência em Dermatologia - Hospital das Clínicas (2015)',
                        'Especialização em Dermatologia Estética - ISDIN (2016)'
                    ],
                    'certifications' => [
                        'Título de Especialista em Dermatologia - SBD',
                        'Certificação em Tricologia - ABCT'
                    ],
                    'languages' => ['Português', 'Inglês'],
                    'consultation_fee' => 200.00,
                    'rating' => 4.7,
                    'total_reviews' => 67,
                    'is_verified' => true,
                    'is_available' => true,
                    'availability_schedule' => [
                        'monday' => ['09:00-12:00', '14:00-19:00'],
                        'tuesday' => ['09:00-12:00', '14:00-19:00'],
                        'wednesday' => ['14:00-19:00'],
                        'thursday' => ['09:00-12:00', '14:00-19:00'],
                        'friday' => ['09:00-12:00', '14:00-18:00'],
                        'saturday' => ['09:00-14:00'],
                        'sunday' => []
                    ],
                    'max_daily_consultations' => 15,
                    'status' => 'active',
                    'verified_at' => now(),
                    'last_active_at' => now(),
                ]
            ],
            [
                'name' => 'Dr. Roberto Oliveira',
                'email' => 'roberto.oliveira@telemedicina.com',
                'profile' => [
                    'first_name' => 'Roberto',
                    'last_name' => 'Oliveira',
                    'birth_date' => '1982-05-30',
                    'cpf' => '45678901234',
                    'phone' => '(11) 95432-1098',
                    'gender' => 'Masculino',
                ],
                'professional' => [
                    'license_number' => 'CRM-SP-456789',
                    'license_type' => 'CRM',
                    'specialty' => 'Psiquiatria',
                    'subspecialties' => ['Psiquiatria do Adulto', 'Psicofarmacologia'],
                    'bio' => 'Psiquiatra com abordagem integrativa, focado em saúde mental e bem-estar. Experiência em terapias medicamentosas e psicoterapia.',
                    'years_experience' => 12,
                    'education' => [
                        'Graduação em Medicina - UFRJ (2006)',
                        'Residência em Psiquiatria - IPUB-UFRJ (2009)',
                        'Mestrado em Psiquiatria - UFRJ (2011)'
                    ],
                    'certifications' => [
                        'Título de Especialista em Psiquiatria - ABP',
                        'Certificação em Psicofarmacologia - ABP'
                    ],
                    'languages' => ['Português', 'Inglês'],
                    'consultation_fee' => 250.00,
                    'rating' => 4.6,
                    'total_reviews' => 43,
                    'is_verified' => true,
                    'is_available' => true,
                    'availability_schedule' => [
                        'monday' => ['10:00-13:00', '15:00-19:00'],
                        'tuesday' => ['10:00-13:00', '15:00-19:00'],
                        'wednesday' => ['10:00-13:00', '15:00-19:00'],
                        'thursday' => ['10:00-13:00', '15:00-19:00'],
                        'friday' => ['10:00-13:00', '15:00-18:00'],
                        'saturday' => [],
                        'sunday' => []
                    ],
                    'max_daily_consultations' => 8,
                    'status' => 'active',
                    'verified_at' => now(),
                    'last_active_at' => now(),
                ]
            ],
            [
                'name' => 'Dra. Patricia Santos',
                'email' => 'patricia.santos@telemedicina.com',
                'profile' => [
                    'first_name' => 'Patricia',
                    'last_name' => 'Santos',
                    'birth_date' => '1987-12-12',
                    'cpf' => '56789012345',
                    'phone' => '(11) 94321-0987',
                    'gender' => 'Feminino',
                ],
                'professional' => [
                    'license_number' => 'CRM-SP-567890',
                    'license_type' => 'CRM',
                    'specialty' => 'Pediatria',
                    'subspecialties' => ['Neonatologia', 'Pediatria Ambulatorial'],
                    'bio' => 'Pediatra dedicada ao cuidado integral da criança. Experiência em acompanhamento do desenvolvimento infantil e adolescente.',
                    'years_experience' => 11,
                    'education' => [
                        'Graduação em Medicina - UNICAMP (2007)',
                        'Residência em Pediatria - Hospital das Clínicas UNICAMP (2010)',
                        'Especialização em Neonatologia - UNICAMP (2012)'
                    ],
                    'certifications' => [
                        'Título de Especialista em Pediatria - SBP',
                        'Certificação em Neonatologia - SBP'
                    ],
                    'languages' => ['Português', 'Inglês'],
                    'consultation_fee' => 180.00,
                    'rating' => 4.9,
                    'total_reviews' => 125,
                    'is_verified' => true,
                    'is_available' => true,
                    'availability_schedule' => [
                        'monday' => ['08:00-12:00', '14:00-18:00'],
                        'tuesday' => ['08:00-12:00', '14:00-18:00'],
                        'wednesday' => ['08:00-12:00', '14:00-18:00'],
                        'thursday' => ['08:00-12:00', '14:00-18:00'],
                        'friday' => ['08:00-12:00', '14:00-17:00'],
                        'saturday' => ['08:00-12:00'],
                        'sunday' => []
                    ],
                    'max_daily_consultations' => 14,
                    'status' => 'active',
                    'verified_at' => now(),
                    'last_active_at' => now(),
                ]
            ]
        ];

        foreach ($professionals as $professionalData) {
            // Create user
            $user = User::firstOrCreate(
                ['email' => $professionalData['email']],
                [
                    'name' => $professionalData['name'],
                    'email' => $professionalData['email'],
                    'password' => Hash::make('password123'),
                ]
            );

            // Assign professional role
            if (!$user->hasRole('professional')) {
                $user->assignRole('professional');
            }

            // Create user profile
            UserProfile::firstOrCreate(
                ['user_id' => $user->id],
                array_merge($professionalData['profile'], ['user_id' => $user->id])
            );

            // Create professional profile
            ProfessionalProfile::firstOrCreate(
                ['user_id' => $user->id],
                array_merge($professionalData['professional'], ['user_id' => $user->id])
            );
        }
    }
}