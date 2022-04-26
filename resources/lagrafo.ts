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
    }

    function openSidebar() {
        sidebarOpen = true;
        sidebar.classList.add('active');
        sidebarToggleButton.classList.add('active');
    }

    sidebarOpen ? closeSidebar() : openSidebar();
}

// On click of sidebar toggle button
sidebarToggleButton.addEventListener('click', function () {
    toggleSidebar();
});
