/**
 * Lagrafo Frontend Scripts
 * @version dev-master
 */
var sidebarOpen = false;
var sidebarToggleButton = document.getElementById('sidebar-toggle');
var sidebar = document.getElementById('sidebar');
function toggleSidebar() {
    function closeSidebar() {
        sidebarOpen = false;
        sidebar.classList.remove('active');
        sidebarToggleButton.classList.remove('active');
        // Remove the backdrop
        var backdrop = document.getElementById('sidebar-backdrop');
        backdrop.parentNode.removeChild(backdrop);
        document.getElementById('content').classList.remove('sidebar-active');
        document.body.style.background = '';
    }
    function openSidebar() {
        sidebarOpen = true;
        sidebar.classList.add('active');
        sidebarToggleButton.classList.add('active');
        // Add backdrop
        var backdrop = document.createElement('div');
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
//# sourceMappingURL=lagrafo.js.map