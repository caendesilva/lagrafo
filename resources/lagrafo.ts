/**
 * Lagrafo Frontend Scripts
 * @version dev-master
 */

let sidebarOpen:boolean = false;

const sidebarToggleButton = document.getElementById('sidebar-toggle') as HTMLButtonElement;
const sidebar = document.getElementById('sidebar') as HTMLDivElement;

function toggleSidebar() {
    function closeSidebar() {
        sidebarOpen = false;
        sidebar.classList.remove('active');
        sidebarToggleButton.classList.remove('active');
        // Remove the backdrop
        const backdrop = document.getElementById('sidebar-backdrop') as HTMLDivElement;
        backdrop.parentNode.removeChild(backdrop);
    }

    function openSidebar() {
        sidebarOpen = true;
        sidebar.classList.add('active');
        sidebarToggleButton.classList.add('active');
        // Add backdrop
        const backdrop = document.createElement('div');
        backdrop.id = 'sidebar-backdrop';
        backdrop.title = 'Click to close sidebar';
        backdrop.classList.add('backdrop');
        backdrop.addEventListener('click', closeSidebar);
        document.body.appendChild(backdrop);
    }

    sidebarOpen ? closeSidebar() : openSidebar();
}

// On click of sidebar toggle button
sidebarToggleButton.addEventListener('click', function () {
    toggleSidebar();
});

// If sidebar is open, close it on escape key press
document.addEventListener('keydown', function (e) {
    if (sidebarOpen && e.key === 'Escape') {
        toggleSidebar();
    }
});

