<script>
    // Function to get system preference
    function getSystemTheme() {
        return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    }

    // Function to apply theme
    function applyTheme(theme) {
        const html = document.documentElement;

        if (theme === 'system') {
            const systemTheme = getSystemTheme();
            html.classList.toggle('dark', systemTheme === 'dark');
            localStorage.setItem('theme', 'system');
        } else {
            html.classList.toggle('dark', theme === 'dark');
            localStorage.setItem('theme', theme);
        }

        // Update meta theme-color for mobile browsers
        updateThemeColor(theme);
    }

    // Update mobile browser theme color
    function updateThemeColor(theme) {
        const metaThemeColor = document.querySelector('meta[name="theme-color"]');
        const color = theme === 'dark' ? '#1f2937' : '#f9fafb';

        if (metaThemeColor) {
            metaThemeColor.setAttribute('content', color);
        }
    }

    // Initialize theme on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Check for session theme first (user override), then user preference, then system
        const sessionTheme = @json(session('theme'));
        const userTheme = @json(Auth::check() ? Auth::user()->theme?->value : null);
        const storedTheme = localStorage.getItem('theme');

        let theme = 'system';

        if (sessionTheme) {
            theme = sessionTheme;
        } else if (userTheme) {
            theme = userTheme;
        } else if (storedTheme) {
            theme = storedTheme;
        }

        applyTheme(theme);
    });

    // Listen for system theme changes
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
        const currentTheme = localStorage.getItem('theme');
        if (currentTheme === 'system') {
            applyTheme('system');
        }
    });

    // Listen for Livewire theme changes
    window.addEventListener('theme-changed', function(event) {
        applyTheme(event.detail.theme);
    });
</script>
