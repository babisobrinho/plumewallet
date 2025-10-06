<?php

// Script para preencher as migrações restantes do backoffice

$migrations = [
    'ticket_categories' => "
        Schema::create('ticket_categories', function (Blueprint \$table) {
            \$table->id();
            \$table->string('name');
            \$table->text('description')->nullable();
            \$table->string('color')->default('#3B82F6');
            \$table->boolean('is_active')->default(true);
            \$table->integer('sla_hours')->default(24);
            \$table->foreignId('assigned_team_id')->nullable()->constrained('teams')->onDelete('set null');
            \$table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            \$table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            \$table->timestamps();
            
            \$table->index(['is_active', 'assigned_team_id']);
        });
    ",
    
    'support_tickets' => "
        Schema::create('support_tickets', function (Blueprint \$table) {
            \$table->id();
            \$table->string('ticket_number')->unique();
            \$table->string('subject');
            \$table->longText('description');
            \$table->foreignId('category_id')->nullable()->constrained('ticket_categories')->onDelete('set null');
            \$table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            \$table->enum('status', ['open', 'in_progress', 'waiting_customer', 'resolved', 'closed'])->default('open');
            \$table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            \$table->foreignId('assigned_agent_id')->nullable()->constrained('users')->onDelete('set null');
            \$table->foreignId('assigned_team_id')->nullable()->constrained('teams')->onDelete('set null');
            \$table->timestamp('due_date')->nullable();
            \$table->timestamp('resolution_date')->nullable();
            \$table->integer('satisfaction_rating')->nullable();
            \$table->text('satisfaction_comment')->nullable();
            \$table->timestamps();
            
            \$table->index(['status', 'priority']);
            \$table->index(['assigned_agent_id', 'status']);
            \$table->index(['category_id', 'status']);
        });
    ",
    
    'ticket_messages' => "
        Schema::create('ticket_messages', function (Blueprint \$table) {
            \$table->id();
            \$table->foreignId('ticket_id')->constrained('support_tickets')->onDelete('cascade');
            \$table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            \$table->longText('message');
            \$table->boolean('is_internal')->default(false);
            \$table->string('ip_address')->nullable();
            \$table->text('user_agent')->nullable();
            \$table->timestamps();
            
            \$table->index(['ticket_id', 'created_at']);
        });
    ",
    
    'ticket_attachments' => "
        Schema::create('ticket_attachments', function (Blueprint \$table) {
            \$table->id();
            \$table->foreignId('ticket_id')->constrained('support_tickets')->onDelete('cascade');
            \$table->foreignId('message_id')->nullable()->constrained('ticket_messages')->onDelete('cascade');
            \$table->string('filename');
            \$table->string('original_name');
            \$table->string('path');
            \$table->string('mime_type');
            \$table->bigInteger('size');
            \$table->foreignId('uploaded_by')->constrained('users')->onDelete('cascade');
            \$table->timestamps();
        });
    ",
    
    'report_templates' => "
        Schema::create('report_templates', function (Blueprint \$table) {
            \$table->id();
            \$table->string('name');
            \$table->text('description')->nullable();
            \$table->enum('type', ['financial', 'user_activity', 'system_usage', 'custom']);
            \$table->string('data_source');
            \$table->json('filters')->nullable();
            \$table->json('columns')->nullable();
            \$table->enum('chart_type', ['bar', 'line', 'pie', 'table'])->nullable();
            \$table->boolean('is_public')->default(false);
            \$table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            \$table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            \$table->timestamps();
            
            \$table->index(['type', 'is_public']);
        });
    ",
    
    'saved_reports' => "
        Schema::create('saved_reports', function (Blueprint \$table) {
            \$table->id();
            \$table->string('name');
            \$table->foreignId('template_id')->nullable()->constrained('report_templates')->onDelete('set null');
            \$table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            \$table->json('filters')->nullable();
            \$table->json('data')->nullable();
            \$table->enum('format', ['pdf', 'excel', 'csv'])->default('pdf');
            \$table->string('file_path')->nullable();
            \$table->boolean('is_scheduled')->default(false);
            \$table->timestamp('last_generated_at')->nullable();
            \$table->timestamps();
            
            \$table->index(['user_id', 'is_scheduled']);
        });
    ",
    
    'report_schedules' => "
        Schema::create('report_schedules', function (Blueprint \$table) {
            \$table->id();
            \$table->string('name');
            \$table->foreignId('template_id')->constrained('report_templates')->onDelete('cascade');
            \$table->enum('frequency', ['daily', 'weekly', 'monthly', 'quarterly']);
            \$table->integer('day_of_week')->nullable();
            \$table->integer('day_of_month')->nullable();
            \$table->time('time_of_day');
            \$table->json('recipients');
            \$table->timestamp('last_run')->nullable();
            \$table->timestamp('next_run');
            \$table->boolean('is_active')->default(true);
            \$table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            \$table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            \$table->timestamps();
            
            \$table->index(['is_active', 'next_run']);
        });
    ",
    
    'system_logs' => "
        Schema::create('system_logs', function (Blueprint \$table) {
            \$table->id();
            \$table->enum('level', ['info', 'warning', 'error', 'critical']);
            \$table->text('message');
            \$table->json('context')->nullable();
            \$table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            \$table->string('ip_address')->nullable();
            \$table->text('user_agent')->nullable();
            \$table->string('url')->nullable();
            \$table->string('method')->nullable();
            \$table->string('referrer')->nullable();
            \$table->timestamps();
            
            \$table->index(['level', 'created_at']);
            \$table->index(['user_id', 'created_at']);
        });
    ",
    
    'audit_logs' => "
        Schema::create('audit_logs', function (Blueprint \$table) {
            \$table->id();
            \$table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            \$table->string('event');
            \$table->string('auditable_type');
            \$table->unsignedBigInteger('auditable_id');
            \$table->json('old_values')->nullable();
            \$table->json('new_values')->nullable();
            \$table->string('url')->nullable();
            \$table->string('ip_address')->nullable();
            \$table->text('user_agent')->nullable();
            \$table->json('tags')->nullable();
            \$table->timestamps();
            
            \$table->index(['auditable_type', 'auditable_id']);
            \$table->index(['user_id', 'created_at']);
            \$table->index(['event', 'created_at']);
        });
    ",
    
    'backup_logs' => "
        Schema::create('backup_logs', function (Blueprint \$table) {
            \$table->id();
            \$table->string('backup_name');
            \$table->enum('type', ['full', 'incremental', 'database_only']);
            \$table->bigInteger('size')->nullable();
            \$table->string('path');
            \$table->enum('status', ['success', 'failed', 'in_progress']);
            \$table->text('error_message')->nullable();
            \$table->foreignId('initiated_by')->nullable()->constrained('users')->onDelete('set null');
            \$table->timestamp('completed_at')->nullable();
            \$table->timestamps();
            
            \$table->index(['status', 'created_at']);
        });
    ",
    
    'api_logs' => "
        Schema::create('api_logs', function (Blueprint \$table) {
            \$table->id();
            \$table->foreignId('integration_id')->nullable()->constrained('integrations')->onDelete('set null');
            \$table->string('endpoint');
            \$table->string('method');
            \$table->json('request_headers')->nullable();
            \$table->json('request_body')->nullable();
            \$table->json('response_headers')->nullable();
            \$table->json('response_body')->nullable();
            \$table->integer('status_code');
            \$table->integer('response_time')->nullable();
            \$table->string('ip_address')->nullable();
            \$table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            \$table->timestamps();
            
            \$table->index(['integration_id', 'created_at']);
            \$table->index(['status_code', 'created_at']);
        });
    "
];

echo "Migrações definidas para preenchimento manual.\n";
echo "Total de migrações: " . count($migrations) . "\n";
