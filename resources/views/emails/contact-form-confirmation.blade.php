<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('contact.confirmation.title') }}</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 20px; }
        .content { background-color: #ffffff; padding: 20px; border: 1px solid #dee2e6; border-radius: 5px; }
        .button { display: inline-block; background-color: #007bff; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; margin: 20px 0; }
        .button:hover { background-color: #0056b3; }
        .footer { margin-top: 20px; padding-top: 20px; border-top: 1px solid #dee2e6; font-size: 14px; color: #6c757d; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ __('contact.confirmation.title') }}</h1>
        </div>
        
        <div class="content">
            <p>{{ __('contact.confirmation.intro', ['name' => $contactForm->name, 'process_number' => $contactForm->process_number]) }}</p>
            
            <div style="background-color: #f8f9fa; padding: 15px; border-radius: 5px; margin: 20px 0;">
                <h3 style="margin-top: 0; color: #495057;">{{ __('contact.confirmation.details_title') }}</h3>
                <p><strong>{{ __('contact.form.name') }}:</strong> {{ $contactForm->name }}</p>
                @if($contactForm->company)
                    <p><strong>{{ __('contact.form.company') }}:</strong> {{ $contactForm->company }}</p>
                @endif
                <p><strong>{{ __('contact.form.email') }}:</strong> {{ $contactForm->email }}</p>
                @if($contactForm->phone)
                    <p><strong>{{ __('contact.form.phone') }}:</strong> {{ $contactForm->phone }}</p>
                @endif
                <p><strong>{{ __('contact.form.subject') }}:</strong> {{ \App\Enums\ContactFormSubject::label($contactForm->subject) }}</p>
                @if($contactForm->custom_subject)
                    <p><strong>{{ __('contact.form.custom_subject') }}:</strong> {{ $contactForm->custom_subject }}</p>
                @endif
                <p><strong>{{ __('contact.form.message') }}:</strong></p>
                <div style="background-color: #ffffff; padding: 10px; border-left: 3px solid #007bff; margin: 10px 0;">
                    {{ $contactForm->message }}
                </div>
            </div>
            
            <p style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; border: 1px solid #c3e6cb;">
                <strong>{{ __('contact.confirmation.process_info') }}</strong><br>
                {{ __('contact.confirmation.process_details', ['process_number' => $contactForm->process_number]) }}
            </p>
            
            <a href="{{ config('app.url') }}" class="button">{{ __('contact.confirmation.button') }}</a>
        </div>
        
        <div class="footer">
            {{ __('contact.confirmation.footer') }}
        </div>
    </div>
</body>
</html>
