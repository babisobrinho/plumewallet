<?php

$envPath = __DIR__ . '/../.env';

if (!file_exists($envPath)) {
    file_put_contents($envPath, "");
}

$content = file_get_contents($envPath);

function setEnvVar(string $content, string $key, string $value): string {
    $pattern = '/^' . preg_quote($key, '/') . '=.*$/m';
    $replacement = $key . '=' . $value;
    if (preg_match($pattern, $content)) {
        return preg_replace($pattern, $replacement, $content);
    }
    // Ensure file ends with newline before appending
    if ($content !== '' && substr($content, -1) !== "\n") {
        $content .= "\n";
    }
    return $content . $replacement . "\n";
}

$pairs = [
    'MAIL_MAILER' => 'smtp',
    'MAIL_HOST' => 'sandbox.smtp.mailtrap.io',
    'MAIL_PORT' => '2525',
    'MAIL_USERNAME' => 'cfa5d81d69f7c2',
    'MAIL_PASSWORD' => '039d56f8345e91',
    'MAIL_ENCRYPTION' => 'null',
    'MAIL_FROM_ADDRESS' => 'admin@plume.pt',
    'MAIL_FROM_NAME' => '"Plume Admin"',
];

foreach ($pairs as $k => $v) {
    $content = setEnvVar($content, $k, $v);
}

file_put_contents($envPath, $content);

echo "Updated .env successfully\n";


