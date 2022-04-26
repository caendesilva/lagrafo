/**
 * Lagrafo Frontend Scripts
 * @version dev-master
 */

let sidebarOpen:boolean = false;

const sidebarToggleButton = document.getElementById('sidebar-toggle') as HTMLButtonElement;
const sidebar = document.getElementById('sidebar') as HTMLDivElement;
const backdrop:HTMLDivElement = document.createElement('div');

function toggleSidebar() {
    sidebarOpen ? closeSidebar() : openSidebar();

    function openSidebar() {
        sidebarOpen = true;
        sidebar.classList.add('active');
        sidebarToggleButton.classList.add('active');
        createBackdropElement();
    }

    function closeSidebar() {
        sidebarOpen = false;
        sidebar.classList.remove('active');
        sidebarToggleButton.classList.remove('active');
        removeBackdropElement();
    }

    function createBackdropElement() {
        backdrop.id = 'sidebar-backdrop';
        backdrop.title = 'Click to close sidebar';
        backdrop.classList.add('backdrop');
        backdrop.classList.add('active');

        backdrop.addEventListener('click', closeSidebar);
        document.body.appendChild(backdrop);

        document.getElementById('content').classList.add('sidebar-active');
    }

    function removeBackdropElement() {
        if (backdrop.parentNode) {
            backdrop.parentNode.removeChild(backdrop);
        }
        document.getElementById('content').classList.remove('sidebar-active');

    }

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
