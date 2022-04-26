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
        document.getElementById('content').classList.remove('sidebar-active');
        document.body.style.background = '';
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
        backdrop.classList.add('active');
        backdrop.addEventListener('click', closeSidebar);
        document.body.appendChild(backdrop);
        document.getElementById('content').classList.add('sidebar-active');
        document.body.style.background = 'black';
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

