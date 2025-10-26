import './bootstrap';

// Listen for Livewire notifications
document.addEventListener('livewire:init', () => {
    Livewire.on('notify', (data) => {
        console.log('Notify event received:', data);
        // Extract data from array format that Livewire sends
        const message = Array.isArray(data) ? (data[0]?.message || data[0]) : data.message || data;
        const type = Array.isArray(data) ? (data[0]?.type || 'info') : data.type || 'info';
        
        // Use toastr if available, otherwise use alert
        if (typeof toastr !== 'undefined') {
            toastr[type](message);
        } else {
            alert(message);
        }
    });
});
