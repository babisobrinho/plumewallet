<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestEmailCommand extends Command
{
    protected $signature = 'mail:test';
    protected $description = 'Testar conexão SMTP com Mailtrap';

    public function handle()
    {
        try {
            Mail::raw('Teste de conexão SMTP', function($message) {
                $message->to(env('MAIL_FROM_ADDRESS'))
                    ->subject('Teste de SMTP - '.now());
            });

            $this->info('✅ E-mail enviado com sucesso! Verifique sua caixa no Mailtrap.');
        } catch (\Exception $e) {
            $this->error('❌ Falha no envio: '.$e->getMessage());
        }
    }
}
