<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestMail extends Command
{
    protected $signature = 'test:mail';
    protected $description = 'Test mail configuration';

    public function handle()
    {
        $this->info('Enviando email de prueba...');

        try {
            Mail::raw('Este es un mensaje de prueba desde Laravel', function ($message) {
                $message->to('info@multicreath.com')
                        ->subject('Prueba SMTP - ' . now())
                        ->from('info@multicreath.com', 'MULTICREATH');
            });

            $this->info('✓ Email enviado exitosamente!');
            $this->info('Verifica tu correo en info@multicreath.com');

        } catch (\Exception $e) {
            $this->error('✗ Error: ' . $e->getMessage());
        }
    }
}